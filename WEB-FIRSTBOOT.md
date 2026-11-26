# WEB-FIRSTBOOT.md

Bringing up a freshly built and installed web VM. The in-VM steps
(certificate, venv refresh, database init) and the day-to-day
development workflow are documented in `FIRST-BOOT.md` in the urweb
repo (gitlab.com:rikfaith/urweb; local clone at
`/home/faith/git/gitlab-rik/urweb`). This file covers the host
side and the git-repo lifecycle. Note the urweb app now runs as the
default non-root user (`faith`), so where urweb `FIRST-BOOT.md`
says `su urweb`, use `su faith`.

## What `./vm-build web` / `./vm-install web` produced

- VM `web` on node0: 16 GB RAM, 4 vCPU, MAC 52:54:00:16:01:00/01,
  autostart, apache listening on 443 only.
- Virtiofs share: node0 `/node0/web` -> VM `/web`. This is the
  persistent web root and is **empty** after a fresh install.
- Inside the image, `/web.baseline/urweb`: the urweb repo checked
  out at build time (**including `.git`**), venv built with
  `uv sync --no-dev`, all owned by the default non-root user
  (`faith`).
- `/root/firstboot.sh`: first-boot script that issues the TLS
  certificate, copies the baseline into `/web`, and restarts apache
  (see below).
- `/etc/urweb/config.toml` from the build host, pointed at
  `pgsql.alephnull.com`; the `urweb` DB and user were created by
  the pgsql image build.
- Apache vhosts `000-default.conf` and `panpedia.org.conf`, both
  using the panpedia.org certificate, WSGI -> `/web/urweb/wsgi.py`.
- The gitlab key used for the build-time checkout, in `/root/.ssh`,
  and also in `/home/faith/.ssh` (via the `Copy .ssh files` task in
  `tasks/update_user_login.yml`), so `git pull` works as the
  default user. The same task also adds a `Host gitlab.com` block to
  faith's ssh config (selecting the `gitlab-rikfaith` key, since the
  default identity is not registered on gitlab) and pre-accepts the
  gitlab.com host key into her known_hosts.
- `URWEB_CONFIG=/etc/urweb/config.toml` in `/etc/apache2/envvars`,
  which is how the WSGI daemon gets the config path: a mod_wsgi
  daemon process inherits its environment from the apache parent,
  so `SetEnv` in the vhost does not reach it (and there is no
  `env=` option on `WSGIDaemonProcess`).
- The panpedia.org TLS certificate is deliberately **not** issued
  during the image build (every build attempt would consume one of
  Let's Encrypt's weekly per-domain certificates); it is issued by
  `/root/firstboot.sh` at first boot.

## The git repo: no `git init` needed

The build-time checkout bakes a full clone (`.git` included) into
`/web.baseline/urweb`, and the first-boot run of `/root/firstboot.sh`
(which does `cp -a /web.baseline/. /web/`) is what materializes the
live repo on the file server. After that, the same tree is visible
as:

    in the VM:   /web/urweb
    on node0:    /node0/web/urweb

The update workflow (`git pull` as `faith`, `uv sync --no-dev`,
`apache2ctl graceful`) is in urweb `FIRST-BOOT.md`.

### Making `git pull` work as faith

The gitlab key, the `Host gitlab.com` ssh config block, and the
gitlab.com host key are all provisioned at build time (see above),
so nothing extra is needed. If a pull nonetheless fails with a
host-key verification error (gitlab rotated its key), re-scan:

    ssh-keyscan gitlab.com >> /home/faith/.ssh/known_hosts

If you want to pull from node0 itself instead, put the same key in
`~/.ssh` for the account that pulls there.

## First boot (in the VM)

In order:

1. Run `/root/firstboot.sh`. It issues the panpedia.org certificate
   (DO DNS challenge; covers panpedia.org, www, local, and
   panpedia.panpedia.org — the `local.`/`panpedia.` aliases are how
   you verify before cutover), copies the baseline into `/web`, and
   restarts apache. It fails (by design) if `/web/urweb` is already
   present — it will not overwrite it; update the live tree with
   `cd /web/urweb && git pull` instead. On a rebuild it still
   re-issues the cert, since `/etc/letsencrypt` is fresh while `/web`
   persists.
2. `su faith -c 'cd /web/urweb && uv sync --no-dev'` (venv
   shebangs still point at `/web.baseline` after the copy)
3. `su faith -c 'cd /web/urweb && uv run urweb --init-users'`
   (one-time: creates the admin user from `admin_token` in the
   config)
4. Verify, from inside the VM (before the DNS cutover the name is
   not resolvable, so pin it to loopback):
   `curl -sk --resolve local.panpedia.org:443:127.0.0.1 -I https://local.panpedia.org/`
   — expect `HTTP/1.1 200 OK`.

## Cutover

The panpedia.org A record currently points at the old DO droplet
(see `octodns/panpedia.org.yaml`; `www` is a CNAME to the apex).
Once the VM verifies via the aliases, update the A record to the
web VM's address and `octodns sync`.

## Notes

- Leave `/web.baseline` in place; it is the pristine copy of the
  built state.
- `/web` (node0 `/node0/web`) persists across image rebuilds. After
  re-running `./vm-install web`, the baseline copy is only needed
  if `/web` is empty; the git repo, config, and database are
  unaffected by a rebuild.
- The database lives on the pgsql VM under `/pgsql/postgresql`; a
  web rebuild never touches it.

# alephnull.com web VM migration

Replace the old web VM (Debian 10 buster, hostname `www`, guest `alephnull` on
`shadow`, public IP 199.48.130.3, ssh port 993) with a secure, modern Devuan
VM built by `vmdb2` from this repo, following the same pattern as the dict.org
VMs (`dict.vmdb` / `dict.yaml`).

Source of truth for the current state: the mirror
`/anna0/www.alephnull.com-20261002-hosted-on-shadow` (a full filesystem copy
taken 2026-10-02; confirmed complete — the missing pieces below are missing on
the live VM too, i.e. they are already gone, not mirror gaps).

## Old-VM inventory

Apache 2.4.38 (`mpm_prefork`) + PHP 7.3, DokuWiki 0.0.20180422a "Greebo"
(2018), all Let's Encrypt (cron.d + crontab renewal). 8 sites, ~15.4G:

| Site | Size | What it is |
|---|---|---|
| alephnull.com | 9.3G | 20 yrs of static media + DokuWiki instance in `support/` (conf/, data/ 134M, `d07.db` sqlite 109M, `prepend.php` with `DOKU_CONF`/`DOKU_INC` = `support/`) + `old.tar.gz`, `pmwiki-old` (legacy) |
| hybridsky.org | 4.7G | Static (20220326 = 4.3G raw photos/video) + DokuWiki instance in `support/` (data 1.9M) + CVSTrAC "wiki" (`wiki/w` -> `/opt/cvstrac`, unreachable from the vhost) |
| pineview82.org | 994M | Static (raw 611M, 30th 321M, 20th 62M); `raw/`, `30th/`, `20th/`, `downloads/` are Basic-auth protected via `support/passwords` (Apache htpasswd, not wiki auth) |
| hillsboroughpeds.com | 214M | Static + DokuWiki instance in `support/` (data 35M); `wiki/` dir full of dangling symlinks, unreachable from the vhost |
| urmp.org | 19M | DokuWiki at the docroot (`doku.php` in docroot, conf/data in `support/`) + legacy contest/mailman/gitweb bits |
| bogus.org | 2.5M | Plain static |
| tarball.org | 8.7M | Plain static |
| clepperfaith.com | 1.7M | Pure 301 -> hillsboroughpeds.com (+ `clepper-faith.com` alias whose 443 vhost had no certificate) |

Plus a default DokuWiki instance (`/usr/share/dokuwiki` + `/var/lib/dokuwiki`
9.9M + `/etc/dokuwiki`), aliased at `/dokuwiki`, restricted to localhost.

### Facts that shape the design

- `/www/dokuwiki/` (old per-site instance *code* dirs referenced by ~59
  symlinks) no longer exists on the live VM — the per-site DokuWiki *code* and
  the per-site plugin code that lived there are already lost. The per-site
  **content** (conf/, data/ with pages+media: alephnull 200 pages/37 media,
  hillsboroughpeds 33/6, hybridsky 6/4, urmp 12/2) is fully present in each
  site's `support/` and is what we migrate. Pages that relied on the lost
  per-site plugins (gallery, loglog, captcha, chem, popularity,
  usermanager) will render raw template text; acceptable per owner.
- Only urmp.org's wiki was actually URL-reachable on the old VM (doku.php in
  its docroot). The others' wiki dirs were outside their DocumentRoots.
- `alephnull.com/docroot/winmore` is an empty `d---------` dir (2003); not
  present on the live VM; dropped.
- urmp's `contest.cgi`, `mailman/`, `gitweb.conf`, `docroot/gitweb/` were never
  executable under the old vhosts (no ScriptAlias/ExecCGI); dropped.

## Decisions (with owner)

- **Content in git**: the full curated state goes into `alephnull/` in this
  repo; heavy media is git-ignored (working tree stays complete on the build
  host; the GitHub push stays small). `MANIFEST.txt` (path/size/sha256) +
  `RESTORE.md` document the ignored set.
- **DokuWiki**: upgrade to the current packaged stable (Devuan package,
  modern PHP 8.x). One code copy per wiki instance (placed in the site's
  `support/`, where `prepend.php` already points `DOKU_CONF`/`DOKU_INC`).
- **PHP**: `php-fpm` + `mpm_event`. Per-site fpm pools with
  `php_value[include_path]` for the 4 PHP-serving sites; a default pool for
  the rest.
- **Retired**: `old.tar.gz`, `pmwiki-old/`, `docroot.pre-julie/`, `*~` files,
  `winmore`; urmp `contest.cgi`/`mailman/`/`gitweb.conf`/`docroot/gitweb/`;
  CVSTrAC (hybridsky `wiki/` + `wiki-data/`); the default `/dokuwiki`
  instance. `clepper-faith.com` is kept (fixed by folding it into the
  clepperfaith certificate).

## Scope reduction (2026-10-04)

The owner simplified the deployment target. Only the following needs to work
on the new VM; everything else stays in the mirror (the owner will decide its
fate later). The `alephnull/www` working tree was trimmed accordingly
(15.4G -> 6.0G; `MANIFEST.txt` regenerated for the remaining ignored set):

| Site | New VM state |
|---|---|
| alephnull.com | The wiki only. `support/` instance (conf+data+Mort code) served at the historical `/w/` (plus a `/wiki/` alias); `/` 301 -> `/w/`. Docroot keeps `w/` (the old facade: `.htaccess` + `lib -> ../../support/lib`), `weather/` (self-contained app, linked from the wiki), and the files the wiki pages link to: `manuals/`, `therm/`, `mrtg/`, `halloween/`, `perf.html`, `linux.html`, `favicon.ico`. Everything else (9.2G of static media, `news/`, `house/`, …) dropped. `support/passwords` dropped with it (no more Basic-auth subdirs here). |
| bogus.org | Everything (unchanged). |
| clepperfaith.com | Content dropped; 301 -> hillsboroughpeds.com (as before). |
| hillsboroughpeds.com | Just `docroot/index.html` + its linked assets (`favicon.ico`, `style.css`, `menu.js`, `images/{banner,background}.jpg`). Wiki and the rest of the 214M dropped. |
| hybridsky.org | Everything (unchanged; wiki at `/wiki/`). |
| pineview82.org | Everything (unchanged; Basic-auth photo dirs live via `.htaccess`, so this is the only site with `AllowOverride All`). |
| tarball.org | Content dropped; 301 -> alephnull.com. |
| urmp.org | Content dropped (wiki conf+data included); 301 -> alephnull.com. The `Alias /wiki` + docroot wrappers described below no longer apply. |

`wiki_sites` is now just `alephnull.com` + `hybridsky.org`. The redirect
vhosts carry their `test.<site>` aliases too, so all 9 vhosts remain testable
while the old VM owns the apex A records.

## Phase 1 — mirror state into the repo

`alephnull/` layout (mirrors the VM filesystem):

```
alephnull/
  www/<8 site dirs>        # 15.4G curated copy of the mirror /www
  apache2/vhost.j2         # Jinja template for per-site vhosts (new)
  apache2/pool-d.j2        # Jinja template for per-site fpm pools (new)
  MANIFEST.txt             # path, size, mtime, sha256 for every git-ignored path
  RESTORE.md               # how to re-materialize ignored content on a fresh clone
  .gitignore               # the heavy-media exclusion set
```

Curation applied while copying (rsync excludes):

- `alephnull.com/old.tar.gz`, `alephnull.com/pmwiki-old/`
- `alephnull.com/docroot/winmore/`
- `hillsboroughpeds.com/docroot.pre-julie/`
- `hybridsky.org/wiki/`, `hybridsky.org/wiki-data/` (CVSTrAC)
- `urmp.org/support/contest.cgi`, `urmp.org/support/mailman/`,
  `urmp.org/support/gitweb.conf`, `urmp.org/docroot/gitweb/`
- every `*~` file
- all dangling symlinks (they pointed into the long-gone `/www/dokuwiki`)

Git-ignored ("heavy media", ~14.5G; the working tree keeps them):

- dirs: `www/alephnull.com/docroot/{redwoods,rockets,house,gd,mountains}`,
  `www/hybridsky.org/docroot/20220326`,
  `www/pineview82.org/docroot/{raw,30th,20th}`
- plus any individual file > 20 MB (e.g. `alephnull.com/support/d07.db` 109M,
  straggler MOVs)

Tracked remainder: ~1G (HTML, PDFs, small images, all DokuWiki conf/data,
code).

## Phase 2 — `alephnull.vmdb`, `alephnull.yaml`, `tasks/update_alephnull.yml`

### alephnull.vmdb

Keep the existing Devuan `excalibur` debootstrap skeleton. Add:

```yaml
- copy-dir: /www
  src: alephnull/www
  user: www-data
  group: www-data
```

(run from the repo root, so the `alephnull/www` working tree — complete with
the git-ignored media — is what lands in the image).

`extra_vars` unchanged except `vm_hostname` is still the placeholder `vm0`
(open item — owner will name the VM).

### alephnull.yaml

Keeps the standard baseline imports (apt, network, sudo, chrony, sshguard,
cloud-init, …) and `tasks/update_alephnull.yml`; now also carries the site
lists (`serving_sites`, `redirect_sites`, `all_sites`, `wiki_sites`) used by
the vhost/pool templates.

### tasks/update_alephnull.yml (replaces the 5-line stub)

1. **apt**: `apache2`, `php-fpm`, `php-cli`, `php-mbstring`, `php-xml`,
   `php-gd`, `php-sqlite3`, `php-intl`, `dokuwiki`, `cronolog`, `sqlite3`,
   plus the certbot stack (`gcc`, `python3.13`, `python3.13-dev`,
   `libpython3.13-dev`, `libpython3-dev`, `python3-dev`,
   `python3-virtualenv`, `python3-certbot`, `python3-certbot-apache`,
   `python3-certbot-dns-digitalocean` — the dns plugin comes from the
   Devuan testing repo, added first). The pip
   `certbot`/`certbot-apache` pair is installed into the `/opt/certbot`
    virtualenv, mirroring the dict VM (same pattern as
    `tasks/update_tools_web.yml`, which this playbook no longer imports —
    the alephnull-relevant pieces are inlined here). `a2enmod` enables
    `access_compat` (the migrated `.htaccess` files use 2.2-era
    `Order`/`Deny`/`Allow`), `headers`, `proxy`, `proxy_fcgi`, `rewrite`,
    `ssl`; `a2dismod status`.
2. **vhosts**: render `alephnull/apache2/vhost.j2` once per site into
   `/etc/apache2/sites-available/<site>.conf` + `a2ensite`. Per site:
   - 443 vhost: DocumentRoot, cronolog TransferLog/ErrorLog under
     `/var/log/httpd/<site>/%Y/%m/`, `LimitRequestBody 65536`,
     `Header always set Strict-Transport-Security "max-age=31536000"`,
     Let's Encrypt cert paths, `Include options-ssl-apache.conf`.
   - `www.<site>` 443 + both 80 vhosts: 301 to apex https.
   - `aliases` (extra `ServerAlias` names on the 443 + apex-80 vhosts):
     `test.<site>` for all 7 sites (so the new VM can be verified while the
     old one still owns the apex A records — the certs cover them), plus
     `so.bogus.org`. The apex-80 vhost redirects with
     `RewriteRule ^ https://%{HTTP_HOST}/ [R=301,L]` so `test.<site>`
     lands back on `https://test.<site>/`, not on the apex.
    - wiki sites (alephnull.com, hybridsky.org — see Scope reduction):
      `Alias /wiki /www/<site>/support/` (alephnull.com additionally at the
      historical `/w/`, with `/` 301 -> `/w/`) and `<Directory>` guards:
      `conf/`, `data/` denied, `*.db` denied, `Options -Indexes`.
    - ~~urmp.org: `Alias /wiki` + docroot wrappers~~ (superseded by the
      Scope reduction: urmp.org is now a redirect-only site).
   - clepperfaith.com + clepper-faith.com: redirect-only vhosts (as today),
     both names on one certificate.
   - no `ScriptAlias /bin/` anywhere (the old one exposed an entire wiki
     support dir — including a 109M sqlite — as live CGI).
3. **fpm pools**: default pool (www) + one pool per PHP site
   (alephnull.com, hillsboroughpeds.com, hybridsky.org, urmp.org) with
   `php_value[include_path] = /www/<site>/support`; vhosts route `.php` to
   the right pool. `php-fpm.conf`/`www.conf` left at packaged defaults.
4. **DokuWiki instances** (per wiki site). The Debian package splits the
   instance three ways (code `/usr/share/dokuwiki`, config `/etc/dokuwiki`,
   writable dirs `/var/lib/dokuwiki`); the build merges a self-contained
   modern instance into each site's `support/` (where the migrated
   `conf/` and `data/` already are):
   - tar-merge the code (`bin doku.php feed.php index.php inc lib vendor
     VERSION .htaccess.dist*`), excluding the `lib/tpl` and `lib/plugins`
     symlinks that point at the global `/var/lib/dokuwiki` dirs, so each
     site keeps its own real `lib/tpl` (migrated custom templates —
     alephnull/hybridsky/hp/urmp + arctic — plus the packaged default
     `dokuwiki` template copied in) and its own `lib/plugins`
     (hybridsky + hillsboroughpeds kept their Greebo plugins; the rest are
     lost — see below).
   - merge the package conf over the site conf; the package's
     `acl.auth.php`/`users.auth.php` are symlinks into the global
     `/var/lib/dokuwiki/acl/` and are excluded so each site keeps its own
     real auth files. Site `local.php` (per-site `$conf[]` settings,
     including `savedir` pointing at the new location) and
     `users.auth.php` have no name clash and are kept.
   - **extensions**: the Debian package bundles none (`lib/plugins` is an
     empty symlink). The build copies the curated core set from the
     official 2026-07-14c "Mort" tarball (kept in the repo at
     `alephnull/dokuwiki-plugins/`): `authplain` (the cryptplain
     successor — it reads `conf/users.auth.php`, whose md5/md5crypt
     hashes its `PassHash` understands, so existing passwords keep
     working), plus `usermanager`, `config`, `acl`, `extension`,
     `popularity`, `info`, `logviewer`, `revert`, `safefnrecode`,
     `styling` and the plugin-framework stub files. The
     `support/passwords` files are unrelated to wiki auth: they are
     Apache htpasswd files for Basic auth, used via per-directory
     `.htaccess` (pineview82.org `30th/`, `20th/`, `raw/`,
     `downloads/`).
   - **`.htaccess`**: the old web VM ran `AllowOverride All` on `/www`;
     the default here is `None`, with `allow_override: "All"` only on
     pineview82.org, whose docroot carries live Basic-auth `.htaccess`
     functionality. `access_compat` is enabled for its 2.2-era
     `Order`/`Deny`/`Allow` lines. The wikis' `support/data/` is denied
     in the vhost (replacing the role of the old `data/.htaccess`).
   - **ACL**: this dokuwiki returns `AUTH_NONE` when the acl file is
     missing (the old Greebo fell back to open-read), so each site gets
     a baseline `conf/acl.auth.php`: `* @ALL 1` / `* @user 6` /
     `* @admin 255`.
   - note: apt installs dokuwiki **2026-07-14c "Mort"** (current
     upstream stable), which comes from the Devuan **testing** repo that
     was added for the certbot dns plugin — not excalibur's 2024-02-06b.
   - `mkdir -p` the modern data subdirs (Greebo layout already has most;
     only `log` is missing), then `chown -R www-data:www-data
     support/data support/conf` (fpm writes data; conf must be writable
     for ACL + user admin).
   - delete the stale site `prepend.php` (its bare `define('DOKU_INC')`
     is fatal on modern PHP; modern `doku.php` resolves
     `DOKU_CONF`/`DOKU_DATA` relative to its own dir, which matches the
     per-site layout).
   - result: self-contained modern instances, one code copy per site.
5. **local.conf** for `/www`: `Options FollowSymLinks`, `AllowOverride None`
   (the old `AllowOverride All` + 2.2-era `order allow,deny` dokuwiki
   apache.conf are dropped).
6. **security** (dict pattern): `ServerTokens Prod`, `ServerSignature Off`,
   `TraceEnable Off` in `conf-available/security.conf`.
7. **logrotate**: same stanza for `/var/log/httpd/*/*/*.log` and
   `/var/log/php-fpm/*.log` (daily, rotate 30, compress, delaycompress).
8. **certificates** (dict pattern, DigitalOcean DNS — no rfc2136):
   - `/etc/letsencrypt/options-ssl-apache.conf` pre-installed (the
     vhosts `Include` it).
   - `/root/digitalocean-alephnull.ini` from
     `{{ default.web_alephnull_token }}` (vault — must be added).
   - one `certbot certonly --preferred-challenges dns
     --dns-digitalocean` call per site at **build time** (8 certificates,
     covering all 9 vhost names; clepperfaith.com + clepper-faith.com
     share one).
   - renewal: `17 3 10,20 * * root certbot renew --post-hook
     "apache2ctl graceful"` blockinfile'd into `/etc/crontab`.

## Phase 3 — build, cutover, verify

0. Prereq: DNS for the domains must already be hosted at DigitalOcean
   (the ACME DNS-01 challenge writes `_acme-challenge` TXT records via
   the DO API), and `web_alephnull_token` must exist in the vault.
1. `./vm-build alephnull` (first build is slow: 15G `copy-dir`); all 8
   certificates are issued during the build. `./vm-install alephnull`.
2. Owner points the A records at the new VM.
3. Verify per site:
   - static: homepage + one deep link + one large-media URL per big site;
   - wikis: `https://<site>/wiki/` renders, login works (authplain,
     per-site `users.auth.php`), a page with media renders; urmp old-style
     `https://urmp.org/doku.php?id=...` also works;
   - headers: HSTS, `Server: Apache` (no version), 404 has no signature
     footer;
   - boundaries: 65536-byte POST -> 200/413 split at 65537 from Apache;
     PUT -> 405 where PHP vhosts apply (static vhosts: 405 from Apache);
   - retired: `/dokuwiki`, CVSTrAC URLs, contest.cgi -> 404;
   - `curl -kI` each `www.` name -> 301 to apex.
4. Old VM stays powered off (rollback) until sign-off, then decommission.

## Rollback

DNS back to 199.48.130.3; the old VM is untouched and running.

## Open items

- VM hostname: `vm_hostname` is still the `vm0` placeholder.
- `default.web_alephnull_token` (DigitalOcean API token for the account
  that hosts the alephnull.com DNS zone) must be added to
  `passwords.yml`; if those zones live in the same DO account as
  dict.org, `web_dict_token` could be reused instead.
- If the lost per-site DokuWiki plugins ever matter (gallery/loglog/etc.),
  they'd have to be re-installed from dokuwiki.org per instance; data
  compatibility is not an issue.

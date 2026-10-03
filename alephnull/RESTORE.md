# Restoring the git-ignored content

A fresh clone of this repo lacks the heavy media listed in `MANIFEST.txt`
(14.22 GiB, 3902 files). The build host keeps them in the `alephnull/www`
working tree; only a bare clone needs restoring.

## From the source mirror (preferred)

The full state lives on anna0 at
`/anna0/www.alephnull.com-20261002-hosted-on-shadow`. Its layout matches the
manifest paths directly (the mirror root contains `www/`, `etc/`, ...), so:

```sh
cd <repo>/alephnull
# manifest paths (lines 6+) -> /tmp/missing.txt
awk 'NR>5 {print $4}' MANIFEST.txt > /tmp/missing.txt

rsync -a --files-from=/tmp/missing.txt \
    /anna0/www.alephnull.com-20261002-hosted-on-shadow/ <repo>/alephnull/
```

(`--files-from` paths that already exist are skipped quickly; use `-n` first
to preview.)

## Verify

```sh
cd <repo>/alephnull
awk 'NR>5 {print $1"  "$4}' MANIFEST.txt | sha256sum -c -
```

## Curated-away content (intentionally absent everywhere)

These were on the old VM but were deliberately dropped during curation (see
ALEPHNULL-MIGRATION.md, "Decisions"):

- `www/alephnull.com/old.tar.gz`, `www/alephnull.com/pmwiki-old/`
- `www/alephnull.com/docroot/winmore/` (empty, mode 0000, 2003)
- `www/hillsboroughpeds.com/docroot.pre-julie/`
- `www/hybridsky.org/wiki/` + `www/hybridsky.org/wiki-data/` (CVSTrAC)
- `www/urmp.org/support/contest.cgi`, `.../support/mailman/`,
  `.../support/gitweb.conf`, `.../docroot/gitweb/`
- every `*~` backup file
- all symlinks into the long-gone `/www/dokuwiki` instance directory

They can still be pulled from the mirror if ever needed.

#!/usr/bin/python3
"""Test harness for the Dict CGI.

Runs dict/support/Dict as a subprocess with a fake CGI environment and
the stubbed dict client (dict/tests/fake_dict), and checks the HTTP
responses, the argv vector the stub received, and side effects.

Usage: python3 dict/tests/test_dict.py
"""
import importlib.machinery
import importlib.util
import os
import re
import subprocess
import sys
import tempfile
import urllib.parse

HERE = os.path.dirname(os.path.abspath(__file__))
ROOT = os.path.dirname(HERE)
CGI = os.path.join(ROOT, "support", "Dict")
FAKE = os.path.join(HERE, "fake_dict")

sys.dont_write_bytecode = True
loader = importlib.machinery.SourceFileLoader("dict_cgi", CGI)
spec = importlib.util.spec_from_loader("dict_cgi", loader)
dict_cgi = importlib.util.module_from_spec(spec)
loader.exec_module(dict_cgi)
clean_query = dict_cgi.clean_query

FAILURES = []
TMP = tempfile.mkdtemp(prefix="dict-test-")


def check(name, cond, detail=""):
    if cond:
        print("ok    %s" % name)
    else:
        print("FAIL  %s   %s" % (name, detail))
        FAILURES.append(name)


def argv_log():
    return os.path.join(TMP, "argv-%d.log" % len(os.listdir(TMP)))


def run_cgi(query="", body=None, method="GET", extra_env=None):
    env = {
        "REQUEST_METHOD": method,
        "REMOTE_ADDR": "203.0.113.7",
        "HTTP_USER_AGENT": "DictTest/1.0",
        "DICT_BIN": FAKE,
        "PATH": "/usr/bin:/bin",
    }
    if query:
        env["QUERY_STRING"] = query
    if body is not None:
        env["CONTENT_LENGTH"] = str(len(body.encode("utf-8")))
    if extra_env:
        env.update(extra_env)
    proc = subprocess.run(
        [CGI], input=(body.encode("utf-8") if body is not None else b""),
        env=env, capture_output=True, timeout=60)
    raw = proc.stdout.decode("utf-8", "replace")
    header_part, _, body_html = raw.partition("\r\n\r\n")
    headers = {}
    for line in header_part.split("\r\n"):
        if ":" in line:
            key, val = line.split(":", 1)
            headers[key.strip().lower()] = val.strip()
    status = 200
    m = re.match(r"Status: (\d+)", header_part)
    if m:
        status = int(m.group(1))
    return status, headers, body_html, proc.stderr.decode("utf-8", "replace")


def records(path):
    if not os.path.exists(path):
        return []
    with open(path) as f:
        return [line.rstrip("\n").split("\x1f")
                for line in f if line.strip()]


def query_recs(path):
    """Stub invocations other than the -DS enumeration."""
    return [r for r in records(path) if "-DS" not in r]


def touch(name):
    path = os.path.join(TMP, name)
    return path


def expect_no_file(path):
    return not os.path.exists(path)


#
# 1. Initial page
#

status, headers, body, _ = run_cgi()
check("initial: 200", status == 200)
check("initial: content-type",
      "text/html" in headers.get("content-type", ""))
check("initial: csp", "default-src 'self'" in headers.get("content-security-policy", ""))
check("initial: nosniff", headers.get("x-content-type-options") == "nosniff")
check("initial: frame options", headers.get("x-frame-options") == "SAMEORIGIN")
check("initial: referrer policy",
      "referrer-policy" in headers)
check("initial: title", "<title>dict.org</title>" in body)
check("initial: form", 'name="DICT"' in body and 'name="Query"' in body)
check("initial: strategy options",
      '<option value="*" selected>Return Definitions' in body
      and '<option value="exact">Match headwords exactly' in body)
check("initial: database options",
      '<option value="*" selected>Any' in body
      and '<option value="alpha">Alpha test dictionary v1.0' in body
      and '<option value="!">First match' in body)
check("initial: info links",
      "Database copyright information" in body
      and "Server information" in body)
nonce = re.search(r"script-src 'nonce-([^']+)'",
                  headers.get("content-security-policy", ""))
check("initial: csp nonce present", nonce is not None)
if nonce:
    check("initial: script uses nonce",
          '<script nonce="%s">' % nonce.group(1) in body)

#
# 2. Definition lookup
#

log = argv_log()
status, headers, body, _ = run_cgi(
    "Form=Dict1&Query=hello&Strategy=*&Database=alpha",
    extra_env={"FAKE_DICT_LOG": log})
recs = query_recs(log)
check("define: 200", status == 200)
check("define: argv is vector, no shell flags",
      len(recs) == 1 and "-h" in recs[0] and "localhost" in recs[0]
      and recs[0][recs[0].index("-d") + 1] == "alpha"
      and recs[0][-1] == "hello" and "-s" not in recs[0] and "-m" not in recs[0],
      repr(recs))
check("define: --client string",
      len(recs) == 1 and "--client" in recs[0]
      and recs[0][recs[0].index("--client") + 1] == "203.0.113.7 DictTest/1.0",
      repr(recs))
check("define: count line",
      re.search(r"<b>1 definition found\n for <a href=\"/bin/Dict\?Form=Dict2"
                r"&Database=alpha&Query=hello\">hello</a></b>", body) is not None)
check("define: From link",
      'From <a href="/bin/Dict?Form=Dict3&Database=alpha">'
      "Alpha test dictionary v1.0 </a>:" in body)
check("define: xref links",
      '<a href="/bin/Dict?Form=Dict2&Database=*&Query=Halloo">Halloo</a>' in body
      and '<a href="/bin/Dict?Form=Dict2&Database=*&Query=Holloo">Holloo</a>' in body)
check("define: multi-line xref paired",
      "Query=development+environment" in body
      and "development\n</a>" in body
      and ">environment</a>" in body)
check("define: url anchored",
      '<a href="http://example.org/doc">http://example.org/doc</a>' in body)
check("define: amp escaped", "interj. &amp; n." in body)
check("define: quoted text not linked",
      'prints &quot;hello, world&quot; to' in body
      or 'prints "hello, world" to' in body.replace("&quot;", '"'))
check("define: title has query", "<title>dict.org- hello</title>" in body)
check("define: form value echoed escaped",
      'name="Query" size=40 value="hello"' in body)

#
# 3. Strategy word list
#

log = argv_log()
status, headers, body, _ = run_cgi(
    "Form=Dict1&Query=list&Strategy=prefix&Database=alpha",
    extra_env={"FAKE_DICT_LOG": log})
recs = query_recs(log)
check("wordlist: 200", status == 200)
check("wordlist: argv uses -s/-m form",
      len(recs) == 1 and recs[0][-4:] == ["-s", "prefix", "-m", "list"],
      repr(recs))
check("wordlist: head line",
      "<b>alpha:</b>" in body
      and '<a href="/bin/Dict?Form=Dict2&Database=alpha&Query=hello">hello</a>' in body
      and '<a href="/bin/Dict?Form=Dict2&Database=alpha&Query=-head">-head</a>' in body)
check("wordlist: quoted phrase link",
      "Query='Head+and+ears'\">\"Head and ears\"</a>" in body)
check("wordlist: continuation links",
      "<a href=\"/bin/Dict?Form=Dict2&Database=alpha&Query='head+earing'\">"
      "\"head earing\"</a>" in body)
check("wordlist: amp in token encoded",
      "Query=K%26R" in body)

#
# 4. Injection payloads
#
# The stub records exactly what argv it received, so a side effect file
# appearing would mean the value was interpreted by a shell somewhere.

for i, payload in enumerate([
        "$(touch pwn)",
        "`touch pwn`",
        "a\"b'c;d",
        "a%26b=c",
        "a|b",
        "a\ne",
]):
    mark = touch("pwn%d" % i)
    log = argv_log()
    status, headers, body, _ = run_cgi(
        "Form=Dict1&Query=%s&Strategy=%%2A&Database=alpha" % payload,
        extra_env={"FAKE_DICT_LOG": log})
    recs = query_recs(log)
    expected = clean_query(urllib.parse.unquote_plus(payload))
    check("inject[%d]: 200" % i, status == 200)
    check("inject[%d]: no shell side effect" % i, expect_no_file(mark), mark)
    check("inject[%d]: argv carries literal value" % i,
          len(recs) == 1 and recs[0][-1] == expected,
          "argv=%r expected=%r" % (recs, expected))

# Strategy and Database are whitelisted, not shell-interpreted.
mark = touch("pwn-strat")
log = argv_log()
status, headers, body, _ = run_cgi(
    "Form=Dict1&Query=hello&Strategy=$(touch+pwn)&Database=alpha",
    extra_env={"FAKE_DICT_LOG": log})
check("inject: bad strategy rejected",
      status == 200 and "Unknown strategy:" in body
      and expect_no_file(mark) and len(query_recs(log)) == 0,
      repr(query_recs(log)))
mark = touch("pwn-db")
status, headers, body, _ = run_cgi(
    "Form=Dict1&Query=hello&Strategy=*&Database=$(touch+pwn)",
    extra_env={"FAKE_DICT_LOG": log})
check("inject: bad database rejected",
      status == 200 and "Unknown database:" in body
      and expect_no_file(mark))

# User-Agent must arrive as data, never as shell code.
mark = touch("pwn-ua")
log = argv_log()
status, headers, body, _ = run_cgi(
    "Form=Dict1&Query=hello&Strategy=*&Database=alpha",
    extra_env={"FAKE_DICT_LOG": log,
               "HTTP_USER_AGENT": "$(touch pwn) `id` \"quoted\""})
recs = query_recs(log)
check("inject: UA no side effect", expect_no_file(mark))
check("inject: UA passed as single argv element",
      len(recs) == 1 and
      recs[0][recs[0].index("--client") + 1] ==
      "203.0.113.7 $(touch pwn) `id` \"quoted\"", repr(recs))

# Bad REMOTE_ADDR is dropped from the client string.
log = argv_log()
status, headers, body, _ = run_cgi(
    "Form=Dict1&Query=hello&Strategy=*&Database=alpha",
    extra_env={"FAKE_DICT_LOG": log, "REMOTE_ADDR": "999.999.1.1; rm -rf /"})
recs = query_recs(log)
check("inject: bad REMOTE_ADDR dropped",
      len(recs) == 1 and
      recs[0][recs[0].index("--client") + 1] == "DictTest/1.0", repr(recs))

#
# 5. XSS
#

status, headers, body, _ = run_cgi(
    "Form=Dict1&Query=%3Cscript%3Ealert(1)%3C%2Fscript%3E"
    "&Strategy=*&Database=alpha")
check("xss: 200", status == 200)
check("xss: title escaped",
      "<title>dict.org- &lt;script&gt;alert(1)&lt;/script&gt;</title>" in body)
check("xss: form value escaped",
      'value="&lt;script&gt;alert(1)&lt;/script&gt;"' in body)
check("xss: no raw script tag from query",
      "<script>alert(1)" not in body)

#
# 6. POST handling
#

log = argv_log()
status, headers, body, _ = run_cgi(
    body="Form=Dict1&Query=hello&Strategy=*&Database=alpha", method="POST",
    extra_env={"FAKE_DICT_LOG": log})
check("post: 200", status == 200)
check("post: query executed",
      len(query_recs(log)) == 1 and query_recs(log)[0][-1] == "hello")
check("post: results present", "1 definition found" in body)

log = argv_log()
status, headers, body, _ = run_cgi(
    body="A" * 70000, method="POST",
    extra_env={"FAKE_DICT_LOG": log})
check("post: oversize body -> 413", status == 413, "status=%d" % status)

status, headers, body, _ = run_cgi(query="Form=Dict1&Query=hello",
                                   method="PUT")
check("method: PUT -> 405", status == 405 and "GET, POST" in body + headers.get("allow", ""),
      "status=%d" % status)

status, headers, body, _ = run_cgi(body="A" * 1000, method="PUT")
check("method: PUT with body -> 405 (body drained)",
      status == 405, "status=%d" % status)

status, headers, body, _ = run_cgi(
    body="Form=Dict1", method="POST",
    extra_env={"CONTENT_LENGTH": "not-a-number"})
check("post: bad content-length -> 400", status == 400, "status=%d" % status)

#
# 7. Validation / error pages
#

status, headers, body, _ = run_cgi("Form=Dict9&Query=hello")
check("error: invalid form",
      status == 200 and "Error, invalid syntax: Dict9" in body
      and 'name="DICT"' in body)

status, headers, body, _ = run_cgi("Form=Dict1&Database=alpha&Strategy=*")
check("error: missing query", "Query is required." in body)

status, headers, body, _ = run_cgi(
    "Form=Dict1&Query=hello&Strategy=*&Database=nope")
check("error: unknown database", "Unknown database: nope" in body)

#
# 8. Dict3 / Dict4
#

log = argv_log()
status, headers, body, _ = run_cgi(
    "Form=Dict3&Database=alpha", extra_env={"FAKE_DICT_LOG": log})
recs = query_recs(log)
check("dict3: 200", status == 200)
check("dict3: argv -i", len(recs) == 1 and "-i" in recs[0]
      and "alpha" in recs[0] and "-d" not in recs[0], repr(recs))
check("dict3: db info rendered",
      "  ============ alpha ============\n" in body
      and '<a href="ftp://ftp.example.org/dict/alpha">'
      "ftp://ftp.example.org/dict/alpha</a>" in body)
check("dict3: title plain", "<title>dict.org</title>" in body)

log = argv_log()
status, headers, body, _ = run_cgi(
    "Form=Dict4", extra_env={"FAKE_DICT_LOG": log})
recs = query_recs(log)
check("dict4: 200", status == 200)
check("dict4: argv -I", len(recs) == 1 and "-I" in recs[0]
      and "-d" not in recs[0], repr(recs))
check("dict4: server info rendered", "dictd 1.14/test-stub" in body)

#
# 9. No matches
#

status, headers, body, _ = run_cgi(
    "Form=Dict1&Query=nomatch&Strategy=*&Database=alpha")
check("nomatch: bold message",
      re.search(r"</pre><b>No definitions found for &quot;nomatch&quot;\n"
                r"</b><pre>", body) is not None)

status, headers, body, _ = run_cgi(
    "Form=Dict1&Query=nolist&Strategy=prefix&Database=alpha")
check("nomatch: strategy no matches",
      re.search(r"</pre><b>No matches found for &quot;nolist&quot;\n"
                r"</b><pre>", body) is not None)

#
# 10. Backend failure and fallback
#

status, headers, body, _ = run_cgi(
    "Form=Dict1&Query=hello&Strategy=*&Database=alpha",
    extra_env={"DICT_BIN": "/nonexistent/dict"})
check("backend: dead client -> error message",
      status == 200 and "Backend database engine error" in body)
check("backend: form still shown with builtins",
      'name="DICT"' in body
      and '<option value="alpha"' not in body)

log = argv_log()
status, headers, body, _ = run_cgi(
    "Form=Dict1&Query=hello&Strategy=*&Database=alpha",
    extra_env={"FAKE_DICT_LOG": log, "DICT_SERVERS": "badhost,localhost"})
recs = query_recs(log)
check("backend: fallback to second server",
      status == 200 and "Using backup server..." in body
      and len(recs) == 2
      and recs[0][recs[0].index("-h") + 1] == "badhost"
      and recs[1][recs[1].index("-h") + 1] == "localhost",
      repr(recs))

log = argv_log()
status, headers, body, _ = run_cgi(
    "Form=Dict1&Query=hello&Strategy=*&Database=alpha",
    extra_env={"FAKE_DICT_LOG": log, "FAKE_DICT_SLEEP": "3",
               "DICT_TIMEOUT": "1"})
check("backend: timeout -> error message",
      status == 200 and "Backend database engine error" in body,
      body[:200])

#
# 11. Dict2 forces strategy "*"
#

log = argv_log()
status, headers, body, _ = run_cgi(
    "Form=Dict2&Query=hello&Database=alpha",
    extra_env={"FAKE_DICT_LOG": log})
recs = query_recs(log)
check("dict2: strategy forced",
      len(recs) == 1 and "-s" not in recs[0] and "-m" not in recs[0], repr(recs))
check("dict2: form shows strategy selected",
      '<option value="*" selected>Return Definitions' in body)

#
# Summary
#

print()
if FAILURES:
    print("%d test(s) FAILED: %s" % (len(FAILURES), ", ".join(FAILURES)))
    sys.exit(1)
print("All tests passed.")

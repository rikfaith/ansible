<?php // -*- html -*-
// Created: Sat Oct 13 08:38:50 2001 by faith@dict.org
// Revised: Sun Jan  9 14:26:47 2005 by faith@dict.org
// $Id$

// Break out of other people's frames
header( "Window-target: _top" );
putenv("PATH=/usr/local/bin:/usr/bin:/bin");
$REQUEST_URI=$_SERVER['REQUEST_URI'];

function getnote($image)
{
    $note = shell_exec("rdjpgcom " . escapeshellarg($image));
    $note = ereg_replace(" Copyright [0-9]* Melissa Clepper-Faith;",
                         "", $note);
    return $note;
}

function getname($image)
{
    $note = shell_exec("rdjpgcom " . escapeshellarg($image));
    return trim(strtok($note, ";"));
}

function getindex($src)
{
    $idx = ereg_replace("^/(small|thumb)-", "", trim($src));
    return trim(str_replace(".html", "", $idx));
}

function getthumb($idx)
{
    return "images/thumb-" . trim($idx) . ".jpg";
}

function getsmall($idx)
{
    return "images/small-" . trim($idx) . ".jpg";
}

function getsmallhtml($idx)
{
    return "small-" . trim($idx) . ".html";
}

function getheight($image)
{
    $info = shell_exec("identify " . escapeshellarg($image));
    return trim(preg_replace("/.* [0-9]+x([0-9]+)[^0-9].*/", "\$1", $info));
}

function getwidth($image)
{
    $info = shell_exec("identify " . escapeshellarg($image));
    return trim(preg_replace("/.* ([0-9]+)x[0-9]+[^0-9].*/", "\$1", $info));
}

function getprevnext($idx, &$prev, &$next)
{
    $prev = "";
    $next = "";
    $state = 0;
    if (!($fp = fopen("../support/layout.txt", "r"))) return;
    while ($line = fgets($fp)) {
        list($page, $tok) = split(" ", $line);
        if ($state) {
            $next = trim($tok);
            fclose($fp);
            return;
        }
        if (!strcmp(trim($tok), $idx)) $state = 1;
        else                           $prev = trim($tok);
    }
}

    $browser = $_SERVER['HTTP_USER_AGENT'];
    $MSIE    = stristr($browser, "MSIE") || stristr($browser, "Internet Explorer");
    $Opera   = stristr($browser, "Opera");
    $Moz4    = stristr($browser, "Mozilla/4");
    $Gecko   = stristr($browser, "Gecko");
    $NN4     = ($Moz4 && !$MSIE && !$Gecko && !$Opera);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="keywords" content="Melissa Clepper-Faith, Fine Art">
    <title>
      Melissa Clepper-Faith<?php echo ( defined('title') ? ": $title" : "");?>
    </title>
  </head>
  <body text="white" bgcolor="black"
    link="#0000ff" vlink="#7733aa" alink="#ff0000">
    <h1>
      &nbsp;<br>
      Melissa Clepper-Faith
    </h1>
    Fine Art
    <hr size="1" noshade>
    <table width="100%" cellpadding="0" cellspacing="0" align="center">
      <tr>
        <td align="left" valign="top">
          <p>
            &nbsp;
            <?php
            $pages=array("home", "page 2", "page 3", "page 4", "biography", "pricelist");
            $mystring=substr(rawurldecode($REQUEST_URI), 1);
            if ("$mystring" == "index.html") $mystring = "home.html";
            if ("$REQUEST_URI" == "/") $mystring = "home.html";
            foreach ($pages as $page) {
		if (!strcmp($page . ".html", $mystring)) {
                    print "<p><font color=\"#ff0000\">"
                          . ucfirst($page)
                          . "</font>";
                } else {
                    print "<p><a href=\"/$page.html\">"
                          . ucfirst($page)
                          . "</a>\n";
                }
            }
            ?>
          <p>
            &nbsp;
          <p>
        </td>
        <td width=10>&nbsp;</td>
        <td align="left" valign="top">

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Project P1</title>
<style type="text/css">
<!--
li {
	font-family: Arial, Helvetica, sans-serif;
}
td {
	font-family: Arial, Helvetica, sans-serif;
}
-->
</style>
<link href="../styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
	require("pixsmall.php");
?>
<table width="768">
  <tr>
    <td colspan="2"><a href="../index.html"><img src="../hybridsky.png" width="499" height="112" border="0" /></a> </td>
  </tr>
  <tr>
    <td  align="center"><h3><a href="index.html">GSE, Instrumentation and Test Equipment</a></h3>
      <h2>Digital Data Acquisition (DAQ) System </h2>
      <p>Last Update, May 3, 2009, by Stephen Daniel </p></td>
  </tr>
  <tr>
    <td><h3>Connectors </h3>
<pre>	
GSE Power:
 1: +12V
 2: Ground
 3: NC
 4: NC
<br />
GSE Valves:
 1: +12V
 2: Ground (switched)
 3: NC
 4: NC
<br />
DAQ power:
 1: Ground
 2: +9V
 3: -9V
 4: NC
<br />
Pressure transducers, DAQ In0 and In1
 1: Ground
 2: +5V
 3: signal
 4: NC
<br />
Load cell, DAQ In2
 1: -5V
 2: +5V
 3: signal+
 4: signal-
<br />
DAQ optocouplers
 1: Opto1
 2: Opto1
 3: Opto0
 4: Opto0
<br />
DAQ raw
 1: Ground
 2: Raw0
 3: Raw1
 4: NC
<br />
DAQ USB
 1: Ground
 2: +5V
 3: D+
 4: D-
</pre>
    </td>
  </tr>
</table>
</body>
</html>

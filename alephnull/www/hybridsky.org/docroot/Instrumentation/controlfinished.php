<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Launch Control Finished</title>
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
<table width="800">
  <tr>
    <td colspan="2"><a href="../index.html"><img src="../hybridsky.png" width="499" height="112" border="0" /></a> </td>
  </tr>
  <tr>
    <td  align="center"><h3> <a href="../p1/index.html">P1</a>: Nitrous at Balls in '08</h3>
      <h2><a href="control.html">Hybrid Launch Control</a></h2>
      <p>Last Update, 5/30/08 by Stephen Daniel </p></td>
  </tr>
  <tr>
    <td><h3>Launch Control  Finished Product </h3>
      <p>This page shows the finished launch control system.</p>
      <table>
        <tr>
          <td width="256"><?php thumbnailreference("S6300361", 2); ?>
            <p>Finished system, including 300' cable, control box, and break-out box. </p></td>
          <td width="256"><?php thumbnailreference("S6300362", 2); ?>
            <p>Break-out box, showing connectors for 7 channels, power, and control cable. The indicator LEDs for each channel are well below the connector.</p></td>
          <td width="256"><?php thumbnailreference("S6300363", 2); ?>
            <p>Detail of the control box, showing control switches, connectors for the control cable, power switch and safe/arm switch for the launch control. </p></td>
        </tr>
        <tr>
          <td width="256"><?php thumbnailreference("S6300365", 2); ?>
            <p>Detail of the inside of the breakout box. Shows the main circuit board and interconnect wiring. MOSFET heat sinks are clearly visible. </p></td>
          <td width="256"><?php thumbnailreference("S6300370", 2); ?>
          <p>Another view of the interior of the break-out box showing how the PC board is mounted. </p></td>
          <td width="256"><?php thumbnailreference("S6300372", 2); ?>
          <p>This photo shows the box assembly. The panels were fabricated by Front Pannel Express. The back side of the box is a lightweight aluminum chassis from Digikey. Holes in the box were drilled to match the panel holes. Weldnuts were glued into place to complete the fabrication. </p></td>
        </tr>
      </table>
      <h3>Final Notes</h3>
      <p>The system has been working very well over the past year. A couple of minor nits:</p>
      <ul>
        <li>The LEDs in the control box were originally mounted using hot glue. This proved to be not very durable. We are switching to panel mounts for those LEDs. (This also applies to the power indicator LED in the breakout box.) </li>
        <li>It is pretty easy to blow the fuse. Replacement fuses can be purchased at an auto-parts store. Keep plenty on hand.</li>
        <li>There is cross-talk between the channels, probably due to routing each signal down one wire of a twisted pair in the control cable. The result is that when you enable one channel one of the other channels will flash very briefly. We believe we could fix this with some sort of delay / shaping circuit, but we haven't bothered. No practical reason for doing so. </li>
      </ul></td>
  </tr>
</table>
</body>
</html>

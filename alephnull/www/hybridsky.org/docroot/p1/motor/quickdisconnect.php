<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Nitrous Quick Disconnect</title>
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
<table width="720">
  <tr>
    <td><a href="../../index.html"><img src="../../hybridsky.png" width="499" height="112" border="0" /></a></td>
  </tr>
  <tr>
    <td  align="center"><h3> <a href="../index.html">P1</a>: Nitrous at Balls in '09</h3>
      <h2><a href="index.html">Motor Project</a></h2>
      <h3><a href="plumbing.php">Plumbing</a></h3>
      <h3>Quick Disconnect Design and Implementation </h3>
      <p>Last Update, 10/25/07 by Stephen Daniel </p></td>
  </tr>
  <tr>
    <td><h3>Design Goals </h3>
      <p>We need a way to fill the nitrous  flight tank from a nitrous supply that may be pressurized as high as 750 PSI. Once the flight tank is full no human may approach the rocket, so we need a way to disconnect the fill line remotely. </p>
      <table width="100%" cellspacing="3">
        <tr>
          <td><h4>Design </h4>
            <p>The basic design has two parts. The female fitting is built into the rocket. The fitting is a piece of machined aluminum bar stock. At one end is a hole drilled and tapped for a 1/8&quot; NPT fitting. The other end has a hold drilled large enough for a piece of 1/4&quot; copper tube, plus an o-ring seal.</p>
            <p>A crude drawing of this fitting is avaliable <a href="QD.pdf">here</a>. </p>
            <p>A 1/8&quot; NPT check-valve is screwed into one end of the fitting.</p>
            <p>The male piece of this fitting is a 1/4&quot; copper tube smoothed at the open end, and connnecting to a compression fitting and hose to the supply tank.</p>
            <p>The open end of the female fitting mounts flush with a hole in the side of the rocket. When the copper fill tube is inserted the fitting makes a pressure-tight seal.</p>
            <p>The copper tube fitting is kept in place with an 8&quot; piece of thin-gauge piano wire, tightened with cable ties around the rocket. When we are ready to disconnect the fill line, a 12-volt high-current source is connected across the piano wire, melting it. The residual pressure in the fill line is enough to blow the copper tube fitting out of the rocket.<br />
            </p>            </td>
          <td width="256"><?php thumbnailreference("S6300153", 2); ?>
          <p>The quick-disconnect under pressure, ready to fire. The aluminum fitting is custom made, the rest is off-the-shelf brass.</p>
          <p>The screw on the right-hand side is a tensioner for the string.  </p></td>
        </tr>
        <tr>
          <td colspan="2"><p>This system has been used successfully on the Mark-IIId PVC hybrid motor to fill tanks with nitrous. Tests of the Mark-IIId have been conducted using nitrous up to 625 PSI and the quick-disconnect has performed flawlessly in all tests.. </p>
            <p>The piano wire has a measured resistence of about 0.5 ohms, so the control circuit must be capable of a surge current of at least 30 amps. Our controller uses 90 amp MOSFETS as the control. Our control box is fused at 20 amps, but the piano wire blows long before the fuse.</p>
            <p>Note: we protect the rocket body tube from damage by the melting piano wire using a short length of high-temperature fibre-glass sleeve between the wire and the body.</p>
            <p>The sleeve is McMaster Carr part XXXX </p>
            <p>The piano wire is McMaster Carr part <a title="Add item to current order" target="ResultsIFrame" href="http://www.mcmaster.com/itm/find.asp?searchstring=9666K17&amp;sesnextrep=433769538815954&amp;tab=find&amp;FastTrack=False&amp;WRCntxt=OrdHist" onmouseover="return Cmn.SetWndwStat('Add item to current order')" onclick="return Cmn.SetWndwStat('')" onmouseout="return Cmn.SetWndwStat('')">9666K17</a></p>
            <p>The 1/8 NPT check-valve is McMaster Carr part <a title="Add item to current order" target="ResultsIFrame" href="http://www.mcmaster.com/itm/find.asp?searchstring=46105K61&amp;sesnextrep=433769538815954&amp;tab=find&amp;FastTrack=False&amp;WRCntxt=OrdHist" onmouseover="return Cmn.SetWndwStat('Add item to current order')" onclick="return Cmn.SetWndwStat('')" onmouseout="return Cmn.SetWndwStat('')">46105K61</a></p>
            <p>The o-ring is a -010 viton o-ring, McMaster Carr part <a title="Add item to current order" target="ResultsIFrame" href="http://www.mcmaster.com/itm/find.asp?searchstring=9464K15&amp;sesnextrep=433769538815954&amp;tab=find&amp;FastTrack=False&amp;WRCntxt=OrdHist" onmouseover="return Cmn.SetWndwStat('Add item to current order')" onclick="return Cmn.SetWndwStat('')" onmouseout="return Cmn.SetWndwStat('')">9464K15</a></p>
            <p>The GSE control system is described <a href="../../Instrumentation/control.html">here</a>. </p>
            <p>&nbsp;</p></td>
        </tr>
        <tr>
          <td colspan="2">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>

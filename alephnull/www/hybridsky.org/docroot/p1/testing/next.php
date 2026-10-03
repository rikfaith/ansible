<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Project P1: Third Hot Fire Test</title>
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
<link href="../../styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
	require("pixsmall.php");
?>
<table width="640">
  <tr>
    <td><a href="../../index.html"><img src="../../hybridsky.png" width="499" height="112" border="0" /></a></td>
  </tr>
  <tr>
    <td  align="center"><h3> <a href="../index.html">P1</a>: Nitrous at Balls in '09</h3>
      <h2><a href="index.html">Testing</a></h2>
      <h3>Sixth Hot Fire Test Day</h3>
      <p>Tests 12, 13, and 14 </p>
      <p>Last Update, 6/6/09 by Stephen Daniel </p></td>
  </tr>
  <tr>
    <td><h3>Contents</h3>
      <ul>
        <li><a href="#Plan">Test Plan</a></li>
        <li><a href="#Pretest">Pre-Test Work</a> </li>
        <li><a href="#Results">Results</a> </li>
      </ul>
      <h3>Summary of Results</h3>
      <p>Still in planning phase. </p>
      <h3><a name="Plan" id="Plan"></a>Test Plan</h3>
      <h4>Goals for this test:</h4>
      <ul>
        <li>Achieve stable burn at something close to design performance. </li>
        <li>Gather accurate data on both chamber and flight tank pressure. </li>
      </ul>
      <p>Based on analysis of our last test, we've made these decisions.</p>
      <ul>
        <li>We will continue to use the <a href="../motor/pyrovalve.php">version 4 pyrovalve</a>, unchanged.</li>
        <li>We will shift from ABS pipe to a fuel grain made from cast PBAN. </li>
      </ul>
      <h4>Schedule</h4>
      <p>Test day confirmed for Monday, May 25 </p>
      <p>Goal would be to arrive at 10:30, push the button at 11:30. </p>
      <h3><a name="Pretest" id="Pretest"></a>Pretest Work</h3>
      <h4>Pyro-valves</h4>
      <p>Built 3 pyrovalves, <a href="../motor/pyrovalve.php">model 4</a>, serial numbers 3, 4, and 5. </p>
      <p>Fab notes:</p>
      <ul>
        <li>Used 81g resin, 27g medium cure hardner, and 36g milled glass for each valve.</li>
        <li>SN3 was not degassed after pouring. It was cold and I needed it on a setup I could move inside. Unfortunately the forward face is not at flat as it should be.</li>
        <li>Evan put extra attention to degassing SN5. Had some trouble with the acetate ring inside the mold, which made the edges a bit rough.</li>
        <li>All 3 rings were dressed with a Dremel sanding cylinder. </li>
      </ul>
      <h4>Hydrotesting</h4>
      <p>No hydrotesting is planned. </p>
      <h4>Fuel Grains</h4>
      <p>We have cast 3 PBAN fuel grains. Discussion is <a href="../motor/pban3.php">here</a>. </p>
      <p>Fab notes:</p>
      <ul>
        <li>The first batch stuck to the mandrels. Second batch uses heavy plastic film wrapping the mandrels, which solved that problem. The PBAN is sticky to the touch and not very strong. We should consider adding solids next time.</li>
        <li>Measured PBAN, DER331 and carbon black was as per recipe. Added about 10 drops siliocon oil in an attempt to defoam. Didn't work very well.</li>
        <li>Vacuum degassed to 29+1/4&quot; mercury. Still doubled in volume at that pressure. </li>
        <li>A small amount of PBAN leaked out during curing. Thus one end of each grain has sticky residue. Plan is put that forward to avoid getting that stuff in the chamber pressure sensor plumbing.</li>
        <li>I did not cut a notch for the chamber pressure sensor. The end of the PVC is rough enough that I am sure pressure will equalize quite quickly. </li>
      </ul>
      <h4>Weights and Measures</h4>
      <ul>
        <li>All three pyrovalves measure 39/64&quot; thick.</li>
        <li>All three grains are 9+1/16&quot; long (PVC portion).</li>
        <li>Grain 4 was used in tests 12 and 13. Grain 5 was used in test 14.</li>
        <li>The length (below) is the length of the PBAN core.   </li>
      </ul>
      <table>
        <tr>
          <td width="24">&nbsp;</td>
          <td><table>
              <tr>
                <td>Grain</td>
                <td>Pre-cast weight</td>
                <td>PVC + PBAN weight</td>
				<td>Length</td>
                <td>Post burn weight</td>
              </tr>
              <tr>
                <td><div align="center">4</div></td>
                <td><div align="center">347.4g</div></td>
                <td><div align="center">849.5g</div></td>
				<td><div align="center">7-1/8"</div></td>
                <td><div align="center">730.0g</div></td>
              </tr>
              <tr>
                <td><div align="center">5</div></td>
                <td><div align="center">345.9g</div></td>
                <td><div align="center">843.0g</div></td>
				<td><div align="center">7-3/8"</div></td>
                <td><div align="center">747.0g</div></td>
              </tr>
              <tr>
                <td><div align="center">6</div></td>
                <td><div align="center">347.6g</div></td>
                <td><div align="center">863.0g</div></td>
                <td><div align="center"></div></td>
                <td><div align="center"></div></td>
              </tr>
          </table></td>
        </tr>
      </table>
      <h4>Nitrous Supply</h4>
      <ul>
        <li>We'll be running off the main tank, with ice to cool. Should be plenty. </li>
      </ul>
      <h4>Data Capture</h4>
      <p>DAQ system is running. Enhancements since last run:</p>
      <ul>
        <li>Manual trigger off an unused GSE channel.</li>
        <li>External, very bright LED, intended as visual confirmation of trigger.</li>
        <li>A second pressure sensor, monitoring pressure on flight tank. </li>
        <li>Much stronger and better built external power supply. </li>
      </ul>
      <h3><a name="Results" id="Results"></a>Results</h3>
      <h4>Test 12</h4>
      <ul>
        <li>.Engine failed to ignite and dumped cold nitrous, slowly</li>
      </ul>
      <p>Analysis:</p>
      <ul>
        <li>The 1/8&quot; deep cut made in the forward face of the pyrovalve was not filled with silicon grease. Apparently this was enough volume of liquid nitrous that when the pyrovalve developed a small hole the available liquid nitrous quenched the pyrovalve. </li>
      </ul>
      <h4>Test 13</h4>
      <ul>
        <li> Successful ignition.</li>
        <li>Pyrovalve opened a bit slowly (nearly 0.5 seconds total opening time.) This doesn't appear to have had a material impact on motor performance.</li>
        <li>The pyrovalve slug did not come out as an intact piece, not did it appear to damage the nozzle. Our theory is that the smaller, softer fuel grain core  provided a more directed path for the slug. The slug was completely burned up after the test, suggesting that the slow exit allowed the slug to keep burning.</li>
        <li>We cooked the GSE drive transistor that drives the ignition circuit. Our hypothesis is that we had a short circuit after ignition. This could have come from plasma completing the gap where the resistor burned or from the sparklers cooking off the insulation on the sparkler igniter wire.</li>
        <li>We may have cooked the chamber pressure sensor. The masking tape used to hold the sparklers in place caught fire and possibly cooked the sensor.</li>
        <li>The flight tank pressure sensor appears to have temperature compensation issues. We don't trust if other than for initial flight tank pressure.  </li>
      </ul>
      <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>

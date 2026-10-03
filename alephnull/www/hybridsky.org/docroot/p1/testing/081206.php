<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Project P1: Fourth Hot Fire Test</title>
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
      <h2><a href="index.html">Testing</a> </h2>
      <h3>Fourth Hot Fire Test </h3>
      <p>Last Update, 12/13/08 by Stephen Daniel </p></td>
  </tr>
  <tr>
    <td><h3>Contents</h3>
      <ul>
        <li><a href="#Plan">Test Plan</a></li>
        <li><a href="#Pretest">Pre-Test Work</a> </li>
        <li><a href="#Results">Results</a> </li>
      </ul>
      <h3>Summary of Results</h3>
      <p>Tests 8 and 9 failed. In both cases the pyro-valve let go before ignition. </p>
      <h3><a name="Plan" id="Plan"></a>Test Plan</h3>
      <h4>Goals for this test:</h4>
      <ul>
        <li>Reliable ignition. </li>
        <li>Achieve stable, burn at something close to design performance. </li>
        <li>Gather accurate data. </li>
      </ul>
      <p>Based on analysis of our last test, we've made these decisions.</p>
      <ul>
        <li>For now we will stick with using commercially available sparklers as the ignition source. At some point in the future we'll experiment with adding magnesium chips to the pyro-valve to see if that is sufficient to ignite the motor. However that optimization remains low on our priority list.</li>
        <li>We have tweaked the pyro-valve design. We are now up to version 3. See the <a href="../motor/pyrovalve.php">design page</a> for more details. </li>
        <li>We'd really like to get away from PVC as a fuel. However we don't have the time to develop PBAN grains. Plan for this test is to use a 12&quot; piece of 3&quot; ABS pipe as the fuel grain.</li>
        <li>We have worked with Mike to machine the injector and forward bulkheads for easier assembly and disassembly. </li>
      </ul>
      <h4>Weights and Measures</h4>
      <ul>
        <li>We will run off Mike's 15 lb Nitrous tank for this test. Tank currently holds 13.9 lbs. Ullage is estimated at 2.5 lb. </li>
        <li>Pyro-valve material was measured at 0.43&quot; thick on both valves. </li>
        <li>Fuel grains were made by cutting pipe stock to 11.75&quot; long (all 3 grains).  Grains were shimmed with felt stick-ons designed to make furniture not mar hardwood floor.
          <ul>
            <li>ABS #1 is 337.0g</li>
            <li>ABS #2 is 339.3g</li>
            <li>PVC is 454.2g</li>
          </ul>
        </li>
        <li>Nitrous tank is 7.35&quot; from forward end of injector bulkhead to aft edge for forward snap-ring groove. This gives an estimated tank volume of 1.094 liters. This is based on measured 1483 ml of volume with a 9.5&quot; grain and a .7&quot; thick pyro-valve. We are using a 11.75&quot; grain and a .7&quot; valve. </li>
        <li>Simulation predicts a 2 second burn, K-1000. </li>
      </ul>
      <h3><a name="Results" id="Results"></a>Results</h3>
      <p><img src="pixlarge/S6300512.JPG" alt="Cold Nitrous Flow" width="640" height="480" /></p>
      <p>Pyro-valve failure during test 8. </p>
      <h4>Test 8</h4>
      <table>
        <tr>
          <td><p>Began loading nitrous at 11:30. Filled until we were venting liquid. While waiting for the tank to chill the pyro-valve popped, dumping all of the nitrous.</p>
            <p>The pyro-valve material apparently hit the forward edge of the nozzle, chipping a chunk out of the nozzle. This damage appears to be mostly cosmetic.</p>
            <p>A 12 second movie of test 8 is <a href="test8.wmv">available here</a> (4 MB download size). </p></td>
          <td><?php thumbnailreference("S6300529", 2); ?>
            <p>Chipped forward edge of nozzle</p></td>
        </tr>
      </table>
      <h4>Test 9 </h4>
      <table>
        <tr>
          <td><p>Began loading nitrous around 1:15. The results were approximately the same. The valve failed a little earlier in the sequence, after the relief valve cracked open but before venting liquid. There was no further damage to the nozzle. </p>
            <p>A total of 3.7 lb of nitrous was consumed by these two tests.</p></td>
          <td><?php thumbnailreference("S6300513", 2); ?>
            <p>Setting up for test 9.</p></td>
        </tr>
      </table>
      <h4>Data Acquisition</h4>
      <p>The one bright spot in this test was the success of our new data acquisition system.</p>
      <p>We did not capture data from test 8 because the data capture system was set to begin recording when the ignition sequence began. For test 9 we set the system to begin recording when pressure was detected in the chamber.</p>
      <p><img src="chamberpressure.gif" alt="Chamber Pressure Graph" width="704" height="595" /> </p>
      <h4>Analysis</h4>
      <p>The pyro-valve failed mostly by delamination. The valve material failed to adhere to the fiberglass disk that holds it. </p>
      <table>
        <tr>
          <td><?php thumbnailreference("S6300518", 2); ?></td>
          <td><?php thumbnailreference("S6300520", 2); ?></td>
          <td><?php thumbnailreference("S6300516", 2); ?></td>
        </tr>
        <tr>
          <td colspan="3"><p>Failed pyro-valve.  Notice evidence of delamination and cracking.</p></td>
        </tr>
      </table>
      <p>During manufacture of the valve the circular cut on the forward face of the valve was very carefully centered to ensure no chance of having it misaligned with the face-sealing o-ring in the injector bulkhead. Less care was taken centering the mandrel that defines the hole in the fiberglass for the pyro material. As a result the circular cut is sometimes tangent to the edge of the hole in the fiberglass. Indeed on one of the valve it is apparent that the cut went slightly into the fiberglass.</p>
      <p>I believe the valve failed by delamination starting where the cut touched fiberglass. The delamination goes most of the way around, but there are some places where the pyro material broke rather than delaminating.</p>
      <p>Both fiberglass disks were cracked by the failures. I believe the crack come from the mechanical stress of the pyro material coming out of the valve asymmetrically. </p>
      <h4>Corrective Action</h4>
      <p>More adjustments to the pyro-valve design are called for. Details are shown <a href="../motor/pyrovalve.php">here</a>.</p>
      <p>Next test will be soon. Details <a href="081229.php">here</a>. </p>
      <p>&nbsp; </p>
      <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>

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
      <h2><a href="index.html">Testing</a> </h2>
      <h3>Third Hot Fire Test </h3>
      <p>Last Update, 5/30/08 by Stephen Daniel </p></td>
  </tr>
  <tr>
    <td><h3>Contents</h3>
      <ul>
        <li><a href="#Plan">Test Plan</a></li>
        <li><a href="#Pretest">Pre-Test Work</a> </li>
        <li><a href="#Results">Results</a> </li>
      </ul>
      <h3>Summary of Results</h3>
      <p>We conducted 2 tests. One the second test we achieved successful ignition. The burn was rough and our data is incomplete, but we think we've solved our ignition problems. </p>
      <h3><a name="Plan" id="Plan"></a>Test Plan</h3>
      <p>Goals for this test:</p>
      <ul>
        <li>Achieve successful ignition </li>
      </ul>
      <p>We've redesigned the pyro-valve with two goals. One is to ensure it cleanly opens all injector holes simultaneously . The second is to ensure that some part of it remains burning. </p>
      <h3><a name="Pretest" id="Pretest"></a>Pretest Work</h3>
      <h4>Pryovalves</h4>
      <p>I built three new pyrovalves. These are designated version 2 of the valves, and are documented on the <a href="../motor/pyrovalveV2.php">pyrovalve version 2 page</a>. </p>
      <p>These valves feature ingiters, which are small tubes of RNX that are not functioning as valves and are outside the flow of nitrous, and a carefully built valve designed to break away cleanly. </p>
      <h4>Weights and Measures</h4>
      <ul>
        <li>Grain #1
          <ul>
            <li>3&quot; PVC pipe </li>
            <li>Length 12-3/8&quot;</li>
            <li>Weight 745g</li>
          </ul>
        </li>
        <li>Grain #2
          <ul>
            <li>3&quot; PVC pipe</li>
            <li>Length 9-1/2&quot;</li>
            <li>Weight 573.3g </li>
          </ul>
        </li>
        <li>New valves
          <ul>
            <li>Thickness about 0.7 inches. </li>
          </ul>
        </li>
      </ul>
      <h3><a name="Results" id="Results"></a>Results</h3>
      <h4>Test 6 </h4>
      <p>Our first test of the day was the 12&quot; long, 3&quot; diameter fuel grain, and the new, larger pyrovalve.</p>
      <p>The basic result was unchanged, no ignition. The valve redesign worked, in that the valve appeared to open abruptly and the igniters stayed burning throughout the run, but the nitrous dumped cold, without igniting. </p>
      <h4>Test 7 </h4>
      <table>
        <tr>
          <td><p>At Evan's suggestion we added a bundle of 3 common fire-works sparklers to the combustion chamber. These were lit by a resistor/pyro-goop combination at the same time as the pyrovalve was lit. </p>
            <p>We resused the same, 12&quot; grain.</p></td>
          <td width="256"><?php thumbnailreference("dscn4631", 2); ?></td>
        </tr>
      </table>
      <p>Ignition! </p>
      <p>We had two cameras capturing video of this burn. My camera's video is here, while Riks' is here. </p>
      <p>We got some pressure trace data from this run, but not a full reading.</p>
      <p><img src="test7short.gif" alt="Pressure Trace" width="622" height="489" /></p>
      <p>There are several features of this graph worth noting.</p>
      <ul>
        <li>The slight dip in pressure at t=0.025 seconds. One theory is that this happens as the sparklers are kicked out the nozzle, removing a small obstruction to the airflow. However the movie from Rik's camera shows the motor flares brightly for one frame before the burn builds up. This effect is not visible on the other camera. So a second theory is that ignition is hard enough to  very briefly interrupt the flow of nitrous.</li>
        <li>The gentle decline in pressure from about 0.2 seconds to 0.6 seconds. This is the expected result of the nitrous pressure dropping as the tank is emptied. </li>
        <li>The pressure rise from ~100 PSI to ~120 PSI that happens begining at t=0.67 seconds. Our theory is that this represents one (or more?) injector holes becoming uncovered as the pryovalve burns away.</li>
        <li>The pressure spike that happens at t=0.81 seconds. Evan's theory is that this represents a temporary and partial occlusion of the nozzle, possible caused by ejecting a large piece of unburnt pyrovalve material.</li>
        <li>The pressure trace ends abruptly after less than 1.1 seconds. This is a failure of the data capture system. This is consistent with the observation from my camera that the cardboard box protecting the data capture system is blown away early in the burn. </li>
      </ul>
      <p>Other results:</p>
      <ul>
        <li>From the audio we believe the burn was about 2.3 seconds long.</li>
        <li>Apparent maximum sustained chamber pressure was about 120 PSI guage or 135 absolute.</li>
        <li>We burned about 143g of PVC pipe. This is very, very approximate as we did not measure between tests, nor did we account for some of the paper burning away. </li>
      </ul>
    <p>Predicted results:</p>
    <ul>
      <li>Predicted burn time was 1.58 seconds.</li>
      <li>Predicted maximum chamber pressure was 245 PSI absolute.</li>
      <li>Predicted fuel consumption was 96g.</li>
      </ul>
    <p>If I drop the injector CD from 0.7 to 0.4 in the simulator then burn time rises to 2.25 seconds, maximum chamber pressure drops to 175 PSI, and predicted fuel consumption rises to 108g.</p>
    <p>I can also leave the injector CD at 0.7 and reduce the number of injector holes from 8 to 6. This gives a burn time of 1.87 seconds, a maximum pressure of 208 PSI and a fuel consumption of 102g.</p>
    <p>&nbsp; </p></td>
  </tr>
</table>
</body>
</html>

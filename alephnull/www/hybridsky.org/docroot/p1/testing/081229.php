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
      <h3>Fifth Hot Fire Test </h3>
      <p>Last Update, 1/1/09 by Stephen Daniel </p></td>
  </tr>
  <tr>
    <td><h3>Contents</h3>
      <ul>
        <li><a href="#Plan">Test Plan</a></li>
        <li><a href="#Pretest">Pre-Test Work</a> </li>
        <li><a href="#Results">Results</a> </li>
      </ul>
      <h3>Summary of Results</h3>
      <p><img src="pixlarge/Test11.jpg" alt="Test 11 " width="640" height="480" /></p>
      <p>Both burns were successful. Two nearly identical burns. Good data from one. C* efficiency estimates are still being worked on, but look to be in the ~70% range. <a href="http://www.youtube.com/watch?v=uRq1HoMyFI0">Video from test 11</a> is up on YouTube. Pressure data and simulation results are <a href="081229 simulations.php">here</a>. </p>
      <h3><a name="Plan" id="Plan"></a>Test Plan</h3>
      <h4>Goals for this test:</h4>
      <ul>
        <li>Reliable ignition. </li>
        <li>Achieve stable, burn at something close to design performance. </li>
        <li>Gather accurate data.  </li>
      </ul>
      <p>Based on analysis of our last test, we've made these decisions.</p>
      <ul>
        <li>We have tweaked the pyro-valve design. We are now up to version 4. See the <a href="../motor/pyrovalve.php">design page</a> for more details.  </li>
      </ul>
      <h4>Schedule</h4>
      <p>Test day is December 29 at Rik's.</p>
      <p>Evan and I plan to arrive by 11:00 AM.</p>
      <p>Spectators are welcome at 11:00, and should definitely  arrive before noon. </p>
      <p>First hot-fire test: push the button some time between 12:00 and 12:30.</p>
      <p>Lunch between tests.</p>
      <p>Second hot-fire test: push the button no later than 3:00. Goal is 1:30.</p>
      <p>Depart: goal is  4:00.    </p>
      <h3><a name="Pretest" id="Pretest"></a>Pretest Work</h3>
      <h4>Pyro-valves</h4>
      <p>Mark-4 pyro-valves. Ready. </p>
      <h4>Hydrotesting</h4>
      <p>Hydrotesting did not go well. We managed to get a fair amount of air into the system which in turn meant we spent a lot of time and effort for little result. Valve #2 was measured to hold at 600 psi before the system leaked down to 400 psi. The leak was at the injector end, and our belief is that the leak was fluid passing the main injector bulkhead rings. Our assumption is that the rings are loose and that our silicon hydraulic fluid managed to get past the grease.</p>
      <p>We pulled the injector, cleaned and inspected the rings, cleaned the motor, and reassembled. We did not repeat the hydrotest. (Note: injector bulkhead rings are viton.) </p>
      <h4>Fuel Grains</h4>
      <p>We will use 12&quot; ABS grains that were prepared for the last test. </p>
      <h4>Nitrous Supply</h4>
      <p>I exchanged our 50 lb nitrous cylinder (mostly empty) for a 75 lb nitrous cylinder. We'll be using Mike's 15 lb cylinder for testing. We need to refill Mike's cylinder before testing. </p>
      <h4>Weights and Measures</h4>
      <ul><li>Fuel grains were made by cutting pipe stock to 11.75&quot; long (all 3 grains).  Grains were shimmed with felt stick-ons designed to make furniture not mar hardwood floor.
          <ul>
            <li>ABS #1 is 337.9g</li>
            <li>ABS #2 is 340.1g</li>
            <li>PVC is 454.2g</li>
          </ul>
        </li>
        <li>Pyrovalves </li>
        <ul>
          <li>M4#1: disk is 0.62&quot; thick, valve is .5&quot; thick with an 11/64&quot; groove cut</li>
          <li>M4#2: disk is 0.58&quot; thick, valve is .5&quot; thick with a 1/8&quot; groove cut  </li>
        </ul>
        <li>Measured volume was 1091 with valve #2. </li>
        <li>Simulation predicts a 2 second burn, K-1000. </li>
      </ul>
      <p>First test will be grain #2, valve #2. </p>
      <h4>Nitrous Supply</h4>
      <ul>
        <li>We before transfering we had a gross weight of 212 lb, large tank, 18 lb, small tank. This is an expected net weight of 75 lb and 10.25 lb.</li>
        <li>I transfered 5 lb from the large to the small prior to the test. Final measured weight of the small tank is 33 lb. </li>
      </ul>
      <h4>Data Capture</h4>
      <p>DAQ firmware needs some slight tweaks, but is basically ready to run. We will continue to use our temporary mounting for this test. </p>
      <h3><a name="Results" id="Results"></a>Results</h3>
      <h4>Test 10</h4>
      <ul>
        <li>Burned for about 2.50 seconds.</li>
        <li>ABS #2, post burn, 228.8g, or 111.3g consumed.</li>
        <li>Preliminary analysis shows pretty good match to simulation assuming a C* efficiency of 72% and an injector Cd of 0.37. Detailed discussion of the simulation is <a href="081229 simulations.php">here</a>. </li>
      </ul>      
      <h4>Test 11</h4>
      <ul>
        <li>Burned. Looked good. DAQ board did not trigger so no pressure data.</li>
        <li>ABS #1, post burn, 227.5g, or 110.3g consumed.   </li>
      </ul>      
      <p>Final weight of the nitrous supply tank was 24.6 lbm, indicating we consumed 8.4 lbm of nitrous during these two tests. </p>      <p>&nbsp;</p>    </td>
  </tr>
</table>
</body>
</html>

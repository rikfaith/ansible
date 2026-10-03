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
      <h3>Simulation Analysis </h3>
      <p>Last Update, 1/1/09 by Stephen Daniel </p></td>
  </tr>
  <tr>
    <td><h3>Summary</h3>
      <p>This sections discusses the simulation of test #10. We show that by adjusting the injector Cd, the fuel regression rate, and the C* efficiency we can get a good fit to the burn time, the chamber pressure trace, and the mass of fuel consumed.</p>
      <p>Assuming good data and good simulation models, we believe these derived values represent reasonable approximations to reality.</p>
      <h3>Discussion</h3>
      <p>We don't have a fuel regression model or CPROPEP entry for ABS, so we used PBAN for both.</p>
      <p>We manually adjusted C* efficiency, injector Cd, and a fuel regression constant until the average pressure looked good and the run time and fuel mass consumed matched almost exactly.</p>
      <p>The shape of the simulated pressure trace is a good match to the measured, with a couple of exceptions. The motor appears to have had some trouble coming up to pressure immediately. This is visible in the video as well. Test 11 starts instantly. I assume that in test 10 the pyro-valve did not immediately break free.</p>
      <p>Early in the burn the chamber pressure is higher than expected. The igniters burn during the entire time the pyro-valve is cooking (about 16.8 seconds) and pre-heat the fuel grain. I assume this results in very high initial fuel regression.</p>
      <p>The injector Cd that matches the burn time (0.37) is lower than we've been using for our design work. However our design has been guided by very approximate data. Furthermore we chose to design to a high injector Cd, on the theory that we could alwas add more holes in the injector later. I expect we will need to drill out the injector to achieve our target thrust.</p>
      <p>The C* efficiency (72%) is much lower than our design goal of 95%. We believe that switching from a straight length of pipe to a fuel grain cast with mixing chambers forward and aft of the actual grain will significantly improve this.</p>
      <p>To match the observed fuel consumed I had to cut the fuel regression almost in half (57.5%). Our fuel regression models suffer from a severe lack of data behind them.     </p>
      <h3>Pressure Graph </h3>
      <p><img src="test10data.gif" alt="Test 10 Pressure Graph" width="901" height="614" /> </p>
      <h3>Simulation Results</h3>
      <pre>
Section 1: Geometry
        Tank Height         0.152 meters
        Tank Volume         1.093 liters
        Ullage Height       0.000 meters
        Grain Length        0.297 meters
        Nozzle Throat       1.000 inches
        Nozzle Exit         1.600 inches
        Nozzle Half Angle   15.0 degrees
        C* Adjustment       0.72
        Cf Adjustment       0.95
        Ambient Pressure    1.0  atm
<br />
Section 2: Fill Conditions
        N2O Supply Pressure 508.0 psi
        Init Pressure       415.0 psi
        Init Temp              26 F
        Init N2O Mass        1.01 kg
        Init N2O Density     0.92 g/cc
        N2O Vented to chill  0.08 kg
                             0.18 lbs
        Total N2O Consumed   2.40 lbs
        Fuel                 PBAN
<br />
Section 3: Empty Conditions
        Final Pressure      256.8 psi
        Final Temp           -5.1 F
        Ullage N2O Mass      0.05 kg
        Ullage Percentage    5.0 %

Section 4: Chamber Summary   Init  Final   Average
        Grain Port           3.042  3.162  3.104 inches
        Grain Mass           0.442  0.332 kg
        Fuel Consumed               0.110 kg
                              Min     Max     Average
        Chamber Pressure     112.15  145.11  130.52 psi
        O/F Ratio              8.3    9.0    8.7
<br />
Section 5: Injector Summary
        Injector Count           8
        Diameter of Injectors    1.78  mm
                                 0.070 inches
        Cd of Injectors          0.37
        Tank/Chamber Pressure Ratio
                                Min     Max    Average
                                2.29    2.86    2.60
<br />
Section 6: Nozzle Summary        Min     Max    Average
        Exit Pressure           0.57    0.74    0.67 atm
        Nozzle CF (un-adj)      1.32    1.32    1.32
<br />
Section 7: Performance Summary  Init   Min    Max    Average
        Thrust                  139    100    139    122 lbf
                                616    446    616    541 N
        Delivered ISP          1298   1223   1298   1269 meters/sec
        Delivered ISP           132    125    132    129 seconds
        Burn Time             2.508 seconds
        Total Impulse          1357 N-seconds
        Motor Designation     K-541 (6%)
	  </pre></td>
  </tr>
</table>
</body>
</html>

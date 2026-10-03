<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Project P1: First Hot Fire Test</title>
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
      <h3>First Hot Fire Test </h3>
      <p>Last Update, 4/5/08 by Stephen Daniel </p></td>
  </tr>
  <tr>
    <td><h3>Test Plan </h3>
      <p>Goals for this test:</p>
      <ul>
        <li>Measure the thermal load on the motor casing during a short run.</li>
        <li>Measure chamber pressure and match against simulations.</li>
      </ul>
      <p>For these short tests we are using a 2' long motor tube, which gives us a K-class total impulse. </p>
      <h3>Summary of Results </h3>
      <p>Two test runs were attempted. Each time the pyro-valve burned but the engine failed to ignite.</p>
      <p>Chamber pressure data was collected and looks clean. However the data capture board shut down 0.1 seconds after the pyro-valve let go on the first test. </p>
      <h3>Test Photos </h3>
      <table>
        <tr>
          <td>Motor in the test harness, ready for pressure checks. The blue stickers on the motor are single-use temperature sensors. </td>
          <td width="250" align="center"><?php thumbnailreference("S6300267", 2); ?></td>
        </tr>
        <tr>
          <td>Top of the motor, as rigged for static testing.</td>
          <td align="center"><?php thumbnailreference("S6300268", 2); ?></td>
        </tr>
        <tr>
          <td>Motor on the stand, ready to fire. </td>
          <td align="center"><?php thumbnailreference("S6300269", 2); ?></td>
        </tr>
        <tr>
          <td>One frame of the video from test 1 showing that we achieved instantaneous ignition.</td>
          <td align="center"><?php thumbnailreference("test1fire", 2); ?></td>
        </tr>
        <tr>
          <td>Pyro valve after failure to ignite </td>
          <td align="center"><?php thumbnailreference("S6300279", 2); ?></td>
        </tr>
        <tr>
          <td>Pressure transducer trace from test 1 run. </td>
          <td align="center"><?php thumbnailreference("test1", 2); ?></td>
        </tr>
      </table>
      <h3>Results</h3>
      <h4>Initial Conditions</h4>
      <ul>
        <li>Atmospheric pressure is 101.7 MPa</li>
        <li>Temperature is ~50 F with intermittent rain.</li>
        <li>Nitrous tank at 152 lb before the test. </li>
      </ul>
      <h4>Test 1</h4>
      <p>Fill proceeded normally. Pyrovalve fired normally. When the valve burned through the motor dumped nitrous without igniting. Inspection of the valve showed that the nitrous quenched the pyrovalve, leaving some unburnt valve material behind. (See photo above.)</p>
      <p>We decided that perhaps the recessed hole in the valve material was not deep enough, allowing the valve to burn clear to the sides before burning through, leaving too little flame front to ignite the nitrous.</p>
      <p>Also worth noting, when the valve let go it went with a very sharp bang. This is clearly audible in this <a href="test1short.mp3">fragment of the audio log</a>, recorded at the LCO table. </p>
      <p>Analysis of the data gathered by the pressure transducer showed that we dumped nitrous fast enough to pressurize the chamber to a steady state pressure of about 30 PSI (gauge). The data capture system apparently shut down about 0.1 seconds after the pryo-valve let go.</p>
      <p>Frame-by-frame analysis of Rik's video shows we had a very brief burst of fire. It shows up in one video frame only (see photo above). After the burst of flame the nitrous dump starts, building slowy over the next few frames. </p>
      <table border="2" cellpadding="2" cellspacing="0">
        <tr>
          <td><?php thumbnailreference("test1frame0", 1); ?></td>
          <td><?php thumbnailreference("test1frame1", 1); ?></td>
          <td><?php thumbnailreference("test1frame2", 1); ?></td>
          <td><?php thumbnailreference("test1frame3", 1); ?></td>
          <td><?php thumbnailreference("test1frame4", 1); ?></td>
          <td><?php thumbnailreference("test1frame5", 1); ?></td>
          <td><?php thumbnailreference("test1frame6", 1); ?></td>
          <td><?php thumbnailreference("test1frame7", 1); ?></td>
        </tr>
      </table>
      <h4>Test 2</h4>
      <p>We used a hand-held drill and made the hole in the valve deeper. This required rebuilding the igniter too. Fill proceeded normally without incident. </p>
      <p>Ignition failed in manner similar to test 1. However, the initial bang was notably software and the discharge of nitrous was slower, and flame was smaller, and flickers a bit in a second and third frame. </p>
      <h3>Analysis</h3>
      <h4>Data Capture Failure </h4>
      <p>We believe that the  data capture board lost power at the shock of the test 1 pyrovalve opening. It probable continued to operate for 0.1 seconds on power supply capacitors. Since the data capture ran find during the second (less violent) second run we conclude this is one of the hazzards of using a bread-board circuit in the field.</p>
      <h4>Ignition Failure</h4>
      <p>The ignition failure is quite surprising to us. The P1 pyro-valve is almost identical to the very successful pyro-valve system used to ignite our <a href="../../MarkIII/index.html">Mark-III PVC hybrids</a>. </p>
      <p>We've identified 4 differences in the design of the two systems:</p>
      <ol>
        <li>The pyro-valve formula changed.&nbsp; We went from a RIO fraction of 4.8% to 8.5% (by weight, active ingredients). There were various other small changes. This change was not intentional. Rather it was due to having temporarily misplaced the Mark-III log book which contained the magic formula.</li>
        <li>The geometry of the pyro-valve changed.<br />
          &nbsp;&nbsp;&nbsp; The Mark-III ignition grain is 1.05&quot; diameter (3/4&quot; PVC pipe used as the mandrel). The P1 is 1.0&quot; diameter (Teflon round stock used as  the mandrel). The Mark-III grains are cast to a somewhat random depth.&nbsp; The depth is then adjusted using the 5/8&quot; drill to a nominal 3/8&quot; thickness.&nbsp; On some grains I've removed a lot with the drill.&nbsp; On some I've removed only a little.&nbsp; The P1 grains were 0.8&quot; thick and drilled to a nominal 0.3&quot; with the drill.&nbsp; I think they were actually drilled to 0.4&quot;. </li>
        <li>The geometry of the chamber changed.<br />
          &nbsp;&nbsp;&nbsp;&nbsp; Most of the Mark-III chambers used a 1.92&quot; I.D. fuel grain.&nbsp; The P1 fuel grain was 3.04&quot; I.D.&nbsp; In both cases the chamber length was about 12&quot;.</li>
        <li>The P1 pyrovalve seals using a face-sealing O-ring about 1&quot; in diameter. The Mark-III pyrovalve seals by compressing a piece of flexible PVC between the valve and the injector.</li>
      </ol>
      <p>Evan, as chief chemist, believes that the changed formula is highly unlikely to make a difference.</p>
      <p>The geometry differences seem minor.</p>
      <p>The chamber differences may be cruicial. Perhaps the pyrovalve needs a substantial amount of vaporized fuel grain present to ignite the nitrous? If so the fact that the P1's fuel grain is substantially farther from the pyrovalve may be relevant.</p>
      <p>I believe the difference in seal is the most likely cause. The P1 valve clearly lets go very suddenly. There will be nearly 300 lbs of force on the valve and once it starts to burn through it fails abruptly. This may allow a very sudden inrush of flash-boiled (i.e very cold) nitrous which quenches the valve. The Mark-III seal fails more gradually. It is under less pressure and the seal can give way for each injector hole separately. </p>
      <h3>Next Steps </h3>
      <p>These are still being designed.</p>
      <p>Our goal is to run the next test on Sunday, April 13. Prior to then:</p>
      <ol>
        <li>More machining on the nozzle collar and the retaining washer. We'd like to be able to change out the pyrovalve after a failed ignition without pulling the motor off the test stand.</li>
        <li>Switch to a PVC face seal, as done by the Mark-III.</li>
        <li>After adjusting the fit and the seal, redo the hydrotest.</li>
        <li>Build a set of pyrovalves to have ready to test. </li>
      </ol>
      <p>Proposed pyrovalves:</p>
      <p>We need two of each proposal. If one works, we'd like to run two tests (the original test plan).</p>
      <p>Presently we have two proposals.</p>
      <ol>
        <li>Same geometry as before, but with a PVC face seal rather than an O-ring seal. Also, drill the 0.625&quot; hole so that the remaining thickness of pyrovalve material is 0.25&quot;, rather than 0.3&quot; or 0.4&quot; </li>
        <li>Use a stepped mandrel to cast the pyrovavle blank. The mandrel can be made of 3/4&quot; PVC pipe nested inside a piece of 1&quot; PVC pipe. Most of the hole will be 1.3&quot; in diameter (the O.D.of 1&quot; PVC), up from 1.0&quot; in the current design. The last 0.2&quot; of the hole will be 1.05&quot; in diameter (the O.D. of 3/4&quot; PVC pipe). </li>
      </ol></td>
  </tr>
</table>
</body>
</html>

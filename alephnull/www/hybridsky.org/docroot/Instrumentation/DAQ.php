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
    <td><h3>Data Capture </h3>
      <p>Testing plays an essential role in any motor development program. Finding an economical way to record test data during static motor tests proved a challenge. We wanted a system that was affordable and was optimized to provide high quality recordings of a modest number of sensor channels. After some research we decided to build our own data capture system.</p>
      <h4>Key Features :</h4>
      <ul>
        <li>A small self-contained 3-channel analog to digital capture system suitible for test-stand use </li>
        <li>Each channel takes a 0-5V analog input. </li>
        <li>2 channels of optically isolated digital input, suitable for sensing test-stand control signals </li>
        <li>Load cell amplifier. It drives a wheatstone bridge style sensor and provides a 0-5V signal for the recorder. </li>
        <li>Data recorded as 12-bits per sample, sampled at 10KHz, with noise and errors below 0.5 LSB to 1KHz. </li>
        <li>Record data onto a FAT-formatted flash memory </li>
      </ul>
      <h4>Status</h4>
      <p>Version 1.0 of the DAQ is up and running.  The firmware is sufficient for our use but needs more development to be ready for general users.</p>
      <p>Final housing is complete. </p>
      <p>Documentation is 50% or more complete. </p>
      <h4>Documents</h4>
      <ul>
        <li>User Manual. Yes, we'd like to have one. We don't yet. </li>
        <li>Schematic Diagrams are available as a <a href="DAQ_Circuit-10.pdf">PDF file </a>and as an <a href="http://www.expresspcb.com/index.htm">Express PCB</a> <a href="DAQ_Circuit-10.sch">schematic file</a>.</li>
        <li>Board layout is available as an <a href="http://www.expresspcb.com/index.htm">Express PCB</a> <a href="DAQ_Layout-10b.pcb">layout file</a>. Anyone interested in fabricating the board should contact us, as we may have extra boards available for purchase. </li>
        <li>The front panel is being fabricatred by <a href="http://www.frontpanelexpress.com">Front Panel Express</a>. Panel design is available <a href="DAQ_panel-10.fpd">here</a>, or as a <a href="DAQ_panel-10.pdf">PDF file</a>. </li>
        <li>Consolidated parts list is <a href="daq_bom.xls">here</a>. There are some working notes on the ICs and semiconductors <a href="DAQ IC Pin Outs.pdf">here</a>. </li>
        <li>Connectors on the panel are documented <a href="DAQ connectors.php">here</a>. All of these are 4-pin AMP connectors. </li>
        <li>Some of the firmware is available <a href="DAQ Firmware.html">here</a>.</li>
      </ul>
      <h4>Project Photos</h4>
      <table>
        <tr>
          <td><?php thumbnailreference("S6300580", 2); ?></td>
        </tr>
        <tr>
          <td>Fully operational DAQ system, shown here in temporary housing.</td>
        </tr>
      </table>
      <h4>Results</h4>
      <p>This DAQ system was used to capture test data for test 10 of our hybrid motor system. The measured data for the graph on this <a href="../p1/testing/081229 simulations.php">analysis page</a> comes from this DAQ system. </p>
      <p>As a test of the DAQ system, we ran a high quality sine wave into both channels 0 and 1. Mathematically fitting a sine wave to those data sets yielded these results:</p>
      <table>
        <tr>
          <td width="12">&nbsp;</td>
          <td><table cellpadding="4" cellspacing="2">
              <tr>
                <td>&nbsp;</td>
                <td>Channel 0</td>
                <td>Channel 1</td>
              </tr>
              <tr>
                <td>Amplitude</td>
                <td>3.438V</td>
                <td>3.395V</td>
              </tr>
              <tr>
                <td>Frequency</td>
                <td>731.22Hz</td>
                <td>731.22Hz</td>
              </tr>
              <tr>
                <td>DC Offset</td>
                <td>-0.0027V</td>
                <td>-0.0034V</td>
              </tr>
              <tr>
                <td>Relative Phase</td>
                <td>0</td>
                <td>13.23 uSec</td>
              </tr>
            </table></td>
        </tr>
      </table>
      <p>The raw data file is available <a href="sampleshiftdata.csv">here</a>. This file has 5 columns. In order they are analog 0, digital input 0, digital input 1, analog 1, and analog 2. Only analog 0 and 1 contain meaningful data.</p>
      <p>Our analysis shows that the DC offsets listed here are both within the A/D chip's tolerance of zero.</p>
      <p>Initially we were somewhat surprized that the amplitudes differ as much as they do (1.3%). However we built a mathematical model of the filters we are using (a 6-pole bessle filter with a nominal cutoff of 1 KHz). We then simulated the filter using a large number of randomly chosen resistor and capacitor values, all within the 1% tolerance specfied by the manufacturer. While the observed amplitude difference is a little large, we conclude that the most likely small differences in the filter components caused this amplitude difference.</p>
      <p>Most of the phase difference between the two channels comes from the fact that the PIC samples channel zero before it samples channel 1. Some of the phase difference is because of small deviations in the filter components. </p></td>
  </tr>
</table>
</body>
</html>

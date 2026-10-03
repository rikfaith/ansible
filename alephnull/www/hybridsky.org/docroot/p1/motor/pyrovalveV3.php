<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Project P1: Motor Pyrovalve</title>
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
      <h2><a href="index.html">Motor Project</a></h2>
      <h3>Pyrovalve</h3>
      <p>Last Update, 12/13/08 by Stephen Daniel </p></td>
  </tr>
  <tr>
    <td><h3>Introduction</h3>
      <p>This page documents version 3 of the pyrovalve, both design and fab instructions.</p>
      <p>The pyrovalve serves as the main nitrous valve. Pyro material blocks the flow of nitrous into the combustion chamber. When this material burns away the nitrous flow begins and the motor fires. Additionally the non-combustable portions of the valve structure are an ablative insulator for the injector plate. </p>
      <p>Unlike previous versions of the valve design this valve is <em>not</em> respondible for main engine ignition. An external ignition source (discussed below) is required. </p>
      <h3>Revision History</h3>
      <p>This page documents the third version of the pyrovalve.</p>
      <ul>
        <li><a href="pyrovalveV2.php">Version 2</a>, Tests 6 and 7. </li>
        <li><a href="pyrovalveV1.php">Version 1, 1.1</a>, Tests 1 through 5. </li>
      </ul>
      <h3>Design </h3>
      <p>The pyrovalve is a 0.6&quot; to 0.65&quot; thick plastic disk. It fits inside the motor tube just aft of the injector plate. When the nitrous tank is pressurized, the injector plate rests on the valve, which in turn rests on the fuel grain.</p>
      <p>The valve is made of a ring of cast fiberglass with a 1&quot; diameter hole in it. This hole is filled with the pyro material. The fiberglass mates against the injector's aft-face o-ring seal. The fiberglass insulates the injector plate during engine run. The center of the injector plate is not insulated but presumed to be cooled by nitrous flow.</p>
      <p>The 1&quot; center hole is filled with pyro-material to a depth of 0.4&quot;. Both faces are basically flat. The forward face is notched with a 1&quot; diameter by 1/8&quot; deep notch. The goal of this design is a valve that fails abruptly and completely exposes all 8 injectors holes simultaneously. </p>
      <p>Ignition is done by resistors and pyrogoop. There are two resistors on the valve itself. </p>
      <h3>Construction</h3>
      <h4>Fiberglass disk</h4>
      <ul>
        <li>The mold is a ring of 4&quot; aluminum tube, cut from the same stock used to make the motor. The ring is greased with lithum grease as a mold release, and lined with a piece of acetate to slightly reduce its diameter. This is set on a piece of greased plexiglass. The center hole is formed with a greased piece 1&quot; teflon rod acting as a mandrel. </li>
        <li>The fiberglass is a mix Mr. Fiberglass medium cure epoxy and 1/32&quot; milled glass fibers, 3:1 by weight. The mix is:
          <ul>
            <li>72g Mr. Fiberglass thin resin.</li>
            <li>24g Mr. Fiberglass medium-cure hardner.</li>
            <li>32g 1/32&quot; milled glass fiber.</li>
          </ul>
        </li>
        <li>Mix the epoxy first, then mix in the glass fibers.</li>
        <li>Although not strictly necessary, we vacuum degas the mix using a hand-held pump (a brake-line bleeding pump purchased from Harbor Freight) and pump down to about 24&quot; of mercury worth of vacuum.</li>
      </ul>
      <h4>Pyrovalve</h4>
      <p>This recipe makes enough pyro material for 4 pyrovalves. You can scale it down to a 2-valve batch, but not smaller than that. </p>
      <p>Wear disposable gloves while working with this mixture. </p>
      <ul>
        <li>Dry mix:
          <ul>
            <li>4 g red iron oxide powder (RIO)</li>
            <li>17 g milled fertilizer grade potassium nitrate. We use a small coffee grinder to mill the nitrate</li>
            <li>17 g unmilled potassium nitrate.</li>
          </ul>
        </li>
        <li>Wet mix:
          <ul>
            <li>9g Mr. Fiberglass thin epoxy resin</li>
            <li>3 g Mr. Fiberglass medium-cure hardner</li>
          </ul>
        </li>
        <li>Mix the wet and dry ingredients separately.</li>
        <li>Mix wet and dry mixtures together. Should make a mix about the consistency of a stiff cookie dough.</li>
        <li>Place two finished fiberglass disks on a greased flat hard surface (plexiglass), forward (flatter) surface down.</li>
        <li>Fill to 0.4&quot; deep, using a mandrel to pack and ensure a level surface on the top of the pyro material.</li>
      </ul>
      <p>You'll have some of the pyro material left over. This can be discarded or used for test burns. </p>
      <p>Once the valve material has hardened drill a circular notch in the forward face of the pyrovalve using a 7/8&quot; hole saw with the centering drill removed. The notch should be drilled to a depth of 1/8&quot;.</p>
      <p>The aft (recessed) face of the valve material should be smoothed using a Dremel tool. </p>
      <h4>Pyrogoop</h4>
      <ul>
        <li>Dry mix
          <ul>
            <li>6 parts by weight milled  potassium nitrate</li>
            <li>1 part by weight powdered  aluminun</li>
            <li>1 part by weight red iron oxide</li>
          </ul>
        </li>
        <li>Do not make very much of this stuff at once. Store in a metal (spark-proof) container. </li>
      </ul>
      <table>
        <tr>
          <td><p>Using CA glue (superglue)  mount two 1/8 watt, 10-ohm carbon-film resistors in the  well against the aft face of the valve material.</p>
            <p>Mix a small amount (equal parts by volume) dry mix and Weldwood brand contact cement. Stir with a toothpick. Coat the resistors and most of the aft face of the valve. This will dry slowly and will never be very strong. Handle very carefully or the resistors will come off the pyrovalve</p>
            <p>Allow to cure 24 hours before handling. </p></td>
          <td><?php thumbnailreference("S6300497", 2); ?></td>
        </tr>
      </table>
      <p>The resistors should be wired in parallel with 3' long leads. We use twisted pair salvaged from cat-5 cable. The long leads should be kept taped down to the motor at all times to avoid mechanical stress on the pyrogoop.</p>
      <p>Do <em>not</em> use too much pyrogoop. A couple of grams is sufficient. Use of too much pyrogoop will result in  detonation rather than ignition. </p>
      <h3>Motor Ignition</h3>
      <p>The valve can be ignited by connecting the resistor leads to a high current 12 volt DC source. The goop will fire within about 1 second. The valve will take about 10 seconds to burn through. </p>
      <p>Motor ignition is no longer from the pyrovalve. Instead we use a set of 3 commercially available sparklers. These are TNT brand coated-wire #10 sparklers, labeled as containing no magnesium, chlorates or perchlorates.</p>
      <p>The sparklers are taped to the wire leads and a bamboo skewer for mechanical strength. The sparklers are light using a pair of resistors secured to the sparklers with pyrogoop. These resistors are wired in parallel to the pyrovalve resistors so that all 4 light at once.</p>
      <p>Only one resistor is needed for successful ignition of the sparklers. We use 2 for redundancy. </p>
      <p>Tests show that the sparklers burn for about 50 seconds. </p>
      <h3>Construction and Testing Notes</h3>
      <p>Two valves (M3S1 and M3S2) were built. The pyro portion was built using half the above receipe. </p>
      <p>We plan to test these valves at the 12/6/08 test (tests 8 and 9). </p>
      <h3>Conclusions</h3>
      <p>The valve failed to hold pressure. See discussion in the <a href="../testing/081206.php">testing results page</a>.</p>
      <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>

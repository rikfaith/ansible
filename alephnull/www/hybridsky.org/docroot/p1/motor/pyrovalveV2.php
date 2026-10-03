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
      <h3><a href="pyrovalve.php">Pyrovalve</a>, Version 2 </h3>
      <p>Last Update, 5/27/08 by Stephen Daniel </p></td>
  </tr>
  <tr>
    <td><h3>Introduction</h3>
      <p>This page documents version 2 of our pyrovalve. This version of the pyrovalve was designed after ignition failures during our first five static tests. </p>
      <p>This page documents the provalve, both design and fab instructions.</p>
      <p>This design is covered briefly for documentation purposes. Version 2 of the valve has been replaced by later versions. </p>
      <h3>Design </h3>
      <p>The pyrovalve is a 0.75&quot; to 0.80&quot; thick plastic disk. It fits inside the motor tube just aft of the injector plate. When the nitrous tank is pressurized, the injector plate rests on the valve, which in turn rests on the fuel grain.</p>
      <p>The valve is made of a ring of cast fiberglass with a 1&quot; diameter hole in it. This hole is filled with the pyro material. The fiberglass mates against the injector's aft-face o-ring seal.</p>
      <p>In addition, 2 igniters are embedded in the aft face of the valve. These are brass tubes, 0.6&quot; long and 0.5&quot; O.D. that contain modified RNX (Naka's fuel). They are lit at the same time as the pyrovavle and provide an igition source for the chamber. </p>
      <p>The 1&quot; center hole is filled with pyro-material to a depth of 0.4&quot;. Both faces are basically flat. The aft face has a groove cut by a hole saw that attempts to ensure the valve will fail at the edges, and all at once..</p>
      <p>Ignition is done by resistors and pyrogoop. There is one resistor on each igniter and two on the valve itself. All four are in parallel. </p>
      <h3>Construction</h3>
      <h4>Igniters</h4>
      <ul>
        <li>Cut a length of 1/2&quot; brass tube into six pieces, each 0.6&quot; long.</li>
        <li>Mix a small batch of the pyrovalve mixture.</li>
        <li>Fill each brass tube. Set them on a sheet of acetate to set up. </li>
      </ul>
      <h4>Fiberglass disk</h4>
      <ul>
        <li>The mold is a ring of 4&quot; aluminum tube, cut from the same stock used to make the motor. The ring is greased with lithum grease as a mold release, and lined with a piece of acetate to slightly reduce its diameter. This is set on a piece of greased plexiglass. The center hole is formed with a greased piece 1&quot; teflon rod acting as a mandrel. </li>
        <li>The first pour into the mold contains:
          <ul>
            <li>15g Mr. Fiberglass thin resin. </li>
            <li>5g Mr. Fiberglass medium-cure hardner.</li>
            <li>7g 1/32&quot; milled glass fiber.</li>
          </ul>
        </li>
        <li>Mix the epoxy first, then mix in the glass fibers.</li>
        <li>Pour this into the mold and allow this to set up and mostly (or completely) cure. </li>
        <li>Place the igniters.</li>
        <li>Second pour:
          <ul>
            <li>60g Mr. Fiberglass thin resin.</li>
            <li>20g Mr. Fiberglass medium cure hardner</li>
            <li>20g /32&quot; milled glass fiber. </li>
          </ul>
        </li>
      </ul>
      <h4>Pyrovalve</h4>
      <p>This recipe makes enough pyro material for 3 pyrovalves. Its about as small a batch as you can easily work with. </p>
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
        <li>Pack the mixture into the center holes in the disk. They should be about 3/4&quot; full.</li>
      </ul>
      <table>
        <tr>
          <td><p>Once the valve material has hardened, drill the aft (lumpy) face with a 7/8&quot; forstner drill bit so that the remaining material 3/8&quot; thick.</p>
            <p>Drill a circular notch in the forward face of the pyrovalve using a 7/8&quot; hole saw with the centering drill removed. The notch should be drilled to a depth of 1/16&quot;. </p></td>
          <td width="256"><?php thumbnailreference("S6300347", 2); ?></td>
        </tr>
      </table>
      <h4>Ignition</h4>
      <table>
        <tr>
          <td valign="top"><p>Use 4 resistors, 10 ohm, 1/8 watt, carbon film. Using CA glue, glue 1 resistor to each igniter and 2 to the outside of the aft face of of the pyrovalve.</p>
            <p>Wire all 4 in parallel and solder leads to them.</p>
          <p>Coat all 4 resistors with pyrogoop and allow to set up for 24 hours. </p></td>
          <td width="256"><?php thumbnailreference("S6300356", 2); ?>
            <br />
            <?php thumbnailreference("S6300358", 2); ?></td>
        </tr>
      </table>
      <h3>Conclusions</h3>
      <p>This design was a marked improvement over version 1. The valve appears to have uncovered all of the injector holes at once, or almost at once. Furthermore the igniters stayed lit during the test firing (test 6). However the igniters were not sufficient to ignite the motor.</p>
      <p>We believe that adding magnesium chips to the igniters would probably resolve the ignition problem. However we have discontinued this design in favor of using a simpler valve and an external ignition source. </p></td>
  </tr>
</table>
</body>
</html>

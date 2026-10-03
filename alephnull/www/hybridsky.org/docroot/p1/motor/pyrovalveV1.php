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
      <h3><a href="pyrovalve.php">Pyrovalve</a>, Version 1 </h3>
      <p>Last Update, 5/27/08 by Stephen Daniel </p></td>
  </tr>
  <tr>
    <td><h3>Introduction</h3>
      <p>This page documents version 1 and 1.1 of the pyrovalve, both design and fab instructions.</p>
      <p>This design is presented here for documentation purposes. This design is no longer in use and has been replaced by later versions. </p>
      <h3>Design </h3>
      <p>The pyrovalve is a 0.75&quot; to 0.80&quot; thick plastic disk. It fits inside the motor tube just aft of the injector plate. When the nitrous tank is pressurized, the injector plate rests on the valve, which in turn rests on the fuel grain.</p>
      <p>The valve is made of a ring of cast fiberglass with a 1&quot; diameter hole in it. This hole is filled with the pyro material. The fiberglass mates against the injector's aft-face o-ring seal. The fiberglass insulates the injector plate during engine run. The center of the injector plate is not insulated but presumed to be cooled by nitrous flow.</p>
      <p>The 1&quot; center hole is filled with pyro-material. The forward face is flat. The aft face of the pyro has a 0.625&quot; hold drilled partway through, so that the thickness is a bit greater than 0.30&quot;. The intent is that this section burns through first, allowing nitrous flow to start while the rest of the pyro material is still burning.</p>
      <p>A variety of ignition systems are possible. We typically use an igniter made of resistors coated with pyrogoop (details below). </p>
      <h3>Construction</h3>
      <h4>Fiberglass disk</h4>
      <table>
        <tr>
          <td><ul>
              <li>The mold is a ring of 4&quot; aluminum tube, cut from the same stock used to make the motor. The ring is greased with lithum grease as a mold release, and lined with a piece of acetate to slightly reduce its diameter. This is set on a piece of greased plexiglass. The center hole is formed with a greased 1&quot; diameter teflon mandrel. </li>
              <li>The fiberglass is a mix Mr. Fiberglass medium cure epoxy and 1/32&quot; milled glass fibers, 3:1 by weight. The mix is:
                <ul>
                  <li>90g Mr. Fiberglass thin resin.</li>
                  <li>30g Mr. Fiberglass medium-cure hardner.</li>
                  <li>40g 1/32&quot; milled glass fiber.</li>
                </ul>
              </li>
              <li>Mix the epoxy first, then mix in the glass fibers.</li>
              <li>Although not strictly necessary, we vacuum degas the mix using a hand-held pump (a brake-line bleeding pump purchased from Harbor Freight) and pump down to about 24&quot; of mercury worth of vacuum.</li>
              <li>Pour to a depth of 0.75&quot;. You'll have some mix left over. The mix will expand somewhat while hardening. </li>
              <li>When hardened, wash off the grease and sand flat to no more than 0.80&quot; thick. </li>
            </ul></td>
          <td width="256"><?php thumbnailreference("S6300205", 2); ?></td>
        </tr>
      </table>
      <h4>Pyrovalve</h4>
      <p>This recipe makes enough pyro material for 2 pyrovalves. Its about as small a batch as you can easily work with. </p>
      <p>Wear disposable gloves while working with this mixture. </p>
      <table>
        <tr>
          <td><ul>
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
              <li>Pack the mixture into the center holes in the disk. Don't quite fill them up.</li>
            </ul>
            <p>You'll have some of the pyro material left over. This can be discarded or used for test burns. </p>
            <p>Once the valve material has hardened, drill the aft (lumpy) face with a 5/8&quot; forstner drill bit so that the remaining material is between 0.30&quot; and 0.32&quot;  thick.</p></td>
          <td width="256"><?php thumbnailreference("S6300209", 2); ?></td>
        </tr>
      </table>
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
      <p>Mix a small amount (equal parts by volume) dry mix and Weldwood contact cement. Stir with a toothpick. Use this as a glue to mount two 1/8 watt, 10-ohm resistors in the pyro-valve well drilled by the forstner bit. This will dry slowly and will never be strong. Handle very carefully or the resistors will come off the pyro-valve</p>
      <p>The resistors should be wired in parallel with 3' long leads. We use twisted pair salvaged from cat-5 cable. The long leads should be kept taped down to the motor at all times to avoid mechanical stress on the pyrogoop.</p>
      <p>Do <em>not</em> use too much pyrogoop. A couple of grams is sufficient. Use of too much pyrogoop will result in  detonation rather than ignition. </p>
      <h3>Ignition</h3>
      <p>The motor can be ignited by connecting the resistor leads to a high current 12 volt DC source. The goop will fire within about 1 second. The valve will take about 10 seconds to burn through. </p>
      <h3>Conclusions</h3>
      <table>
        <tr>
          <td valign="top"><p>Version 1 of the pyrovalve failed repeatedly. There are two issues. First, when the pyrovalve fails it only uncovers 4 of the injector holes, rather than all 8. Second, the nitrous flow is fast and cold enough to quench the valve. As a result the motor does not light.</p></td>
          <td width="256"><?php thumbnailreference("S6300279", 2); ?></td>
        </tr>
      </table>
      <p>The photo above shows a version 1 pyrovalve after a failed test. The fact that pyro material remains shows that ignition halted when the valve opened. Additionally the photo clearly shows the small size of the hole in the valve -- clearly insufficient to open all 8 injector holes. </p>
      <h3>Version 1.1</h3>
      <p>Version 1.1 of the pyrovalve attempted to ensure the pyro-material kept burning after the nitrous flow starts. The 1&quot; teflon mandral was replaced with a stepped mandrel. Most of the mandrel was a piece of 3/4&quot; PVC pipe (nominal O.D. 1.05&quot;). The bottom 1/8&quot; of the mandrel was a piece of 1/2&quot; PVC pipe (nominal O.D. 0.84&quot;). The intent was to ensure a cylinder of pyromaterial remained that would stay lit.</p>
      <p>This valve's performance was not materially different form version 1.0.  </p></td>
  </tr>
</table>
</body>
</html>

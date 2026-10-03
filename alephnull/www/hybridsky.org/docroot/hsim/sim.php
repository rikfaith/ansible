<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Nitrous Hybrid Simulator Version 0.3</title>
<link href="../styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: underline;
}
a:active {
	text-decoration: none;
}
-->
</style>
<script type="text/JavaScript">
<!--

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_changeProp(objName,x,theProp,theValue) { //v6.0
  var obj = MM_findObj(objName);
  if (obj && (theProp.indexOf("style.")==-1 || obj.style)){
    if (theValue == true || theValue == false)
      eval("obj."+theProp+"="+theValue);
    else eval("obj."+theProp+"='"+theValue+"'");
  }
}

function MM_setTextOfTextfield(objName,x,newText) { //v3.0
  var obj = MM_findObj(objName); if (obj) obj.value = newText;
}

function SD_getVal(objName) {
  var obj = MM_findObj(objName);
  if (obj)
	return obj.value;
  return -1.;
}

// for now the only length units supported are mm and inches.
function SD_getLunit(objName) {
	var obj = MM_findObj(objName);
	var v = 1.;
	if (obj && obj.value == "in")
		v = 25.4;
	return v;
}

function SD_sqr(n) {
  var x1, x2, i;
  if (n <= 0) return 0.;
 
  x1 = n / 2.;
  for (i = 0; i < 7; i++) {
  	x2 = .5 * (x1 + n / x1);
	x1 = x2;
  }
  return x2;
}

function SD_setRatio() {
	var t, e, r;
	t = SD_getVal('nozzlethroat');
	t *= SD_getLunit('nozzlethroatunit');
	e = SD_getVal('nozzleexit');
	e *= SD_getLunit('nozzleexitunit');
	r = e * e / t / t;
	 MM_setTextOfTextfield('nozexpand','', r);
}

function SD_setExit() {
	var t, r, e;
	t = SD_getVal('nozzlethroat');
	t *= SD_getLunit('nozzlethroatunit');
	r = SD_getVal('nozexpand');
	e = SD_sqr(r * t * t);
	e = e / SD_getLunit('nozzleexitunit');
	 MM_setTextOfTextfield('nozzleexit','', e);
}

function SD_setThroat() {
	if (document.SD_estyle == 1)	// user sets exit pressure
		SD_setRatio();
	else
		SD_setExit();
}

function SD_throatUnit() {
	var v = SD_getVal('nozzlethroat') * document.SD_throatUnit;
	document.SD_throatUnit = SD_getLunit('nozzlethroatunit');
	v /= document.SD_throatUnit;
	MM_setTextOfTextfield('nozzlethroat','',v);
}

function SD_exitUnit() {
	var v = SD_getVal('nozzleexit') * document.SD_exitUnit;
	document.SD_exitUnit = SD_getLunit('nozzleexitunit');
	v /= document.SD_exitUnit;
	MM_setTextOfTextfield('nozzleexit','',v);
}

function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
}

function SD_pageInit() {
	// initialize everything off the nozzle exit parameter.
	document.SD_estyle = 1;
	document.SD_throatUnit = SD_getLunit('nozzlethroatunit');
	document.SD_exitUnit = SD_getLunit('nozzleexitunit');
	SD_setThroat();
	if (document.SD_estyle != document.SD_sstyle) {
		// if we are supposed to be using area ratio...
		document.SD_estyle = document.SD_sstyle;
	}
}

//-->
</script>
</head>
<?php

function check_unit($arg, $units)
{
	foreach ($units as $u) {
		if ($arg == $u)
			return $arg;
	}
	//return $units[0];
	return "unknown";
}
	// Process the form variables, copying them into the session variables.

	import_request_variables("p", "hsim_");
	session_start();
	
	$unit_length = array("mm", "in");
	$unit_pressure = array("psi", "atm");
	$unit_angle = array("degrees", "radians");
	$unit_temperature = array("F", "C");
	$unit_mass = array("kg", "lbm");
	
	$inputerror = false;
	
	$tankheighterror = false;
	$ullageheighterror = false;
	$tankdiaerror = false;
	$ventdiaerror = false;
	$ventcderror = false;
	
	$grainlengtherror = false;
	$graindiametererror = false;
	$graincoreerror = false;
	$cstaradjerror = false;
	$injectordiaerror = false;
	
	$injectorcounterror = false;
	$injectorcderror = false;
	$nozzlethroaterror = false;
	$nozzleexiterror = false;
	$nozzleexperror = false;

	$nozzlehalfangleerror = false;
	$nozcfadjerror = false;
	$fillpresserror = false;
	$filltemperror = false;
	$drymasserror = false;
	
	$ambientpressureerror = false;
	
	// If we entered from the splash page, fill in all the defaults.
	if (!isset($hsim_fuel)) {
		$fuel = "PBAN";
		$tankheight = 31.5;
		$tankheightunit = "in";
		$ullageheight = 0.5;
		$ullageheightunit = "in";
		$tankdia = 88.45;
		$tankdiaunit = "mm";
		$ventdia = 0.0;
		$ventdiaunit = "mm";
		$ventcd = 0.25;
		$grainlength = 10.0;
		$grainlengthunit = "in";
		$graindiameter = 88.45;
		$graindiameterunit = "mm";
		$graincore = 2.75;
		$graincoreunit = "in";
		$cstaradj = 0.95;
		$injectordia = 0.07;
		$injectordiaunit = "in";
		$injectorcount = 8;
		$injectorcd = 0.7;
		$nozzlethroat = 1.0;
		$nozzlethroatunit = "in";
		$nozzleexit = 1.6;
		$nozzleexitunit = "in";
		$nozzlehalfangle = 15.;
		$nozzlehalfangleunit = "degree";
		$nozcfadj = 0.9;
		$noztype = 1;	// throat and exit, not throat and ratio
		$fillpress = 400.0;
		$fillpressunit = "psi";
		$filltemp = 65.0;
		$filltempunit = "F";
		$filldrop = 100.;
		$filldropunit = "psi";
		$fillstyle = 1;
		$drymass = 5.0;
		$drymassunit = "kg";
		$ambientpressure = 1.0;
		$ambientpressureunit = "atm";
	} else {
		$fuel = $hsim_fuel;
		$tankheight = (float)$hsim_tankheight;
		$tankheightunit = check_unit($hsim_tankheightunit, $unit_length);
		$ullageheight = (float)$hsim_ullageheight;
		$ullageheightunit = check_unit($hsim_ullageheightunit, $unit_length);
		$tankdia = (float)$hsim_tankdia;
		$tankdiaunit = check_unit($hsim_tankdiaunit, $unit_length);
		$ventdia = (float)$hsim_ventdia;
		$ventdiaunit = check_unit($hsim_ventdiaunit, $unit_length);
		$ventcd = (float)$hsim_ventcd;
		$grainlength = (float)$hsim_grainlength;
		$grainlengthunit = check_unit($hsim_grainlengthunit, $unit_length);
		$graindiameter = (float)$hsim_graindiameter;
		$graindiameterunit = check_unit($hsim_graindiameterunit, $unit_length);
		$graincore = (float)$hsim_graincore;
		$graincoreunit = check_unit($hsim_graincoreunit, $unit_length);
		$cstaradj = (float)$hsim_cstaradj;
		$injectordia = (float)$hsim_injectordia;
		$injectordiaunit = check_unit($hsim_injectordiaunit, $unit_length);
		$injectorcount = (int)$hsim_injectorcount;
		$injectorcd = (float)$hsim_injectorcd;
		$nozzlethroat = (float)$hsim_nozzlethroat;
		$nozzlethroatunit = check_unit($hsim_nozzlethroatunit, $unit_length);
		if ($hsim_noztype == "dia") {
			$noztype = 1;
			$nozzleexit = (float)$hsim_nozzleexit;
		} else {
			$noztype = 2;
			$nozzleexit = sqrt($nozzlethroat * $nozzlethroat * (float)$hsim_nozexpand);
		}
		$nozzleexitunit = check_unit($hsim_nozzleexitunit, $unit_length);
		$nozzlehalfangle = (float)$hsim_nozzlehalfangle;
		$nozzlehalfangleunit = check_unit($hsim_nozzlehalfangleunit, $unit_angle);
		$nozcfadj = (float)$hsim_nozcfadj;
		if (isset($hsim_fillpress)) {
			$fillstyle = 1;
			$fillpress = (float)$hsim_fillpress;
			$fillpressunit = check_unit($hsim_fillpressunit, $unit_pressure);
			$filldrop = 100.;
			$filldropunit = "psi";
		} else {
			$fillstyle = 2;
			$fillpress = 400.;
			$fillpressunit = "psi";
			$filldrop = (float)$hsim_filldrop;
			$filldropunit = check_unit($hsim_filldropunit, $unit_pressure);
		}
		$filltemp = (float)$hsim_filltemp;
		$filltempunit = check_unit($hsim_filltempunit, $unit_temperature);
		$drymass = (float)$hsim_drymass;
		$drymassunit = check_unit($hsim_drymassunit, $unit_mass);
		$ambientpressure = (float)$hsim_ambientpressure;
		$ambientpressureunit = check_unit($hsim_ambientpressureunit, $unit_pressure);
	}
	
	// This section checks the inputs for obvious errors.
	// If any of them are found, we display errors and do not run the simulator.
	
	if ($tankheight <= 0.)
		{$tankheighterror = true; $inputerror = true;}
	if ($ullageheight < 0.)
	 	{$ullageheighterror = true; $inputerror = true;}
	if ($tankdia <= 0.)
		{$tankdiaerror = true; $inputerror = true;}
	if ($ventdia < 0.)
			{$ventdiaerror = true; $inputerror = true;}
	if ($ventdia > 0. && $ventcd <= 0.)
		{$ventcderror = true; $inputerror = true;}

	if ($grainlength <= 0.)
	 	{$grainlengtherror = true; $inputerror = true;}
	if ($graindiameter <= 0.)
		{$graindiametererror = true; $inputerror = true;}
	if ($graincore <= 0. || $graincore >= $graindiameter)
		{$graincoreerror = true; $inputerror = true;}
	if ($cstaradj <= 0. || $cstaradj > 1.)
		{$cstaradjerror = true; $inputerror = true;}
	if ($injectordia <= 0.)
		{$injectordiaerror = true; $inputerror = true;}

	if ($injectorcount <= 0)
		{$injectorcounterror = true; $inputerror = true;}
	if ($injectorcd <= 0.)
		{$injectorcderror = true; $inputerror = true;}
	if ($nozzlethroat <= .0)
		{$nozzlethroaterror = true; $inputerror = true;}
	if ($nozzleexit <= 0.)
		{$nozzleexiterror = true; $inputerror = true;}
	if (!$nozzlethroaterror && !$nozzleexiterror) {
		$arat = $nozzleexit * $nozzleexit / ($nozzlethroat * $nozzlethroat);
		if ($arat < 1.1 || $arat > 8.0)
			{$nozzleexperror = true; $inputerror = true;}
	}
	
	if ($nozzlehalfangle < 0. ||
	     ($nozzlehalfangleunit == "radian" && $nozzlehalfangle > 3.1416) ||
		 $nozzlehalfangle > 90.)
		 	{$nozzlehalfanagleerror = true; $inputerror = true;}
	if ($nozcfadj < 0. || nozcfadj > 1.)
		{$nozcfadjerror = true; $inputerror = true;}
	if ($fillpress <= 0.)
		{$fillpresserror = true; $inputerror = true;}
	if ($filltemp <= 0.)
		{$filltemperror = true; $inputerror = true;}
	if ($filldrop < 0.)
		{$filldroperror = true; $inputerror = true;}

	if ($drymass < 0.)
		{$drymasserror = true; $inputerror = true;}		
	if ($ambientpressure < 0.)
		{$ambientpressurerror = true; $inputerror = true;}
	
	?>
<body onload="document.SD_sstyle=<?php echo($noztype);?>;SD_pageInit();">
<table width="998">
  <tr>
    <td><a href="../index.html"><img src="../hybridsky.png" width="499" height="112" border="0" /></a> </td>
  </tr>
  <tr>
    <td ><h3 align="center" class="style1">HSIM -- An <a href="opensource.html#OpenSource">Open Source</a> Simulator for Amateur Nitrous Hybrid Rocket Motors</h3>
      <p class="Normal" align="center"><a href="opensource.html">Click here for more information on HSIM</a>.</p>
      <hr/>
    </td>
  </tr>
  <tr>
    <td><form action="" method="post" name="SimulatorInput" target="_self" id="SimulatorInput">
        <table border="1" align="center" cellpadding="3" cellspacing="0">
          <?php if ($inputerror) { ?>
          <tr>
            <td colspan="3" align="center" class="ErrorMsg"><h4>Input Errors were found.  Correct indicated inputs and resubmit.</h4></td>
          </tr>
          <?php } ?>
          <tr>
            <td ><table>
                <tr>
                  <th colspan="3"><span class="Normal"><a href="tank.html">Flight Tank</a> </span></th>
                </tr>
                <tr>
                  <td><p class="ParameterName"><a href="tank.html#TankHeight">Tank Height</a></p></td>
                  <td><input name="tankheight"
		     type="text"
		     id="tankheight"
		     value="<?php echo ($tankheight); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td><select name="tankheightunit" size="1">
                      <option value="mm"
	<?php if ($tankheightunit == "mm") echo ("selected=\"selected\"");?> >millimeters</option>
                      <option value="in"
	<?php if ($tankheightunit == "in") echo ("selected=\"selected\"");?> >inches</option>
                    </select></td>
                </tr>
                <?php if ($tankheighterror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Tank Height must be a positive number</td>
                </tr>
                <?php } ?>
                <tr>
                  <td class="ParameterName"><a href="tank.html#UllageHeight">Ullage Height</a></td>
                  <td><input name="ullageheight"
		     type="text"
		     id="ullageheight"
		     value="<?php echo ($ullageheight); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td><select name="ullageheightunit" size="1">
                      <option value="mm"
	<?php if ($ullageheightunit == "mm") echo ("selected=\"selected\"");?> >millimeters</option>
                      <option value="in"
	<?php if ($ullageheightunit == "in") echo ("selected=\"selected\"");?> >inches</option>
                    </select></td>
                </tr>
                <?php if ($ullageheighterror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Ullage Height must be a non negative number </td>
                </tr>
                <?php } ?>
                <tr>
                  <td class="ParameterName"><a href="tank.html#TankDiameter">Tank Diameter</a></td>
                  <td><input name="tankdia"
		     type="text"
		     id="tankdia"
		     value="<?php echo ($tankdia); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td><select name="tankdiaunit" size="1">
                      <option value="mm"
	<?php if ($tankdiaunit == "mm") echo ("selected=\"selected\"");?> >millimeters</option>
                      <option value="in"
	<?php if ($tankdiaunit == "in") echo ("selected=\"selected\"");?> >inches</option>
                    </select></td>
                </tr>
                <?php if ($tankdiaerror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Tank Diameter must be a positive number</td>
                </tr>
                <?php } ?>
                <tr>
                  <td class="Normal"><a href="tank.html#VentDiameter">Vent Diameter</a></td>
                  <td><input name="ventdia"
		     type="text"
		     id="ventdia"
		     value="<?php echo ($ventdia); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td><select name="ventdiaunit" size="1">
                      <option value="mm"
	<?php if ($ventdiaunit == "mm") echo ("selected=\"selected\"");?> >millimeters</option>
                      <option value="in"
	<?php if ($ventdiaunit == "in") echo ("selected=\"selected\"");?> >inches</option>
                    </select></td>
                </tr>
                <?php if ($ventdiaerror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Vent Diameter must be a non-negative number</td>
                </tr>
                <?php } ?>
                <tr>
                  <td class="ParameterName"><a href="tank.html">Vent Cd</a></td>
                  <td><input name="ventcd"
		     type="text"
		     id="ventcd"
		     value="<?php echo ($ventcd); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td>&nbsp;</td>
                </tr>
                <?php if ($ventcderror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Vent Cd must be a positive number</td>
                </tr>
                <?php } ?>
              </table></td>
            <td width="3">&nbsp;</td>
            <td><table>
                <tr>
                  <th colspan="3" class="Normal"><a href="chamber.html">Combustion Chamber</a></th>
                </tr>
                <tr>
                  <td class="ParameterName"><a href="chamber.html#Fuel">Fuel</a></td>
                  <td><select name="fuel">
                      <option value="PBAN"
	<?php if ($fuel == "PBAN") echo ("selected=\"selected\"");?> >PBAN</option>
                      <option value="PVC"
	<?php if ($fuel == "PVC") echo ("selected=\"selected\"");?> >PVC Pipe</option>
                    </select>
                  </td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td class="ParameterName"><a href="chamber.html#GrainLength">Grain Length</a></td>
                  <td><input name="grainlength"
		     type="text"
		     id="grainlength"
		     value="<?php echo ($grainlength); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td><select name="grainlengthunit" size="1">
                      <option value="mm"
	<?php if ($grainlengthunit == "mm") echo ("selected=\"selected\"");?> >millimeters</option>
                      <option value="in"
	<?php if ($grainlengthunit == "in") echo ("selected=\"selected\"");?> >inches</option>
                    </select></td>
                </tr>
                <?php if ($grainlengtherror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Grain Length must be a positive number</td>
                </tr>
                <?php } ?>
                <tr>
                  <td class="ParameterName"><a href="chamber.html#GrainOuterDiameter">Grain Outer Diameter</a></td>
                  <td><input name="graindiameter"
		     type="text"
		     id="graindiameter"
		     value="<?php echo ($graindiameter); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td><select name="graindiameterunit" size="1">
                      <option value="mm"
	<?php if ($graindiameterunit == "mm") echo ("selected=\"selected\"");?> >millimeters</option>
                      <option value="in"
	<?php if ($graindiameterunit == "in") echo ("selected=\"selected\"");?> >inches</option>
                    </select></td>
                </tr>
                <?php if ($graindiametererror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Grain Diameter must be a positive number</td>
                </tr>
                <?php } ?>
                <tr>
                  <td class="ParameterName"><a href="chamber.html#GrainInitialCore">Grain Initial Core Diameter</a></td>
                  <td><input name="graincore"
		     type="text"
		     id="graincore"
		     value="<?php echo ($graincore); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td><select name="graincoreunit" size="1">
                      <option value="mm"
	<?php if ($graincoreunit == "mm") echo ("selected=\"selected\"");?> >millimeters</option>
                      <option value="in"
	<?php if ($graincoreunit == "in") echo ("selected=\"selected\"");?> >inches</option>
                    </select></td>
                </tr>
                <?php if ($graincoreerror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Grain Core must be a positive number less than Grain Diameter </td>
                </tr>
                <?php } ?>
                <tr>
                  <td class="ParameterName"><a href="chamber.html#CstarAdjust">C* Efficiency </a></td>
                  <td><input name="cstaradj"
		     type="text"
		     id="cstaradj"
		     value="<?php echo ($cstaradj); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td>&nbsp;</td>
                </tr>
                <?php if ($cstaradjerror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">C* Efficiency must be a positive number less than or equal to 1.0</td>
                </tr>
                <?php } ?>
              </table></td>
          </tr>
          <tr>
            <td><table>
                <tr>
                  <th colspan="3" class="Normal"><a href="injectors.html">Injectors</a></th>
                </tr>
                <tr>
                  <td class="ParameterName"><a href="injectors.html#InjectorDiameter">Injector Diameter</a></td>
                  <td><input name="injectordia"
		     type="text"
		     id="injectordia"
		     value="<?php echo ($injectordia); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td><select name="injectordiaunit" size="1">
                      <option value="mm"
	<?php if ($injectordiaunit == "mm") echo ("selected=\"selected\"");?> >millimeters</option>
                      <option value="in"
	<?php if ($injectordiaunit == "in") echo ("selected=\"selected\"");?> >inches</option>
                    </select></td>
                </tr>
                <?php if ($injectordiaerror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Injector Diameter must be a positive number</td>
                </tr>
                <?php } ?>
                <tr>
                  <td class="ParameterName"><a href="injectors.html#NumberOfInjectors">Number of Injectors</a></td>
                  <td><input name="injectorcount"
		     type="text"
		     id="injectorcount"
		     value="<?php echo ($injectorcount); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td>&nbsp;</td>
                </tr>
                <?php if ($injectorcounterror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Injector Count must be a positive number</td>
                </tr>
                <?php } ?>
                <tr>
                  <td class="ParameterName"><a href="injectors.html">Injector Cd</a></td>
                  <td><input name="injectorcd"
		     type="text"
		     id="injectorcd"
		     value="<?php echo ($injectorcd); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td>&nbsp;</td>
                </tr>
                <?php if ($injectorcderror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Injector Cd must be a positive number</td>
                </tr>
                <?php } ?>
              </table></td>
            <td>&nbsp;</td>
            <td><table>
                <tr>
                  <th colspan="3" class="Normal"><a href="nozzle.html">Nozzle</a></th>
                </tr>
                <tr>
                  <td class="ParameterName"><a href="nozzle.html#ThroatDiameter">Throat Diameter</a></td>
                  <td><input name="nozzlethroat"
		     type="text"
		     id="nozzlethroat" onchange="MM_callJS('SD_setThroat()')"
		     value="<?php echo ($nozzlethroat); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td><select name="nozzlethroatunit" size="1" onchange="MM_callJS('SD_throatUnit()')">
                      <option value="mm"
	<?php if ($nozzlethroatunit == "mm") echo ("selected=\"selected\"");?> >millimeters</option>
                      <option value="in"
	<?php if ($nozzlethroatunit == "in") echo ("selected=\"selected\"");?> >inches</option>
                    </select></td>
                </tr>
                <?php if ($nozzlethroaterror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Nozzle Throat must be a positive number</td>
                </tr>
                <?php } ?>
                <tr>
                  <td class="ParameterName"><input name="noztype" type="radio" onclick="MM_changeProp('nozzleexit','','disabled',false,'INPUT/TEXT');MM_changeProp('nozexpand','','disabled',true,'INPUT/TEXT');MM_callJS('document.SD_estyle = 1')" value="dia"
		<?php if ($noztype == 1) { ?> checked="checked" <?php } ?> />
                    <a href="nozzle.html#ExitDiameter">Exit Diameter</a></td>
                  <td><input name="nozzleexit"
		     type="text" <?php if ($noztype != 1) { ?> disabled="disabled" <?php } ?>
		     id="nozzleexit" onblur="MM_callJS('SD_setThroat()')"
		     value="<?php echo ($nozzleexit); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td><select name="nozzleexitunit" size="1" onchange="MM_callJS('SD_exitUnit()')">
                      <option value="mm"
	<?php if ($nozzleexitunit == "mm") echo ("selected=\"selected\"");?> >millimeters</option>
                      <option value="in"
	<?php if ($nozzleexitunit == "in") echo ("selected=\"selected\"");?> >inches</option>
                    </select></td>
                </tr>
                <?php if ($nozzletxiterror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Nozzle Exit must be a positive number</td>
                </tr>
                <?php } ?>
                <tr>
                  <td class="ParameterName"><input name="noztype" type="radio" onclick="MM_changeProp('nozzleexit','','disabled',true,'INPUT/TEXT');MM_changeProp('nozexpand','','disabled',false,'INPUT/TEXT');MM_callJS('document.SD_estyle = 0')" value="exp"
  		<?php if ($noztype == 2) { ?> checked="checked" <?php } ?> />
                    <a href="nozzle.html#AreaExpansionRatio">Area Expansion Ratio </a></td>
                  <td><input name="nozexpand"
		     type="text" <?php if ($noztype != 2) { ?> disabled="disabled" <?php } ?>
		     id="nozexpand" onblur="MM_callJS('SD_setThroat()')"
		     value="0"
		     size="8" maxlength="16" />
                  </td>
                  <td>&nbsp;</td>
                </tr>
                <?php if ($nozzlethroaterror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Nozzle Area Expansion Ratio must be a in the range [1.1, 8.0]</td>
                </tr>
                <?php } ?>
                <tr>
                  <td class="ParameterName"><a href="nozzle.html#HalfAngle">Half Angle</a></td>
                  <td><input name="nozzlehalfangle"
		     type="text"
		     id="nozzlehalfangle"
		     value="<?php echo ($nozzlehalfangle); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td><select name="nozzlehalfangleunit" size="1" >
                      <option value="degrees"
	<?php if ($nozzlehalfangleunit == "degree") echo ("selected=\"selected\"");?> >degrees</option>
                      <option value="radians"
	<?php if ($nozzlethroatunit == "radian") echo ("selected=\"selected\"");?> >radians</option>
                    </select></td>
                </tr>
                <?php if ($nozzlehalfangleerror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Half Angle must be in the range [0, 90] degrees</td>
                </tr>
                <?php } ?>
                <tr>
                  <td class="ParameterName"><a href="nozzle.html#CfAdjust">Cf Fudge Factor </a></td>
                  <td><input name="nozcfadj"
		     type="text"
		     id="nozcfadj"
		     value="<?php echo ($nozcfadj); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td>&nbsp;</td>
                </tr>
                <?php if ($nozcfadjerror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Cf Fudge Factor must be a in the range [0.0, 1.0]</td>
                </tr>
                <?php } ?>
              </table></td>
          </tr>
          <tr>
            <td><table>
                <tr>
                  <th colspan="3" class="Normal"><a href="fill.html">Fill Conditions</a></th>
                </tr>
                <tr>
                  <td class="ParameterName"><input name="filltype" type="radio" onclick="MM_changeProp('fillpress','','disabled',false,'INPUT/TEXT');MM_changeProp('filldrop','','disabled',true,'INPUT/TEXT')" value="abs"
	<?php if ($fillstyle == 1) { ?> checked="checked" <?php } ?> />
                    <a href="fill.html#FlightTankPressure">Initial Flight Tank Pressure</a></td>
                  <td><input name="fillpress"
		     type="text" <?php if ($fillstyle == 2) { ?> disabled="disabled" <?php } ?>
		     id="fillpress"
		     value="<?php echo ($fillpress); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td><select name="fillpressunit" size="1">
                      <option value="psi"
	<?php if ($fillpressunit == "psi") echo ("selected=\"selected\"");?> >PSI</option>
                    </select></td>
                </tr>
                <?php if ($fillpresserror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Fill Pressure must be a positive number</td>
                </tr>
                <?php } ?>
                <tr>
                  <td class="ParameterName"><input name="filltype" type="radio" onclick="MM_changeProp('fillpress','','disabled',true,'INPUT/TEXT');MM_changeProp('filldrop','','disabled',false,'INPUT/TEXT')" value="drop"
	<?php if ($fillstyle == 2) { ?> checked="checked" <?php } ?> />
                    <a href="fill.html#FlightPressureDrop">Flight Tank Pressure Drop</a></td>
                  <td><input name="filldrop"
		     type="text" <?php if ($fillstyle == 1) { ?> disabled="disabled" <?php } ?>
		     id="filldrop"
		     value="<?php echo ($filldrop); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td><select name="filldropunit" size="1">
                      <option value="psi"
	<?php if ($filldropunit == "psi") echo ("selected=\"selected\"");?> >PSI</option>
                    </select></td>
                </tr>
                <?php if ($filldroperror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Flight Tank Pressure Drop must be a non-negative number</td>
                </tr>
                <?php } ?>
                <tr>
                  <td class="ParameterName"><a href="fill.html">Supply Tank Temperature</a></td>
                  <td><input name="filltemp"
		     type="text"
		     id="filltemp"
		     value="<?php echo ($filltemp); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td><select name="filltempunit" size="1">
                      <option value="F"
	<?php if ($filltempunit == "F") echo ("selected=\"selected\"");?> >degrees F</option>
                      <option value="C"
	<?php if ($filltempunit == "C") echo ("selected=\"selected\"");?> >degrees C</option>
                    </select></td>
                </tr>
                <?php if ($filltemperror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Fill Temp must be a positive number</td>
                </tr>
                <?php } ?>
              </table></td>
            <td>&nbsp;</td>
            <td><table>
                <tr>
                  <th class="Normal"><a href="rocksim.html">Overall Physical Properties</a></th>
                </tr>
                <tr>
                  <td class="ParameterName"><a href="rocksim.html#DryMass">Dry Mass</a></td>
                  <td><input name="drymass"
		     type="text"
		     id="drymass"
		     value="<?php echo ($drymass); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td><select name="drymassunit" size="1">
                      <option value="kg"
	<?php if ($drymassunit == "kg") echo ("selected=\"selected\"");?> >kg</option>
                      <option value="lbm"
	<?php if ($drymassunit == "lbm") echo ("selected=\"selected\"");?> >lbs</option>
                    </select></td>
                </tr>
                <?php if ($drymasserror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Dry Mass must be a non-negative number</td>
                </tr>
                <?php } ?>
                <tr>
                  <td class="ParameterName"><a href="nozzle.html#">Ambient Air Pressure</a> </td>
                  <td><input name="ambientpressure"
		     type="text"
		     id="ambientpressure"
		     value="<?php echo ($ambientpressure); ?>"
		     size="8" maxlength="16" />
                  </td>
                  <td><select name="ambientpressureunit" size="1" id="ambientpressureunit">
                      <option value="atm"
	<?php if ($ambientpressureunit == "atm") echo ("selected=\"selected\"");?> >atm</option>
                      <option value="psi"
	<?php if ($ambientpressureunit == "psi") echo ("selected=\"selected\"");?> >psi</option>
                    </select></td>
                </tr>
                <?php if ($ambientpressureerror) { ?>
                <tr>
                  <td colspan="3" class="ErrorMsg">Ambient Air Pressure must be a non-negative number</td>
                </tr>
                <?php } ?>
              </table></td>
          </tr>
          <tr>
            <td colspan="3" align="center"><input type="submit" name="Submit" value="Submit" /></td>
          </tr>
        </table>
      </form></td>
  </tr>
  <?php
	if (isset($hsim_fuel) && !$inputerror) {
 ?>
  <tr>
    <td colspan="3"><?php

	flush();
	error_reporting(E_ALL);
		
	$s = session_id();
	if (!ereg('^[^./][^/]*$', $s))
	    die('bad session id'); // something is very wrong

	$wrapper = "../../support/hs_wrap.sh -S " . $s . " ";
	
	$output_handle = popen($wrapper . "-i", "w");
	fwrite($output_handle, "fuel " . $fuel . "\n");
	fwrite($output_handle, "tankheight " . $tankheight . " " . $tankheightunit . "\n");
	fwrite($output_handle, "ullageheight " . $ullageheight . " " . $ullageheightunit . "\n");
	fwrite($output_handle, "tankdia " . $tankdia . " " . $tankdiaunit . "\n");
	fwrite($output_handle, "ventdia " . $ventdia . " " . $ventdiaunit . "\n");
	fwrite($output_handle, "ventcd " . $ventcd . " " ."\n");
	fwrite($output_handle, "grainlength " . $grainlength . " " . $grainlengthunit . "\n");
	fwrite($output_handle, "graindiameter " . $graindiameter . " " . $graindiameterunit . "\n");
	fwrite($output_handle, "graincore " . $graincore . " " . $graincoreunit . "\n");
	fwrite($output_handle, "cstaradj " . $cstaradj . " " . "\n");
	fwrite($output_handle, "injectordia " . $injectordia . " " . $injectordiaunit . "\n");
	fwrite($output_handle, "injectorcount " . $injectorcount . " " . "\n");
	fwrite($output_handle, "injectorcd " . $injectorcd . " " . "\n");
	fwrite($output_handle, "nozzlethroat " . $nozzlethroat . " " . $nozzlethroatunit . "\n");
	fwrite($output_handle, "nozzleexit " . $nozzleexit . " " . $nozzleexitunit . "\n");
	fwrite($output_handle, "nozcfadj " . $nozcfadj . " " . "\n");
	if ($fillstyle == 1)
		fwrite($output_handle, "fillpress " . $fillpress . " " . $fillpressunit . "\n");
	else
		fwrite($output_handle, "filldrop " . $filldrop . " " . $filldropunit . "\n");
	fwrite($output_handle, "filltemp " . $filltemp . " " . $filltempunit . "\n");
	fwrite($output_handle, "drymass " . $drymass . " " . $drymassunit . "\n");
	fwrite($output_handle, "ambientpressure " . $ambientpressure . " " . $ambientpressureunit . "\n");
	pclose($output_handle);

	echo "<hr/>\n";
  ?>
      <div class="Hsimerrors" id="ErrorReport">
        <pre><?php passthru($wrapper . "-e"); ?>
</pre>
      </div>
      <table width="100%">
        <tr>
          <td><?php
	passthru($wrapper . "-r");
  ?></td>
          <td width="256" valign="top" class="Normal">Click <a href="<?php passthru($wrapper . "-R");?>">here</a> to download <a href="http://www.apogeerockets.com/rocksim.asp">Rocksim 8</a> engine file</td>
        </tr>
      </table></td>
  </tr>
  <?php } ?>
  L
</table>
</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
	$name = "";
	$t = "Picture Gallery";
	import_request_variables("g", "pxm_");
	if (isset($pxm_n))
		$t = $name = $pxm_n;
 ?>	
<title><?php echo $t; ?></title>
<style type="text/css">
<!--
.style2 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
</head>
<body>
<?php
/*
 * This page displays a medium sized picture.
 * The ?n= argument is the name of the image.
 */
 
	require("pixsmall.php");
	if ("" == $name)
		trigger_error("missing or null get argument \"?n=name\"", E_USER_ERROR);
	$dir = "";
	if (isset($pxm_d))
		$dir = $pxm_d;
	if ("" == $dir)
		trigger_error("missing or null get argument \"?d=dir\"", E_USER_ERROR);
	$full_path = $_SERVER["DOCUMENT_ROOT"] . $dir;

	$medium = $dir . get_pix($full_path, $name, 1);
	$large = $dir . get_pix($full_path, $name, 0);
	if (strcmp($medium, $large) == 0)  :
 ?>
<img src="<?php echo htmlspecialchars($large); ?>" border="0" />
<?php
	else :
 ?>
<table cellpadding="1">
  <tr><td><a href="<?php echo htmlspecialchars($large); ?>"><img src="<?php echo htmlspecialchars($medium); ?>" border="0" /></a></td>
</tr>
<tr><td><a href="<?php echo htmlspecialchars($large); ?>" class="style2" >Click here for full picture</a></td>
</tr>
</table> 
<?php
	endif
 ?>
</body>

</html>

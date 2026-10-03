<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>test v2.7</title>
</head>
<body>
This page is used to test the php image processing macros. <br />
<hr />
My include path is: 
<?php 
	echo ini_get("include_path");
?> <br /><hr />
<?php
	require("pixsmall.php");
?>

<p>Here is our path: <?php echo get_path(); ?></p>
<p>Here is a photo:</p><?php thumbnailreference("DSCN2423", 2); ?>
<br /><hr />
<?php
	/* This section lists all of the $_ENF variables. */
	foreach ($_SERVER as $k => $v) {
		echo '$_SERVER[ ' . $k . ' ] contains ' . $v . '<br />';
//echo $v;
	}
 ?>
<hr />
<?php /*thumbnailreference("DSCN2423", 2);*/ ?>

<br />
</body>
</html>

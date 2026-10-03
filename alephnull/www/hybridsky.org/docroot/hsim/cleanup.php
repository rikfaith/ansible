<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>HSIM Temp File Cleanup Report</title>
<link href="../styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="768">
  <tr><th class="Normal">HSIM Cleanup Report</th>
</tr>
<tr><td>
<pre>
<?php
	passthru("ls -l ../../support/hs_wrap.sh");
	passthru("../../support/hs_wrap.sh -X");
?>
</pre></td></tr></table>
</body>
</html>

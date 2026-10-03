<?php // -*- html -*-
// Created: Sat Oct 13 08:38:50 2001 by faith@dict.org
// Revised: Sat Oct 13 16:28:57 2001 by faith@dict.org
// $Id$
?>

<?php
$strat = array();
$db    = array();

function readstrategies($f)
{
    global $strat;
    $strat["."]="Default";
    if (!feof($f)) fgets($f, 1024); // discard first line
    while (!feof($f)) {
        $buffer = trim(fgets($f, 1024));
	$name   = strtok($buffer, " 	");
	$value  = strtok("");
	$strat[$name]=$value;
    }
}

function readdatabases($f)
{
    global $db;
    $db["*"]="All databases";
    if (!feof($f)) fgets($f, 1024); // discard first line
    while (!feof($f)) {
        $buffer = trim(fgets($f, 1024));
	$name   = strtok($buffer, " 	");
	$value  = strtok("");
	$db[$name]=$value;
    }
}

if (!($f = @fopen("../support/strategies","r"))) {
    $f = @popen("$dictbin -S", "r");
    readstrategies($f);
    @pclose($f);
} else {
    readstrategies($f);
    @fclose($f);
}
if (!($f = @fopen("../support/databases","r"))) {
    $f = @popen("$dictbin -D", "r");
    readdatabases($f);
    @pclose($f);
} else {
    readdatabases($f);
    @fclose($f);
}

?>
    <center>
      <form name="DICT" method="POST" action="dict.html">
        <center>
          <table>
            <tr>
              <td align="right">
                <b>Query String:</b>
              </td>
              <td align="left">
                <input type="text" name="Query" size=40
                  value="<?php echo "$query" ?>">
              </td>
            </tr>
            <tr>
              <td align="right">
                <b>Search type:</b>
              </td>
              <td align="left">
                <select name="Strategy">
                <?php
                    foreach ($strat as $name => $value) {
		        if ($name != "0") {
		            echo "<option value=\"$name\"";
		            if ($strategy == "") $strategy = $name;
		            if ($strategy == $name) echo " selected";
		            echo ">$value\n";
		        }
	            }
                ?>
                </select>
              </td>
            </tr>
            <tr>
              <td align="right">
                <b>Database:</b>
              </td>
              <td align="left">
                <select name="Database">
                <?php
                    foreach ($db as $name => $value) {
		        if ($name != "0") {
		            echo "<option value=\"$name\"";
		            if ($database == "") $database = $name;
		            if ($database == $name) echo " selected";
		            echo ">$value\n";
		        }
	            }
                ?>
                </select>
              </td>
            </tr>
          </table>
          <br>
          <input type="submit" value="Look Up Definition">
          <input type="reset" value="Reset form">
        </center>
      </form>
    Definition not available or out of date?
    <a href="http://www.dict.org/file.html">Contribute to FILE</a>.
    <br>
    <a href="dict.html?Query=00-database-info">Database copyright
    information</a>
    <br>
    <a href="server.php">Server information</a>
    </center>

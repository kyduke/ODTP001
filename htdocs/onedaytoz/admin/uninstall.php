<?include "../../../include/dbconn.toz";?>

<?
$table = "user";
$query = "DROP TABLE $table";

$result = NULL;
$result = mysql_query($query, $connect);
if ($result != NULL)
{
	echo "DROP TABLE '$table' success!<br />";
}
else
{
	echo "DROP TABLE '$table' failed!<br />";
}
?>

<?
$table = "session";
$query = "DROP TABLE $table";

$result = NULL;
$result = mysql_query($query, $connect);
if ($result != NULL)
{
	echo "DROP TABLE '$table' success!<br />";
}
else
{
	echo "DROP TABLE '$table' failed!<br />";
}
?>

<?
$table = "relation";
$query = "DROP TABLE $table";

$result = NULL;
$result = mysql_query($query, $connect);
if ($result != NULL)
{
	echo "DROP TABLE '$table' success!<br />";
}
else
{
	echo "DROP TABLE '$table' failed!<br />";
}
?>

<?
$table = "item";
$query = "DROP TABLE $table";

$result = NULL;
$result = mysql_query($query, $connect);
if ($result != NULL)
{
	echo "DROP TABLE '$table' success!<br />";
}
else
{
	echo "DROP TABLE '$table' failed!<br />";
}
?>

<?
$table = "possession";
$query = "DROP TABLE $table";

$result = NULL;
$result = mysql_query($query, $connect);
if ($result != NULL)
{
	echo "DROP TABLE '$table' success!<br />";
}
else
{
	echo "DROP TABLE '$table' failed!<br />";
}
?>

<?
$table = "relationhistory";
$query = "DROP TABLE $table";

$result = NULL;
$result = mysql_query($query, $connect);
if ($result != NULL)
{
	echo "DROP TABLE '$table' success!<br />";
}
else
{
	echo "DROP TABLE '$table' failed!<br />";
}
?>

<?
$table = "possessionhistory";
$query = "DROP TABLE $table";

$result = NULL;
$result = mysql_query($query, $connect);
if ($result != NULL)
{
	echo "DROP TABLE '$table' success!<br />";
}
else
{
	echo "DROP TABLE '$table' failed!<br />";
}
?>

<?
$table = "event";
$query = "DROP TABLE $table";

$result = NULL;
$result = mysql_query($query, $connect);
if ($result != NULL)
{
	echo "DROP TABLE '$table' success!<br />";
}
else
{
	echo "DROP TABLE '$table' failed!<br />";
}
?>

<?include "../../../include/dbclose.toz";?>
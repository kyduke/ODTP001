<?include "../../../include/dbconn.toz";?>

<?
$table = "user";
$query = "
CREATE TABLE IF NOT EXISTS $table (
id int(8) NOT NULL auto_increment,
userid char(32),
primary key (id)
)";

$result = NULL;
$result = mysql_query($query, $connect);
if ($result != NULL)
{
	echo "CREATE TABLE '$table' success!<br />";
}
else
{
	echo "CREATE TABLE '$table' failed!<br />";
}
?>

<?
$table = "session";
$query = "
CREATE TABLE IF NOT EXISTS $table (
id int(8) NOT NULL auto_increment,
user int(8),
session char(8),
deviceid char(40),
datetime datetime,
primary key (id)
)";

$result = NULL;
$result = mysql_query($query, $connect);
if ($result != NULL)
{
	echo "CREATE TABLE '$table' success!<br />";
}
else
{
	echo "CREATE TABLE '$table' failed!<br />";
}
?>

<?
$table = "relation";
$query = "
CREATE TABLE IF NOT EXISTS $table (
id int(8) NOT NULL auto_increment,
owner int(8),
friend int(8),
visited int(1),
primary key (id)
)";

$result = NULL;
$result = mysql_query($query, $connect);
if ($result != NULL)
{
	echo "CREATE TABLE '$table' success!<br />";
}
else
{
	echo "CREATE TABLE '$table' failed!<br />";
}
?>

<?
$table = "item";
$query = "
CREATE TABLE IF NOT EXISTS $table (
id int(8) NOT NULL auto_increment,
name char(32),
primary key (id)
)";

$result = NULL;
$result = mysql_query($query, $connect);
if ($result != NULL)
{
	echo "CREATE TABLE '$table' success!<br />";
}
else
{
	echo "CREATE TABLE '$table' failed!<br />";
}
?>

<?
$table = "possession";
$query = "
CREATE TABLE IF NOT EXISTS $table (
id int(8) NOT NULL auto_increment,
owner int(8),
item int(8),
quantity int(4) DEFAULT 0 NOT NULL,
primary key (id)
)";

$result = NULL;
$result = mysql_query($query, $connect);
if ($result != NULL)
{
	echo "CREATE TABLE '$table' success!<br />";
}
else
{
	echo "CREATE TABLE '$table' failed!<br />";
}
?>

<?
$table = "relationhistory";
$query = "
CREATE TABLE IF NOT EXISTS $table (
id int(8) NOT NULL auto_increment,
owner int(8),
friend int(8),
action int(4),
datetime datetime,
primary key (id)
)";

$result = NULL;
$result = mysql_query($query, $connect);
if ($result != NULL)
{
	echo "CREATE TABLE '$table' success!<br />";
}
else
{
	echo "CREATE TABLE '$table' failed!<br />";
}
?>

<?
$table = "possessionhistory";
$query = "
CREATE TABLE IF NOT EXISTS $table (
id int(8) NOT NULL auto_increment,
sender int(8),
receiver int(8),
item int(8),
quantity int(4) DEFAULT 0 NOT NULL,
datetime datetime,
primary key (id)
)";

$result = NULL;
$result = mysql_query($query, $connect);
if ($result != NULL)
{
	echo "CREATE TABLE '$table' success!<br />";
}
else
{
	echo "CREATE TABLE '$table' failed!<br />";
}
?>

<?
$table = "event";
$query = "
CREATE TABLE IF NOT EXISTS $table (
id int(8) NOT NULL auto_increment,
owner int(8),
type int(1),
relation int(8),
possession int(8),
primary key (id)
)";

$result = NULL;
$result = mysql_query($query, $connect);
if ($result != NULL)
{
	echo "CREATE TABLE '$table' success!<br />";
}
else
{
	echo "CREATE TABLE '$table' failed!<br />";
}
?>

<?include "../../../include/dbclose.toz";?>
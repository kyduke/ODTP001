<?include "../../include/dbconn.toz";?>

<?
$category = $_GET["category"];

if ($category != NULL)
{
	switch ($category)
	{
		case "session":
		case "user":
			include "$category/$category.php";
			break;
		default:
			$json = array("error" => "Unknown parameters");
	}
}
else
{
	$json = array("error" => "Invalid parameters");
}

echo json_encode($json);
?>

<?include "../../include/dbclose.toz";?>
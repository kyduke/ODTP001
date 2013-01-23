<?
include "../../include/dbconn.toz";
include "../../include/global.toz";

function main()
{
	$category = $_GET["category"];
	
	if ($category == NULL)
	{
		$json = array("error" => "Invalid parameters");
		return printJSON($json);
	}
	
	$action = $_GET["action"];
	if ($action == NULL)
	{
		$json = array("error" => "Invalid parameters");
		return printJSON($json);
	}
	
	$data = json_decode(stripslashes($_POST["data"]));

	switch ($category)
	{
		case "session":
		case "user":
		case "friends":
			include "$category/$category.php";
			$json = categoryMain($action, $data);
			break;
		default:
			$json = array("error" => "Unknown parameters");
	}
	
	return printJSON($json);
}

function printJSON($json)
{
	header("Content-type: application/json");
	echo json_encode($json);
}

main();

include "../../include/dbclose.toz";
?>
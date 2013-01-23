<?
if ($category == NULL)
{
	exit();
}

function categoryMain($action, $data)
{
	if ($action == "add")
	{
		return addFriends($data);
	}
	else if ($action == "remove")
	{
		return removeFriends($data);
	}
	
	return array("error" => "Unknown parameters");
}

function addFriends($data)
{
	$userid = $data->{"userid"};
	
	return array("userid" => "$userid");
}

function addUser($userid)
{
	$result = mysql_query("INSERT INTO user (userid) VALUES ('$userid')");
	
	if ($result == TRUE)
	{
		return getIDFromUser($userid);
	}
	
	return NULL;
}
?>
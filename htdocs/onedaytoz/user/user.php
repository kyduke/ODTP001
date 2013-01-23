<?
if ($category == NULL)
{
	exit();
}

function categoryMain($action, $data)
{
	if ($action == "check")
	{
		return checkUser($data);
	}
	else if ($action == "join")
	{
		return joinUser($data);
	}
	
	return array("error" => "Unknown parameters");
}

function checkUser($data)
{
	$userid = $data->{"userid"};
	$agentid = $data->{"agentid"};
		
	if ($userid == NULL || $agentid == NULL)
	{
		return array("error" => "Invalid parameters");
	}
	
	$agent = getAgentID($agentid);
	if ($agent < 0)
	{
		return array("error" => "Invalid parameters");
	}
	
	$uid = getIDFromUser($userid);
	if ($uid != NULL)
	{
		return array("check" => TRUE);
	}
	
	return array("check" => FALSE);
}

function joinUser($data)
{
	$userid = $data->{"userid"};
	$agentid = $data->{"agentid"};
	
	if ($userid == NULL || $agentid == NULL)
	{
		return array("error" => "Invalid parameters");
	}
	
	$agent = getAgentID($agentid);
	if ($agent < 0)
	{
		return array("error" => "Invalid parameters");
	}
	
	$uid = getIDFromUser($userid);
	if ($uid != NULL)
	{
		return array("join" => TRUE);
	}
	else
	{
		$uid = addUser($userid);
		if ($uid != NULL)
		{
			return array("join" => TRUE);
		}
	}
	
	return array("join" => FALSE);
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
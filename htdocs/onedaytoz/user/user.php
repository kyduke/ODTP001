<?
if ($category == NULL)
{
	exit();
}

$action = $_GET["action"];

if ($action != NULL)
{
	if ($action == "check")
	{
		$userid = $_POST["userid"];
		$agentid = $_POST["agentid"];
		
		if ($userid != NULL && $agentid != NULL)
		{
			$agent = getAgentID($agentid);
			if ($agent >= 0)
			{
				$uid = getIDFromUser($userid);
				if ($uid != NULL)
				{
					$json = array("check" => TRUE);
				}
				else
				{
					$json = array("check" => FALSE);
				}
			}
			else
			{
				$json = array("error" => "Invalid parameters");
			}
		}
	}
	else if ($action == "join")
	{
		$userid = $_POST["userid"];
		$agentid = $_POST["agentid"];
		
		if ($userid != NULL && $agentid != NULL)
		{
			$agent = getAgentID($agentid);
			if ($agent >= 0)
			{
				$uid = getIDFromUser($userid);
				if ($uid != NULL)
				{
					$json = array("join" => TRUE);
				}
				else
				{
					$uid = addUser($userid);
					if ($uid != NULL)
					{
						$json = array("join" => TRUE);
					}
					else
					{
						$json = array("join" => FALSE);
					}
				}
			}
			else
			{
				$json = array("error" => "Invalid parameters");
			}
		}
	}
	else
	{
		$json = array("error" => "Unknown parameters");
	}
}
else
{
	$json = array("error" => "Invalid parameters");
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
<?
if ($category == NULL)
{
	exit();
}

function categoryMain($action, $data)
{
	if ($action == "check")
	{
		return checkSession($data);
	}
	else if ($action == "connect")
	{
		return connectSession($data);
	}
	else if ($action == "disconnect")
	{
		return disconnectSession($data);
	}
	
	return array("error" => "Unknown parameters");
}

function checkSession($data)
{
	$userid = $data->{"userid"};
	$session = $data->{"session"};
	
	if ($userid == NULL || $session == NULL)
	{
		return array("error" => "Invalid parameters");
	}
	
	$uid = getIDFromUser($userid);
	if ($uid != NULL)
	{
		$check = checkUserSession($uid, $session);
		return array("check" => $check);
	}
	
	return array("error" => "Unregistered user");
}

function connectSession($data)
{
	$userid = $data->{"userid"};
	$agentid = $data->{"agentid"};
	$deviceid = $data->{"deviceid"};
	
	if ($userid == NULL || $agentid == NULL || $deviceid == NULL)
	{
		return array("error" => "Invalid parameters");
	}
	
	$uid = getIDFromUser($userid);
	if ($uid == NULL)
	{
		return array("error" => "Unregistered user");
	}
	
	$agent = getAgentID($agentid);
	if ($agent < 0)
	{
		return array("error" => "Invalid parameters");
	}
	
	$session = getSession($uid, $userid, $agent, $deviceid);
	if ($session != NULL)
	{
		return array("session" => "$session");
	}
	
	return array("session" => NULL);
}

function disconnectSession($data)
{
	$userid = $data->{"userid"};
	$session = $data->{"session"};
	
	if ($userid == NULL || $session == NULL)
	{
		return array("error" => "Invalid parameters");
	}
	
	$uid = getIDFromUser($userid);
	if ($uid == NULL)
	{
		return array("error" => "Unregistered user");
	}
	
	$check = checkUserSession($uid, $session);
	if ($check != true)
	{
		return array("error" => "Not exist session");
	}
	
	$result = deleteSession($uid, $session);
	if ($result == true)
	{
		return array("session" => NULL);
	}
	
	return array("error" => "Not exist session");
}

function checkUserSession($uid, $session)
{
	$result = mysql_query("SELECT id FROM session WHERE user='$uid' AND session='$session' LIMIT 1");
	
	if ($result != NULL)
	{
		$row = mysql_fetch_array($result);
		if ($row != NULL)
		{
			$datetime = date("Y-m-d H:i:s", time());
			$result = mysql_query("UPDATE session SET datetime='$datetime' WHERE id=$row[id]");
			if ($result != NULL)
			{
				return true;
			}
		}
	}
	
	return false;
}

function getSession($uid, $userid, $agent, $deviceid)
{
	$STRINGTABLE = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$result = mysql_query("SELECT id, session, datetime FROM session WHERE user='$uid' AND deviceid='$deviceid' LIMIT 1");
	
	if ($result != NULL)
	{
		$row = mysql_fetch_array($result);
		if ($row != NULL)
		{
			$timediff = time() - strtotime($row[datetime]);
			if ($timediff >= 0 && $timediff <= (7 * 24 * 60 * 60))
			{
				return $row[session];
			}
			else
			{
				$result = mysql_query("DELETE FROM session WHERE id=$row[id]");
				if ($result == NULL)
				{
					return NULL;
				}
			}
		}
	}
	
	$now = time();
	
	$temp = (date("Y", $now) + ord(substr($userid, 0, 1)) + ord(substr($deviceid, 0, 1))) % 36;
	$session = substr($STRINGTABLE, $temp, 1);
	$temp = (date("m", $now) + ord(substr($userid, 1, 1)) + ord(substr($deviceid, 1, 1))) % 36;
	$session .= substr($STRINGTABLE, $temp, 1);
	$temp = (date("d", $now) + ord(substr($userid, 2, 1)) + ord(substr($deviceid, 2, 1))) % 36;
	$session .= substr($STRINGTABLE, $temp, 1);
	$temp = (date("w", $now) + ord(substr($userid, 3, 1)) + ord(substr($deviceid, 3, 1))) % 36;
	$session .= substr($STRINGTABLE, $temp, 1);
	$temp = (date("H", $now) + ord(substr($userid, 4, 1)) + ord(substr($deviceid, 4, 1))) % 36;
	$session .= substr($STRINGTABLE, $temp, 1);
	$temp = (date("i", $now) + ord(substr($userid, 5, 1)) + ord(substr($deviceid, 6, 1))) % 36;
	$session .= substr($STRINGTABLE, $temp, 1);
	$temp = (date("s", $now) + ord(substr($userid, 6, 1)) + ord(substr($deviceid, 6, 1))) % 36;
	$session .= substr($STRINGTABLE, $temp, 1);
	
	if ($agent)
	{
		$session .= rand(0, 4) * 2 + 1;
	}
	else
	{
		$session .= rand(0, 4) * 2;
	}
	
	$datetime = date("Y-m-d H:i:s", $now);
	$query = "INSERT INTO session (user, session, deviceid, datetime) VALUES ($uid, '$session', '$deviceid', '$datetime')";
	$result = mysql_query($query);
	
	if ($result != NULL)
	{
		return $session;
	}
	
	return NULL;
}

function deleteSession($uid, $session)
{
	$result = mysql_query("DELETE FROM session WHERE user=$uid AND session='$session'");
	
	if ($result != NULL)
	{
		return true;
	}
	
	return false;
}
?>

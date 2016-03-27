<?php

$user = $_POST["userid"];
$pass = $_POST["password"];

if ($user == "root" && $pass == "Nbc444")
{
	echo "Welcome";

} else 
{
	echo "Not welcome";
}
?>
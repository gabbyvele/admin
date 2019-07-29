<?php
	session_start();
	$_SESSION["KMEATSUSer"] = "gab";
	if(!isset($_SESSION["KMEATSUSer"]))
	{
		$_SESSION["KMEATSUSer"] = "0";
	}
	if($_SESSION["KMEATSUSer"] == "0")
	{
		header("Location: index.php");
	}
?>
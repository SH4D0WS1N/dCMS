<?php
/*
    dCMS - A simple Content Management System
    Copyright (C) 2011  Joshua "SH4D0WS1N" Souza

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
include "inc.php";
$sql = "SELECT *
		FROM passwords";
$result = mysql_query($sql) or die ("Unable to access password table: " . mysql_error());
$sql = "SELECT *
		FROM passwords
		WHERE id=-1";
$result2 = mysql_query($sql) or die ("Unable to access password table: " . mysql_error());
$pepper = mysql_fetch_array($result2);
$salt = $pepper["password"];
$asdf = false;
while($row = mysql_fetch_array($result)){
	echo "Password attempted: " . $_POST['pass'] . "<br>";
	echo "Hash of attempted pw and the salt: " . hash("sha256", $salt.$_POST['pass']) . "<br>";
	echo "Salt: " . $salt . "<br>";
	echo "Stored hashed password being tried where id = " . $row["id"] . ": " . $row["password"] . "<br>";
	if($row["password"] == hash("sha256", $salt.$_POST['pass'])){
		$asdf = true;
	}
}
if($asdf){
		session_start(); 
		$_SESSION['auth'] = true;
		header('Location: manage.php');
	}
else{
	$content = "Incorrect password. Attempt recorded.";
	$page = str_replace("{content}",$content,$page);
	$page = str_replace("{title}","Authentication page",$page);
	echo $page;
	mysql_close($con);
}
?>

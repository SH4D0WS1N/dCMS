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
session_start(); 
if(!isset($_SESSION['auth'])){
	echo "You are not authenticated";
}
else{
	include $GLOBALS["dir"] . 'inc.php';
	
	$sql = "SELECT *
	FROM subnavbar
	WHERE navitem =" . $_GET['id'];
	$result = mysql_query($sql);
	$content = "";
	while($row = mysql_fetch_array($result)){
		$sql = "SELECT *
		FROM dCMS
		WHERE id=" . $row['pageid'];
		$result2 = mysql_query($sql);
		$row2 = mysql_fetch_array($result2);
		$content .= $row2['name'] . " - <a href='subnavdel.php?id=" . $row['id'] . "'>Delete</a><br>";
	}
	$content .= "<br>Add a sub-navbar link:<br>";
	$sql = "SELECT *
	FROM dCMS";
	$result = mysql_query($sql);
	while($row = mysql_fetch_array($result)){
		$content .= "<a href='subnavadd.php?id=" . $row['id'] . "&sid=" . $_GET['id'] . "'>" . $row['name'] . "</a><br>";
	}
	$page = str_replace("{content}",$content,$page);
	$page = str_replace("{title}","Edit an item in the navbar",$page);
	echo $page;
	mysql_close($con);
}
?>

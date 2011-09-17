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
include $GLOBALS["dir"] . 'inc.php';
if(!isset($_SESSION['auth'])){
	echo "You are not authenticated";
}
else{
	if($_GET['id']>0){
		$sql = "SELECT *
		FROM subnavbar
		WHERE id=" . $_GET['id'];
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		$sql = "DELETE FROM subnavbar
		WHERE id=" . $_GET['id'];
		mysql_query($sql);
		header("Location: navbar.php?id=" . $row['navitem']);
	}
	else{
		$content = "Invalid navbar part. You should never see this message.";
	}

	$page = str_replace("{content}",$content,$page);
	$page = str_replace("{title}","Deletion of a subnavbar item status",$page);
	echo $page;
	mysql_close($con);
}
?>

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
include 'inc.php';
if(!isset($_SESSION['auth'])){
	echo "You are not authenticated";
}
else{
	if($_GET['id']>0){
		$sql = "DELETE FROM dCMS
		WHERE id=" . $_GET['id'];
		mysql_query($sql);
		header("Location: /manage.php");
	}
	else{
		$content = "Invalid page. Stop trying to delete important pages.";
	}

	$page = str_replace("{content}",$content,$page);
	$page = str_replace("{title}","Deletion of page status",$page);
	echo $page;
	mysql_close($con);
}
?>

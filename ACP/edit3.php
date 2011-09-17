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
	include 'inc.php';
	if($_POST['pName']!="" && $_POST['pContent']!=""){
		$sql = "UPDATE dCMS
		SET name='" . $_POST['pName'] .
		"', content='" . $_POST['pContent'] .
		"'
		WHERE id=" . $_GET['id'];
		mysql_query($sql);
		$content = "Page modified successfully<br><a href='edit.php'>Return</a>";
	}
	else{
		$content = "Page name or content was blank.<br>Page not created.";
	}

	$page = str_replace("{content}",$content,$page);
	$page = str_replace("{title}","Edition of page status",$page);
	echo $page;
	mysql_close($con);
}
?>

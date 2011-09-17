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
	
	$id = $_GET['id'];
	$sql= "SELECT *
	FROM dCMS
	WHERE id=" . $id;
	$result99 = mysql_query($sql);
	$editpage = mysql_fetch_array($result99);
	$content = '<form action="edit3.php?id=' . $id . '" method="post">
	Page name: <input type="text" name="pName" value="' . $editpage['name'] .
	'"><br>
	Page Content:
	<br>
	<textarea cols="100" rows="25" name="pContent" wrap=physical>' . $editpage['content'] . '</textarea>
	<br>
	<input type="submit" />
	</form>
	<br><br>
	<input type="button" value="Delete" onClick="var a=confirm(\'Are you sure you want to delete this post?\');if(a){window.location=\'delete.php?id=' . $id . '\';}">
	<br><br><br>BBCode used';
	$page = str_replace("{content}",$content,$page);
	$page = str_replace("{title}","Edit a page",$page);
	echo $page;
	mysql_close($con);
}
?>

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
$count=0;
//echo "Test trace: " . $count++;
$navbar="";
$navbars = array();
$sql="SELECT *
FROM subnavbar";
$result01 = mysql_query($sql) or die($sql."<br/><br/>".mysql_error());
while($row01 = mysql_fetch_array($result01)){
	$sql="SELECT *
	FROM dCMS
	WHERE id=".$row01['pageid'];
	$result22 = mysql_query($sql) or die($sql."<br/><br/>".mysql_error());
	$row22 = mysql_fetch_array($result22);
	$navbars[$row01['navitem']] .= "<li><a href='" . $dir . "page.php?id=" . $row01['pageid'] . "'><span>" . $row22['name'] . "</span></a></li>";
}
$navbar.="<script type='text/javascript'>
all = new Array();\n";
foreach($navbars as $a => $value){
	$navbar.="all[" . $a . "] = \"<ul>" . $value . "</ul>\";\n";
}
$navbar.="function subnav(id){
	if(window.all[id] !== undefined){
		document.getElementById('subnavbar').innerHTML=all[id];
	}
	else{
		document.getElementById('subnavbar').innerHTML='';
	}
}</script>\n";
$navbar .= "<ul><li><a href='" . $dir . "index.php' onMouseOver='subnav(-20000);'><span>Home</span></a></li>";
$sql="SELECT *
FROM navbar";
$result02 = mysql_query($sql);
while($row02 = mysql_fetch_array($result02)){
	$sql="SELECT *
	FROM dCMS
	WHERE id=".$row02['pageid'];
	$result33 = mysql_query($sql);
	$row33 = mysql_fetch_array($result33);
	$navbar .= "<li><a href='" . $dir . "page.php?id=" . $row02['pageid'] . "' onMouseOver='subnav(" . $row02['id'] . ");'><span>" . $row33['name'] . "</span></a></li>";
}
$navbar .= "</ul>";
//$nnStr="<a href='" . $dir . "manage.php'>ACP</a> | <a href='" . $dir . "logout.php'>Log out</a><br><br>";
?>
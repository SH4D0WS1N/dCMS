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
$id = 0;
include 'inc.php';

//////////////////////////////////////////////////////////
// Replaces {content} with the selected content
//////////////////////////////////////////////////////////
$id = sanitize($id);// DLCL.php
$sql= "SELECT *
FROM dCMS
WHERE id=" . $id;
$result1 = mysql_query($sql);
$content = mysql_fetch_array($result1);
$page = str_replace("{content}",bbc_parse($content["content"]) /* DLCL.php */,$page);
$page = str_replace("{title}","Home",$page);
echo $page;
mysql_close($con);
?>
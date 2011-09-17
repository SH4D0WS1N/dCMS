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


//Create a file that will hold the database information but cannot be viewed externally.
$dbFileName = "dbinfo.php";
$dbFileHandle = fopen($dbFileName, 'r+') or die("Cannot open or create database file");
if(fread($dbFileHandle, 5) == "<?php"){
	echo "Database information already exists... Using that instead. (If you wish to use other database information, delete dbinfo.php)<br>";
}
else{
	fwrite($dbFileHandle, '<?php
$con = mysql_connect("' . $_POST["dbadd"] . '","' . $_POST["dbusr"] . '","' . $_POST["dbpss"] . '");
if (!$con){
	die("Could not connect: " . mysql_error());
	}
$dir = "' . $_POST["dir"] . '";
$_GLOBALS["dir"] = $dir; //So that sub directories can use this file properly
?>');
}
fclose($dbFileHandle);
include("dbinfo.php");

if (mysql_query("CREATE DATABASE dCMS",$con)){
	echo "Database created<br>";
}
else{
	die("Error creating database: " . mysql_error());
}
// Create table
mysql_select_db("dCMS", $con);
$sql = "CREATE TABLE dCMS
(
id int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
name text,
content blob
)";

// Execute query
if (mysql_query($sql))
{
	echo "Table created<br>";
}
else
{
	die("Error creating table: " . mysql_error());
}
// Create table
mysql_select_db("dCMS", $con);
$sql = "CREATE TABLE templates
(
id int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
replace text,
content blob
)";

// Execute query
if (mysql_query($sql))
{
	echo "Table created<br>";
}
else
{
	die("Error creating table: " . mysql_error());
}

$sql = "INSERT INTO dCMS
(
id,
name,
content
)
VALUES
(
0,
'Home',
'Hello World!')";

// Execute query
if (mysql_query($sql))
{
	echo "Table created<br>";
}
else
{
	die("Error creating table: " . mysql_error());
}

$sql = "INSERT INTO template
(
id,
replace,
content
)
VALUES
(
-1,
'{header}',
'<!-- include .css file here -->
</head>
<body>
<div class=\"header\">
<div class=\"headertitle\">{CMStitle}<br></div>
<hr>
<div id=\"navbar\" class=\"navbarcss\">{navbar}</div>
<div id=\"subnavbar\" class=\"subnavbarcss\"></div>
<div class=\"quote\">\"Igniting the flames of passion!\"</div>
</div>
<div class=\"content\">')";

// Execute query
if (mysql_query($sql))
{
	echo "Template created<br>";
}
else
{
	die("Error creating template: " . mysql_error());
}

$sql = "INSERT INTO template
(
id,
replace,
content
)
VALUES
(
-2,
'{footer}',
'Hello Foot')";

// Execute query
if (mysql_query($sql))
{
	echo "Template created<br>";
}
else
{
	die("Error creating template: " . mysql_error());
}

$sql = "INSERT INTO template
(
id,
replace,
content
)
VALUES
(
-3,
'{CMStitle}',
'" . $_POST["title"] . "')";

// Execute query
if (mysql_query($sql))
{
	echo "Template created<br>";
}
else
{
	die("Error creating template: " . mysql_error());
}

$sql = "INSERT INTO template
(
id,
replace,
content
)
VALUES
(
0,
'',
'<html>
<head>{title} - {CMStitle}</head>
{header}
{content}
{footer}
</body>
</html>')";

// Execute query
if (mysql_query($sql))
{
	echo "Template created<br>";
}
else
{
	die("Error creating template: " . mysql_error());
}

$sql = "CREATE TABLE navbar
(
id int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
pageid int
)";

// Execute query
if (mysql_query($sql))
{
	echo "Table created<br>";
}
else
{
	die("Error creating table: " . mysql_error());
}

$sql = "CREATE TABLE subnavbar
(
id int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
pageid int,
navitem int
)";

// Execute query
if (mysql_query($sql))
{
	echo "Table created<br>";
}
else
{
	die("Error creating table: " . mysql_error());
}
$sql = "CREATE TABLE passwords
(
id int NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
password text
)";

$salt = substr(md5(uniqid(rand(), true)), 0, 10);

// Execute query
if (mysql_query($sql))
{
	echo "Table created<br>";
}
else
{
	die("Error creating table: " . mysql_error());
}

$sql = "INSERT INTO passwords
(
id,
text
)
VALUES
(
0, " . $salt
. ")";

if (mysql_query($sql))
{
	echo "Salt created<br>";
}
else
{
	die("Error creating salt: " . mysql_error());
}

$sql = "INSERT INTO passwords
(
id,
text
)
VALUES
(
1, " . hash("sha256", $salt.$_POST["pass"])
. ")";

if (mysql_query($sql))
{
	echo "Default password created<br>";
}
else
{
	die("Error creating default password: " . mysql_error());
}

echo "<br>Database finalized.<br>You may now delete this file.";
mysql_close($con);
?>
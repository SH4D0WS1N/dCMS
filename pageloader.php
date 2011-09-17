<?php
//////////////////////////////////////////////////////////
// Replaces {navbar} with the navbar in the header.
// 
// Note: {navbar} only works within the header.
//////////////////////////////////////////////////////////
$sql= "SELECT *
FROM templates
WHERE id=-1";
$result2 = mysql_query($sql);
$header = mysql_fetch_array($result2);
$temp = str_replace("{navbar}",$navbar,$header);

//////////////////////////////////////////////////////////
// Replaces {header} with the newly created header, $temp.
//////////////////////////////////////////////////////////
$sql= "SELECT *
FROM templates
WHERE id=1";
$result4 = mysql_query($sql);
$page1 = mysql_fetch_array($result4);
$page=$page1["content"];
$page = str_replace("{header}",$temp["content"],$page);

//////////////////////////////////////////////////////////
// Replaces the rest of their tags with their content.
//
// Note: tags within tags do not work
//////////////////////////////////////////////////////////
$sql= "SELECT *
FROM templates
WHERE id<>-1 AND id<>1";
$result3 = mysql_query($sql);
while($row = mysql_fetch_array($result3)){
	$page = str_replace($row['replacement'],$row['content'],$page);
}
$sql= "SELECT *
FROM templates
WHERE id<>-1 AND id<>1";
$result3 = mysql_query($sql);
while($row = mysql_fetch_array($result3)){
	$page = str_replace($row['replacement'],$row['content'],$page);
}
if(!isset($_SESSION)){
	session_start();
}
if(!isset($_SESSION['auth'])){
	$new = "";
}
else{
	$new = "<a href='" . $dir . "ACP/'>ACP</a> | <a href='" . $dir . "'>Home page</a> | <a href='" . $dir . "ACP/logout.php'>Log out</a>";
}
$page = str_replace("{ACP}",$new,$page);
?>
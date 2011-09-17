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
$temp = str_replace("{navbar}",$navbar,$header)

//////////////////////////////////////////////////////////
// Replaces {header} with the newly created header, $temp.
//////////////////////////////////////////////////////////
$sql= "SELECT *
FROM templates
WHERE id=0";
$result4 = mysql_query($sql);
$page = mysql_fetch_array($result4);
$page = str_replace("{header}",$temp,$page);

//////////////////////////////////////////////////////////
// Replaces the rest of their tags with their content.
//
// Note: tags within tags do not work
//////////////////////////////////////////////////////////
$sql= "SELECT *
FROM templates
WHERE id<>-1 AND id<>0";
$result3 = mysql_query($sql);
while($row = mysql_fetch_array($result3)){
	$page = str_replace($row['replace'],$row['content'],$page);
}
?>
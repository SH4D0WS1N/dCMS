<?php
/////////////////////////////
// DownLoaded Code Library
//
// Credits given
/////////////////////////////



//////////////////////////////////////////////////////////
// BBCode Parser
//
// Replaces popular Bulliten Board Codes
// with their html equivilant.
// Note: Removes all HTML
//
// Source: 
// http://www.ultramegatech.com/blog/2009/04/creating-a-bbcode-parser/
//
// Parameters:
// $str - String to be parsed
//
// Returns:
// New string with HTML
//////////////////////////////////////////////////////////

function bbc_parse($str){
	// Convert all special HTML characters into entities to display literally
	$str = htmlentities($str);
	// The array of regex patterns to look for
	$format_search =  array(
		'#\[b\](.*?)\[/b\]#is', // Bold ([b]text[/b]
		'#\[i\](.*?)\[/i\]#is', // Italics ([i]text[/i]
		'#\[u\](.*?)\[/u\]#is', // Underline ([u]text[/u])
		'#\[s\](.*?)\[/s\]#is', // Strikethrough ([s]text[/s])
		'#\[quote\](.*?)\[/quote\]#is', // Quote ([quote]text[/quote])
		'#\[code\](.*?)\[/code\]#is', // Monospaced code [code]text[/code])
		'#\[size=([1-9]|1[0-9]|20)\](.*?)\[/size\]#is', // Font size 1-20px [size=20]text[/size])
		'#\[color=\#?([A-F0-9]{3}|[A-F0-9]{6})\](.*?)\[/color\]#is', // Font color ([color=#00F]text[/color])
		'#\[color=\([a-zA-z0-9]\](.*?)\[/color\]#is', // Font color ([color=#00F]text[/color])
		'#\[url=((?:ftp|https?)://.*?)\](.*?)\[/url\]#i', // Hyperlink with descriptive text ([url=http://url]text[/url])
		'#\[url\]((?:ftp|https?)://.*?)\[/url\]#i', // Hyperlink ([url]http://url[/url])
		'#\[img\](https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]#i' // Image ([img]http://url_to_image[/img])
		//'#\[usr=(https?://.*?\.(?:jpg|jpeg|gif|png|bmp))\](.*?)\[/usr\]#i' // Template for people ([usr=bob.jpg]BOB<br>GREAT GUY[/usr])
	);
	// The matching array of strings to replace matches with
	$format_replace = array(
		'<strong>$1</strong>',
		'<em>$1</em>',
		'<span style="text-decoration: underline;">$1</span>',
		'<span style="text-decoration: line-through;">$1</span>',
		'<blockquote>$1</blockquote>',
		'<pre>$1</'.'pre>',
		'<span style="font-size: $1px;">$2</span>',
		'<span style="color: #$1;">$2</span>',
		'<span style="color: $1;"$2</spawn>',
		'<a href="$1">$2</a>',
		'<a href="$1">$1</a>',
		'<img src="$1" alt="" />'
	);
	// Perform the actual conversion
	$str = preg_replace($format_search, $format_replace, $str);
	// Convert line breaks in the <br /> tag
	$str = nl2br($str);
	return $str;
}

/////////////////////////////
// Sanitization function
//
// Prevents SQL injections
//
// Source:
//
// http://www.bitrepository.com/sanitize-data-to-prevent-sql-injection-attacks.html
//
// Parameters:
// $data - String to be cleaned
//
// Returns:
// Sanitized string
/////////////////////////////

function sanitize($data)
{
// remove whitespaces (not a must though)
$data = trim($data); 

// apply stripslashes if magic_quotes_gpc is enabled
if(get_magic_quotes_gpc())
{
$data = stripslashes($data);
}

// a mySQL connection is required before using this function
$data = mysql_real_escape_string($data);

return $data;
}
?>
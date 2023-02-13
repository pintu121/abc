<?
$commonkeysarrayWrite = array(
	'Title'			=>	substr(base64_decode($_REQUEST['lastFile']),0,-4),
	'Artist'		=>	'www.MirchiLoft.Com',
	'Album'			=>	base64_decode($_REQUEST['catName']).' - MirchiLoft.Com',
	'Year'			=>	date("Y"),
	'Comment'		=>	'Downloaded from http://www.MirchiLoft.Com',
	'Composer'	        =>	'www.MirchiLoft.Com',
	'Publisher'	        =>	'www.MirchiLoft.Com',
);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<?php
include $this -> configs['root_dir'].$this -> configs['helpers_dir']."HTML_HEADER.php";

HTML_HEADER::add_meta(['http-equiv' => 'content-type', 'content' => "text/html; charset=UTF-8"]);
HTML_HEADER::add_css(['href' => 'css/bootstrap.css']);
HTML_HEADER::add_js(['src' => 'js/jquery-1.11.1.min.js']);

HTML_HEADER::add_js(['src' => 'js/bootstrap.js']);

HTML_HEADER::Display();


?>
</head>

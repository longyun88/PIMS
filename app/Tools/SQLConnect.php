<?php

namespace App\Tools;

class SQLConnect
{
	//$pdo=new PDO("mysql:host=localhost","root","123456",array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8"));
	//$pdo=new PDO("mysql:host=live2.cc;port=3306","root","123456");
	$pdo=new PDO("mysql:host=localhost","root","123456");
	$pdo->query('set names UTF8');
	//$pdo->query('set names latin1');
	//$pdo ->exec('set names UTF8);
	//mysql_query('SET NAMES UTF8');
	return $pdo;
	
}
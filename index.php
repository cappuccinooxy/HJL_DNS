<?php
//防止中文乱码
header('Content-type:text/html; charset=utf-8');  
//时区
date_default_timezone_set("Asia/Shanghai"); 

//判断版本
if(version_compare(PHP_VERSION,'7.0.0','<')) {
	die('require PHP > 7.0.0 !');
	exit();
} 

	
// 定义应用目录
define('APP_PATH','./Application/');

// 引入thought入口文件
require './thought/base.php';
require CORE_PATH.'Db.php';  //配置加载或方法
require CORE_PATH.'Page.php';  //分页
require CORE_PATH.'Pages.php';  //后台分页
/** 防止 XSS **/
session_name("CNZZ_DATA");
setcookie("SESSID", md5(date("Y-m-j:H")));
setcookie("PHPSESSID", md5(time()));
$config = require CONFIG."database.php";
$type = $config['type'];
$dbname = $config['database'];
$host = $config['host'];
$username = $config['username']; // 用户名
$password = $config['password']; //密码
  //连接数据库
$db = mysqli_connect($host,$username,$password,$dbname);
      mysqli_query($db, 'set names utf8');
if (!$db) 
{ 
    die("连接错误: " . mysqli_connect_error()); 
}
//三元运算
$module = isset($_GET['m']) ? $_GET['m'] : "admin";
$controller = isset($_GET['c']) ? $_GET['c'] : "index";
//加载控制器
include APP_PATH.$module .'/controller/'. $controller . '.php';

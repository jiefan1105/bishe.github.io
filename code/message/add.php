<?php
header('Content-type: text/html; charset=UTF8');
//获取用户名
$user = $_POST["user"];
//获取留言标题
$title = $_POST["title"];
//获取留言内容
$content = $_POST["content"];
//获取正在浏览当前页面用户的 IP 地址。 
$ip = $_SERVER["REMOTE_ADDR"];
//echo $ip;

//包含数据库与函数文件
require_once "config.php";
require_once "sql_config.php";

//类无法直接访问，需要得到类的具体对象才能访问，可以通过实例化来实现对象。
$ma1 = new DB();

//访问对象里面的属性与方法
$link = $ma1->connect();

//插入数据库语句
$sql = "insert into message (username,title,ip,content,time) values('$user','$title','$ip','$content',now())";

if ($user == "" || $title == "" || $content == "") {
    echo "<script>alert('你输入的留言信息不完整！');location='message.html';</script>";
} 

else {
    $res = $ma1->insertl($link, $sql);
}

?>
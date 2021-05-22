<?php
include("config.php");
class DB
{
    //连接数据库
    function connect()
    {
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PWD); //连接数据库

        mysqli_set_charset($link, DB_CHARSET); //设置数据库字体格式

        mysqli_select_db($link, DB_DBNAME) or die('数据库打开失败'); //选择数据库
        //mysqli_connect_errno（）函数返回上一次连接错误的错误代码。
        
        if (mysqli_connect_errno()) {
            die('数据库连接失败 : ' . mysqli_connect_errno());
        }
        //输出信息
        return $link;
    }


    function insertl($link, $sql)
    {
        if (mysqli_query($link, $sql)) {
            echo "<script language='javascript'> alert('留言成功!');location='select.php'; </script>";
        } 

        else {
            echo "Error insert data: " . $link->error;
        }
    }

    function insert2($link, $query_sql)
    {
        mysqli_query($link, $query_sql);
    }
}
// $a = new DB();
// $B = $a->connect();
// echo '<pre>';
// print_r($B);

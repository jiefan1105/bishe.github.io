<?php
header('Content-type: text/html; charset=UTF8');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="message.css">
</head>

<body>
    <center>
        <h2>我的留言板</h2>
        <input type="button" value="添加留言" onclick="location.href='message.html'" class="button" />
        <input type="button" value="查看留言" onclick="location.href='select.php'" class="button" />
        <input type="button" value="退出登陆" onclick="location.href='../login/login.html'" class="button" />
        <hr width="70%">
        <?php
        /*
        //关闭所有报错
        error_reporting(0);
        //包含数据库与函数文件
        require_once "config.php";
        require_once "sql_config.php";
        //类无法直接访问，需要得到类的具体对象才能访问，可以通过实例化来实现对象。
        $ma = new DB();
        //访问对象里面的属性与方法
        $link = $ma->connect();
        */
        //数据库连接  
        $con = @mysqli_connect("127.0.0.1", "root", "root", "web");
        if (!$con) {
            die("数据库连接错误" . mysqli_connect_error());
        }

        mysqli_query($con, "set names 'utf8'");

        //执行 查询 语句
        $query_sql = "select * from message";

        $result = mysqli_query($con, $query_sql);
        echo "<div style='margin-top:55px'>";

        //获取数据每行的数据并输出。
        while ($res = mysqli_fetch_array($result)) {
            echo "<div class='k'>";
            echo "<div class='ds-post-main'>";
            echo "<div class='ds-comment-body'>
			<span> {$res['username']}&nbsp&nbsp于&nbsp&nbsp{$res['time']}  给我留言</span>
			<span style='float:right'><a href = 'delete.php?id=".$res['Id']."'><input type='submit' class='button1' value='删除'></input></a></span>
			<p><span>留言主题 : {$res['title']}&nbsp&nbsp留言地址 : {$res['ip']}</span><p>
            <hr width=450px> 
			<p>{$res['content']}</p></div><br>";
            echo "</div>";
            echo "</div>";

        }
        echo "</div>";
        ?>
    </center>
</body>

</html>
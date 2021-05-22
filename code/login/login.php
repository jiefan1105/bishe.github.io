<?php
header("Content-Type: text/html;charset=utf-8");
// 登录处理界面 logincheck.php
// 判断是否按下登录按钮

if (isset($_POST["submit"])) {
    //将用户名和密码存入变量中，后面使用
    $user = $_POST["username"];
    $pwd = $_POST["userpwd"];

    //判断账户或密码是否为空
    if ($user == "" || $pwd == "") {
        //用户名和密码其中之一为空，则弹出对话框，确定后返回当前的上一页
        echo "<script>alert('请输入用户或密码'); history.go(-1);</script>";
    } 

    else {
        //确认密码是否不为空，则连接数据库
        $conn = mysqli_connect("localhost", "root", "root", "kaifa");

        if (mysqli_errno($conn)) {
            echo "连接失败" . mysqli_errno($conn);
            exit;
        }

        //查询账号密码是否正确
        $sql = "select name,password from user where name ='$user'and password = '$pwd'";

        //返回查询的结果
        $result = mysqli_query($conn, $sql);

        //查询结果的条数
        $num = mysqli_num_rows($result);

        //如果查询的条数不为0
        if ($num) {
            echo "<script>alert('登陆成功');window.location.href='../message/message.html';</script>";
        } 

        else {
            echo "<script>alert('用户或密码不正确!');history.go(-1);</script>";
        }

    }
} 

else {
    echo "<script>alert('提交未成功！');</script>";
}

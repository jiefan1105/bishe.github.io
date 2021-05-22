<?php
// 设置编码
header("Content-Type: text/html;charset=utf-8");

// 使用 isset 函数 检测变量已设置 并非 NULL
if (isset($_POST["register"]) && $_POST["register"] == "完成注册") {

    // 将获取用户注册的账户和密码赋值变量
    $username = $_POST["username"];
    $passwordone = $_POST["passwordone"];
    $passwordtwo = $_POST["passwordtwo"];
    $tel = $_POST["tel"];
    // 判断注册的账户或密码是否为空
    if ($username == "" || $passwordone == "" || $passwordtwo == "" || $tel == "") {
        echo "<script>alert('请确认信息的完整性!');history.go(-1);</script>";
    } else {
        // 如果两次输入的密码一致，则开始连接数据库
        if ($passwordone == $passwordtwo) {
            $conn = mysqli_connect("localhost", "root", "root", "kaifa");
            //如果连接数据库发生错误退出
            if (mysqli_errno($conn)) {
                echo mysqli_errno($conn);
                exit;
            }


            // 判断数据库表中的用户与注册的用户是否有相同的记录
            $sql = "select name from user where name = '$username'";
            /*
        执行SQL语句，并把结果保存在$result中
        针对成功的 SELECT、SHOW、DESCRIBE 或 EXPLAIN 查询，将返回一个 mysqli_result 对象。
        针对其他成功的查询，将返回 TRUE。
        如果失败，则返回 FALSE。
        */
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);

            if ($num) {
                echo "<script>alert('用户已存在!');history.go(-1);</script>";
            } 

            else {
                // 不存在账户，就在数据库用户表中插入。
                $sql_inset = "insert into user(name,password,tel) values('$username','$passwordone','$tel')";

                // 执行插入语句
                $res_insert = mysqli_query($conn, $sql_inset);
                
                //判断插入是否成功
                if ($res_insert) {
                    echo "<script>alert('注册成功!');history.go(-1);</script>";
                } 

                else {
                    echo "<script>alert('插入失败!');history.go(-1);</script>";
                }
            }
        } 

        else {
            echo "<script>alert('密码不一样!');history.go(-1);</script>";
        }
    }
} 

else {
    echo "<script>alert('提交未成功!');history.go(-1)</script>";
}

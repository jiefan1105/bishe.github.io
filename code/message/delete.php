 <?php
    header("content-type:text/html;charset=utf-8");
    // require_once "config.php";
    // require_once 'sql_config.php';
    // $ma1 = new DB();
    // $link = $ma1->connect();
    $link = @mysqli_connect("localhost","root","root","web");


    $id = $_GET['id'];


    if ($link) {
        $sql = "delete from message where id ='$id'";
        $que = mysqli_query($link, $sql);
        var_dump($que);
        if ($que) {
            echo "<script>alert('删除成功，返回首页');location='select.php';</script>";
        } else {
            echo "<script>alert('删除失败');location='select.php'</script>";
            exit;
        }
    }
    ?>
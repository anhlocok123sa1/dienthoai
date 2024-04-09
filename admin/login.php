<?php
session_start();
if (isset($_SESSION['username'])) {
    if ($_SESSION['phanquyen'] == 1) {
        header("location:../index.php");
    }
    if ($_SESSION['phanquyen'] == 0) {
        header("location:admin.php");
    }
}
?>
<link rel="stylesheet" href="css/login.css" type="text/css">
<div class="body">
    <div class="tieude1">
        <div class="quantri">
            <h2>Đăng nhập quản trị</h2>
        </div>
    </div>
    <?php
    include("../include/connect.php");

    if (isset($_POST['login'])) {
        $username = $_POST['user'];
        $password = MD5($_POST['pass']);
        $sql_check = $dbh->prepare("select * from nguoidung where username = :username");
        $sql_check->bindParam(':username', $username);
        $sql_check->execute();
        $dem = $sql_check->rowCount();
        if ($dem == 0) {
            echo "<p class='thongbao1'>Tài khoản không tồn tại</p>";
        } else {
            $sql_check2 = "select * from nguoidung where username = :username and password = :password";
            $rows = $dbh->prepare($sql_check2);
            $rows->bindParam(':username', $username);
            $rows->bindParam(':password', $password);
            $rows->execute();
            $dem2 = $rows->rowCount();
            if ($dem2 == 0)
                echo "<p class='thongbao1'>Mật khẩu không chính xác</p>";
            else {

                while ($row = $rows->fetch(PDO::FETCH_ASSOC)) {
                    $_SESSION['username'] = $username;
                    $_SESSION['phanquyen'] = $row['phanquyen'];
                    $_SESSION['idnd'] = $row['idnd'];
                    if ($row['phanquyen'] == 0) {

                        echo "<script language='javascript'>
								alert('Đăng nhập quản trị thành công');
								window.open('admin.php','_self', 1);
						    </script>";
                    } else {

                        header('location:../index.php');
                    }
                }
            }
        }
    }
    ?>
    <div class="admin_login">
        <form action="" method="post">
            <label>Tên tài khoản:</label><input type="text" name="user" placeholder=" Username"><br>
            <label>Mật khẩu:</label><input type="password" name="pass" placeholder=" Password"><br>
            <button name="login" class="dangnhap">Đăng nhập</button><button class="thoat"><a
                    href="../index.php">Thoát</a></button>
        </form>
    </div>
</div>
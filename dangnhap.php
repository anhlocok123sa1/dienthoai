<?php
session_start();
include("include/connect.php");
if (isset($_POST['login'])) {
	$username = $_POST['user'];
	$password = MD5($_POST['pass']);
	$sql_check = $dbh->prepare("select * from nguoidung where username = :username");
	$sql_check->bindParam(':username', $username);
	$sql_check->execute();
	$dem = $sql_check->rowCount();
	if ($dem == 0) {
		$_SESSION['thongbaolo'] = "Tài khoản không thồn tại";
		echo "
							<script language='javascript'>
								alert('Tài khoản không tồn tại');
								window.open('index.php','_self', 1);
							</script>
						";
	} else {
		$sql_check2 = $dbh->prepare("select * from nguoidung where username = :username and password = :password");
		$sql_check2->bindParam(":username", $username);
		$sql_check2->bindParam(":password", $password);
		$sql_check2->execute();
		$dem2 = $sql_check2->rowCount();
		if ($dem2 == 0)
			echo "
							<script language='javascript'>
								alert('Mật khẩu đăng nhập không đúng');
								window.open('index.php','_self', 1);
							</script>
						";
		else {
			$row = $sql_check2->fetch(PDO::FETCH_ASSOC);

			$_SESSION['username'] = $username;
			$_SESSION['phanquyen'] = $row['phanquyen'];
			$_SESSION['idnd'] = $row['idnd'];

			if ($_SESSION['phanquyen'] == 0) {

				echo "
							<script language='javascript'>
								alert('Đăng nhập thành công');
								window.open('admin/admin.php','_self', 1);
							</script>
						";
			} else {

				echo "
							<script language='javascript'>
								alert('Đăng nhập thành công');
								window.open('index.php','_self', 1);
							</script>
						";
			}
		}
	}
}

?>
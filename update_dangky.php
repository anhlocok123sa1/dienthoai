<?php
include 'include/connect.php';
include 'admin/function/function.php';

if (isset($_POST['submit'])) {
	$tennd = $_POST['tennd'];
	$user = $_POST['user'];
	$pass = MD5($_POST['pass']);
	$email = $_POST['email'];
	$ngaysinh = $_POST['ngaysinh'];
	$gioitinh = $_POST['gioitinh'];
	$dienthoai = $_POST['dienthoai'];
	$diachi = $_POST['diachi'];

	//Lay gio cua he thong
	$dmyhis = date("Y") . date("m") . date("d") . date("H") . date("i") . date("s");
	//Lay ngay cua he thong
	$ngay = date("Y") . ":" . date("m") . ":" . date("d") . ":" . date("H") . ":" . date("i") . ":" . date("s");
	$sql = "INSERT INTO nguoidung (tennd, user, pass, ngaysinh, gioitinh, email, dienthoai, diachi, ngay, some_column_name) 
        VALUES (:tennd, :user, :pass, :ngaysinh, :gioitinh, :email, :dienthoai, :diachi, :ngay, '1')";
	$query = $dbh->prepare($sql);
	$query->bindParam(':tennd', $tennd);
	$query->bindParam(':user', $user);
	$query->bindParam(':pass', $pass);
	$query->bindParam(':ngaysinh', $ngaysinh);
	$query->bindParam(':gioitinh', $gioitinh);
	$query->bindParam(':email', $email);
	$query->bindParam(':dienthoai', $dienthoai);
	$query->bindParam(':diachi', $diachi);
	$query->bindParam(':ngay', $ngay);

	if ($query->execute()) {
		redirect("index.php", "Bạn đã đăng ký thành công.", 2);
		//echo "<p align = center>Đăng ký thành công!</p>";
		//echo '<meta http-equiv="refresh" content="1;url=index.php">';
	} else {
		echo "Thất bại";
	}
}
?>
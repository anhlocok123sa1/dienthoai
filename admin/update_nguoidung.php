<?php
include('../include/connect.php');
include('function/function.php');


$tennd = $_POST['tennd'];
$user = $_POST['user'];
$email = $_POST['email'];
$dienthoai = $_POST['dienthoai'];
$phanquyen = $_POST['phanquyen'];
$id = $_GET['idnd'];
$sql_update = "
    UPDATE nguoidung SET
    tennd = :tennd,
    username = :user,
    email = :email,
    dienthoai = :dienthoai,
    phanquyen = :phanquyen
    WHERE idnd = :id
";

$query = $dbh->prepare($sql_update);

// Bind parameters
$query->bindParam(':tennd', $tennd);
$query->bindParam(':user', $user);
$query->bindParam(':email', $email);
$query->bindParam(':dienthoai', $dienthoai);
$query->bindParam(':phanquyen', $phanquyen);
$query->bindParam(':id', $id, PDO::PARAM_INT);
if ($query->execute()) {
	redirect("admin.php?admin=hienthind", "Bạn đã sửa thành công người dùng.", 2);
} else {
	redirect("admin.php?admin=suand&idnd=$id", "Sửa thất bại", 2);
}

?>
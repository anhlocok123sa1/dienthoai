 <?php
include '../include/connect.php';
include 'function/function.php';
$delete = "DELETE FROM nguoidung WHERE idnd = :idnd";
$query = $dbh->prepare($delete);
$query->bindParam(':idnd', $_GET['idnd']);
$del = $query->execute();
if ($del)
	//echo "thanh cong";
	//header("location: index.php?admin=hienthind");
	redirect ("admin.php?admin=hienthind", "Xóa người dùng thành công. ", 2);
	else
	echo "Xóa người dùng thất bại";
?>
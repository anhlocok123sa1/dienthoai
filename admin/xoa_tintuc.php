 <?php
include '../include/connect.php';
include 'function/function.php';
$delete = "DELETE FROM tintuc WHERE matt = :matt";
$query = $dbh->prepare($delete);
$query->bindParam(':matt', $_GET['matt']);
$del = $query->execute();
if ($del)
	//echo "thanh cong";
	//header("location: index.php?admin=hienthind");
	redirect ("admin.php?admin=hienthitt", "Xóa tin tức thành công. ", 1);
	else
	echo "Xóa tin tức thất bại";
?>
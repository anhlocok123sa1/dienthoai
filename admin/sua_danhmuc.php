<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<link rel="stylesheet" href="css/them_sanpham.css" />
</head>

<body>
	<?php
	include '../include/connect.php';



	if (isset($_POST['btnthem'])) {
		$madm = $_GET['madm']; // Cho lên đầu nhé
		$m = "";
		if ($_POST['tendm'] == NULL) {
			echo "Xin vui lòng nhập tên danh mục<br />";
		} else {
			$m = $_POST['tendm'];
		}




		if ($m) {
			$m = $_POST['tendm'];
			$d = $_POST['dequi'];
			$sql = "UPDATE danhmuc SET tendm = :tendm, dequi = :dequi WHERE madm = :madm";
			$query = $dbh->prepare($sql);
			$query->bindParam(':tendm', $m);
			$query->bindParam(':dequi', $d);
			$query->bindParam(':madm', $madm);
			$query->execute();
			if ($query->errorCode() !== '00000') {
				$errorInfo = $query->errorInfo();
				echo "Error: " . $errorInfo[2];
			}

			header("location:admin.php?admin=hienthidm");
			//exit();
		}
	}

	$sql = "SELECT * FROM danhmuc WHERE madm = :madm";
	$query = $dbh->prepare($sql);
	$query->bindParam(':madm', $_GET['madm']);
	$query->execute();

	$row = $query->fetch(PDO::FETCH_ASSOC); 
	
	?>

	<form action="?admin=suadm&madm=<?php echo $row['madm']; ?>" method="post" name="frm" onsubmit="return kiemtra()">
		<!-- $row ở đâu ra thế? -->
		<table>
			<tr class="tieude_themsp">
				<td colspan=2>Sửa Danh Mục</td>
			</tr>
			<tr>
				<td>Mã danh mục</td>
				<td><input type="text" disabled="disabled" name="madm" size="5" value="<?php echo $row['madm']; ?>" />
				</td>
			</tr>
			<tr>
				<td>Tên danh mục</td>
				<td><input type="text" name="tendm" value="<?php echo $row['tendm']; ?>" /> </td>
			</tr>
			<tr>
				<td>Thuộc</td>
				<td>
					<select name="dequi">
						<option value="0">Danh mục chính</option>
						<?php
						$sql1 = "select * from danhmuc where dequi=0";
						$rows1 = $dbh->prepare($sql1);
						$rows1->execute();
						while ($row1 = $rows1->fetch(PDO::FETCH_ASSOC)) {
							?>
							<option value="<?php echo $row1['madm'] ?>" <?php if ($row1['madm'] == $row['dequi'])
								   echo 'selected="selected"' ?>>
								<?php echo $row1['tendm'] ?>
							</option>
							<?php
						}
						?>

					</select>
				</td>
			</tr>
			<tr>
				<td colspan=2 class="input"> <input type="submit" name="btnthem" value="Update" />
					<input type="reset" name="" value="Hủy" />
				</td>
			</tr>
		</table>
	</form>
</body>

</html>

<script language="javascript">
	function kiemtra() {
		if (frm.tendm.value == "") {
			alert("Bạn chưa nhập tên danh mục. Vui lòng kiểm tra lại");
			frm.tendm.focus();
			return false;
		}
	}
</script>
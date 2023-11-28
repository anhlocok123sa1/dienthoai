<link rel="stylesheet" href="css/them_sanpham.css">
<?php
$matt = $_GET['matt'];
$sql = "SELECT * FROM tintuc WHERE matt = :matt";
$query = $dbh->prepare($sql);
$query->bindParam(':matt', $matt);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);
?>
<form action="update_tintuc.php?matt=<?php echo $matt; ?>" method="post" name="frm" onsubmit=""
    enctype="multipart/form-data">
    <table>
        <tr class="tieude_themsp">
            <td colspan=2>Sửa Tin Tức </td>
        </tr>
        <tr>
            <td>Tiêu đề</td>
            <td><input type="text" name="tieude" size="50" value="<?php echo $row['tieude']; ?>" /></td>
        </tr>
        <tr>
            <td>Nội dung ngắn</td>
            <td><textarea name="ndngan"> <?php echo $row['ndngan']; ?></textarea></td>
        </tr>
        <tr>
            <td>Nội dung chi tiết</td>
            <td><textarea name="noidung" id="chitiet"> <?php echo $row['noidung']; ?></textarea></td>
        </tr>
        <tr>
            <td>Hình ảnh</td>
            <td><img src="../img/tintuc/<?= $row['hinhanh'] ?>" width="80" height="120" /><br /><br /><input type="file"
                    name="hinhanh" /></td>
        </tr>
        <tr>
            <td>Tác giả</td>
            <td><input type="text" name="tacgia" value="<?php echo $row['tacgia']; ?>" /></td>
        </tr>
        <tr>
            <td colspan=2 class="input"> <input type="submit" name="update" value="Update" />
                <input type="reset" name="" value="Hủy" />
            </td>
        </tr>
    </table>

</form>
<script type="text/javascript" language="javascript">

    CKEDITOR.replace('chitiet', {
        uiColor: '#d1d1d1'
    });
</script>
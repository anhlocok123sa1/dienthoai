<?php
if ($action = "insert") {
        $hoten = $_POST['hoten'];
        $dienthoai = $_POST['dienthoai'];
        $diachi = $_POST['diachi'];
        $email = $_POST['email'];
        $phuongthuc = $_POST['phuongthuc'];
        $ngay = date('Y-m-d');
        if (isset($_SESSION['idnd'])) {
                $sqlSelect = "SELECT * FROM nguoidung WHERE idnd = :idnd";
                $querySelect = $dbh->prepare($sqlSelect);
                $querySelect->bindParam(':idnd', $_SESSION['idnd']);
                $querySelect->execute();
                $row = $querySelect->fetch(PDO::FETCH_ASSOC);

                $idnd = $row['idnd'];

                $sqlInsert = "INSERT INTO hoadon (idnd, hoten, diachi, dienthoai, email, ngaydathang, trangthai) VALUES (:idnd, :hoten, :diachi, :dienthoai, :email, :ngay, '1')";
        } else {
                $sqlInsert = "INSERT INTO hoadon (hoten, diachi, dienthoai, email, ngaydathang, trangthai) VALUES (:hoten, :diachi, :dienthoai, :email, :ngay, '1')";
        }

        $queryInsert = $dbh->prepare($sqlInsert);
        $queryInsert->bindParam(':idnd', $idnd);
        $queryInsert->bindParam(':hoten', $hoten);
        $queryInsert->bindParam(':diachi', $diachi);
        $queryInsert->bindParam(':dienthoai', $dienthoai);
        $queryInsert->bindParam(':email', $email);
        $queryInsert->bindParam(':ngay', $ngay);
        $queryInsert->execute();



        $mahd = $dbh->lastInsertId();

        foreach ($_SESSION['cart'] as $stt => $soluong) {
                $sql = "select * from sanpham where idsp=:stt";
                $rows = $dbh->prepare($sql);
                $rows->bindParam(":stt", $stt, PDO::PARAM_INT);
                $rows->execute();
                $row = $rows->fetch(PDO::FETCH_ASSOC);
                //$mahd=$row['mahd'];
                $tensp = $row['tensp'];

                $gia = $row['gia'] * ((100 - $row['khuyenmai1']) / 100);
                $sql1 = "INSERT INTO chitiethoadon(mahd, Tensp, Soluong, gia, phuongthucthanhtoan) VALUES (:mahd, :tensp, :soluong, :gia, :phuongthuc)";
                $query1 = $dbh->prepare($sql1);
                $query1->bindParam(':mahd', $mahd);
                $query1->bindParam(':tensp', $tensp);
                $query1->bindParam(':soluong', $soluong);
                $query1->bindParam(':gia', $gia);
                $query1->bindParam(':phuongthuc', $phuongthuc);
                $query1->execute();


        }
        foreach ($_SESSION['cart'] as $stt => $soluong) {

                $sql = "SELECT * FROM sanpham WHERE idsp = :stt";
                $query = $dbh->prepare($sql);
                $query->bindParam(':stt', $stt);
                $query->execute();
                $row = $query->fetch(PDO::FETCH_ASSOC);

                $ban = $row['daban'] + $soluong;

                $sqlUpdate = "UPDATE sanpham SET daban = :ban WHERE idsp = :stt";
                $queryUpdate = $dbh->prepare($sqlUpdate);
                $queryUpdate->bindParam(':ban', $ban);
                $queryUpdate->bindParam(':stt', $stt);
                $queryUpdate->execute();

        }

        unset($_SESSION['cart']);
}
?>
<!--<font color="red" size="5"><center>Đơn hàng của bạn đã thiết lập thành công chúng tôi sẽ chuyển hàng cho bạn trong thời gian sớm nhất</center></font>
<center><a href="index.php">Trở về trang chủ</a></center> 
-->
<?php
echo "<script language='javascript'>
                alert('Đơn hàng của bạn đã thiết lập thành công chúng tôi sẽ chuyển hàng cho bạn trong thời gian sớm nhất');
                window.open('index.php','_self',3);
        </script>";
?>
<?php
    include_once("connect_db.php");
    if (isset($_GET["cmtdel"])){
        $cmt = $_GET["cmtdel"];
        $ma_nc = $_GET["id_nc"];
        $sql = "DELETE FROM tnv_nghien_cuu WHERE id='$ma_nc' AND so_cmt='$cmt'";
        $query = mysql_query($sql);
        header("location: index.php?page=ds_ct&id_nc=$ma_nc");
    }
    else
    if(isset($_POST["submit"])){
        $ma_nc = $_GET["id_nc"];
        $ho_ten = $_POST["ho_ten"];
        $year = $_POST["year"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        $cmt = $_POST["cmt"];
        $date = $_POST["ngay_cap_cmt"];
        $date=date('Y-m-d',strtotime($date));
        $noi_cap_cmt = $_POST["noi_cap_cmt"];

        $sql = "INSERT INTO tinh_nguyen_vien(so_cmt, ho_ten, year, address, phone, ngay_cap_cmt, noi_cap_cmt) VALUES ('$cmt', '$ho_ten', '$year', '$address', '$phone', '$date', '$noi_cap_cmt') ";
        $query = mysql_query($sql);
        $sql = "INSERT INTO tnv_nghien_cuu(so_cmt, id) VALUES ('$cmt', '$ma_nc') ";
        $query = mysql_query($sql);
        header("location:index.php?page=ds_ct&id_nc=$ma_nc");
    }
    else{
$ma_nc = $_GET["id_nc"];

$sql = "SELECT tinh_nguyen_vien.ho_ten, tinh_nguyen_vien.year, tinh_nguyen_vien.address, tinh_nguyen_vien.phone, tinh_nguyen_vien.so_cmt, 
            tinh_nguyen_vien.ngay_cap_cmt, tinh_nguyen_vien.noi_cap_cmt FROM tinh_nguyen_vien INNER JOIN tnv_nghien_cuu ON tinh_nguyen_vien.so_cmt=tnv_nghien_cuu.so_cmt AND tnv_nghien_cuu.id='$ma_nc' ORDER BY tinh_nguyen_vien.so_cmt";
$query = mysql_query($sql);


?>
<head>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th, td {
            padding: 5px;
            text-align: center;
        }
    </style>
</head>
<?php
$sql2 = "SELECT * FROM nghien_cuu WHERE id='$ma_nc'";
$query2 = mysql_query($sql2);
$row2 = mysql_fetch_array($query2);
echo "<a id='add' href='index.php?page=ds_ct&id_nc=" . $ma_nc . "&add=1'><i class='glyphicon glyphicon-plus'></i>Thêm mới tình nguyện viên vào danh sách</a>";
echo "<p style='font-weight: bold'>Mã nghiên cứu: " . $ma_nc . "</p><p style='font-weight: bold'>Tên nghiên cứu: " . $row2["ten_nc"] . "</p>";
?>
<div id="wrapbox">
    <div id='abox'></div>
    <!--    <h2>Bảng theo dõi TNV uống thuốc</h2>-->
    <table id="table1" style="width:100%" class="table-striped table-hover">
        <tr>
            <th class="stt" rowspan="2">STT</th>
            <th class="ma_tnv" rowspan="2">Mã số</th>
            <th class="ho_ten" colspan="2">Giờ uống thuốc</th>
            <th rowspan="2">Họ và tên</th>
            <th rowspan="2">Ghi chú</th>
        </tr>
        <tr>
            <td>Dự kiến</td>
            <td>Thực tế</td>
        </tr>
        <tr>
            <td>01</td>
            <td>H01</td>
            <td>7h30p</td>
            <td></td>
            <td>Vũ Thị Trang</td>
            <td></td>
        </tr>

        <?php
        $i = 1;
        while ($rows = mysql_fetch_array($query)) {
            if ($i < 10)
                $ma = "H0" . $i;
            else $ma = "H" . $i;

            echo "
            <tr>
                <td>" . $i . "</td>
                <td>" . $ma . "</td>
                <td></td>
                <td></td>
                <td>" . $rows["ho_ten"] . "</td>
                <td></td>
            </tr>";
            $i++;
        }
        }
        ?>
    </table>
</div>
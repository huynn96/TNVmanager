<?php
    include_once("connect_db.php");
    $ma_nc = $_GET["id_nc"];

    $sql = "SELECT tinh_nguyen_vien.ho_ten FROM tinh_nguyen_vien INNER JOIN tnv_nghien_cuu ON tinh_nguyen_vien.so_cmt=tnv_nghien_cuu.so_cmt AND tnv_nghien_cuu.id='$ma_nc' AND tnv_nghien_cuu.ct='1' ORDER BY tinh_nguyen_vien.ho_ten DESC";
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
        h3{
            text-align: center;
            font-weight: bold;
        }
        #p1 {
                display: inline-block;
                margin-left: 14%;
                font-weight: bold;
            }
        p {
                margin-left: 14%;
            }
    </style>
</head>
<p id="p1">BE Center-NIDQC</p>
<h3>BẢNG THEO DÕI NTN UỐNG THUỐC</h3>
<?php
$sql2 = "SELECT * FROM nghien_cuu WHERE id='$ma_nc'";
$query2 = mysql_query($sql2);
$row2 = mysql_fetch_array($query2);
echo "<p style='font-weight: bold'>Tên nghiên cứu: " . $row2["ten_nc"] . "</p><p style='font-weight: bold'>Mã nghiên cứu: " . $ma_nc . "</p>";
?>
<div id="wrapbox">
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
                <td>7<sup>".($i+29)."</sup></td>
                <td></td>
                <td>" . $rows["ho_ten"] . "</td>
                <td></td>
            </tr>";
            $i++;
        }
        ?>
    </table>
    <br>
    <p><span><b><u>Ghi chú: </u></b></span><i>Đánh dấu √ vào ô “Thực tế” nếu thời gian uống thuốc đúng theo dự kiến.
Ghi thời gian uống thuốc thực nếu thời gian uống thuốc khác so với dự kiến.</i></p>
    
    <p style="display: inline;"><b>Người thực hiện</b></p>
    <p style="float: right;margin-right: 14%"><b>Người giám sát</b></p>

</div>
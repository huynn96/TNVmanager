<?php
    include_once("connect_db.php");
    $ma_nc = $_GET["id_nc"];

    $sql = "SELECT tinh_nguyen_vien.ho_ten, tnv_nghien_cuu.ma_tnv FROM tinh_nguyen_vien INNER JOIN tnv_nghien_cuu ON tinh_nguyen_vien.so_cmt=tnv_nghien_cuu.so_cmt AND tnv_nghien_cuu.id='$ma_nc' AND tnv_nghien_cuu.ct='1' ORDER BY tnv_nghien_cuu.ma_tnv";
    $query = mysql_query($sql);
?>
<head>
    <style>
        #uong_thuoc{
            display: none;
            line-height: 16px;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            line-height: 16px;
        }

        th, td {
            padding: 5px;
            text-align: center;
            line-height: 16px;
        }
        h3{
            text-align: center;
            font-weight: bold;
            margin: 0 auto;
        }
        #p1 {
                display: inline-block;
                margin-left: 10px;
                font-weight: bold;
                
            }
        p {
                margin-left: 14%;
            }

        .note{
            width: 30%;
        }
        .bang{
            position: relative;
            height: 185mm;
        }
        .page{
            position: absolute;
            bottom: 0;
            left: 50%;
        }
        
        .footer{
            position: absolute;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<div id="bang">
<p id="p1">BE Center-NIDQC</p>
<h3>BẢNG THEO DÕI NTN UỐNG THUỐC</h3>
<?php
$sql2 = "SELECT * FROM nghien_cuu WHERE id='$ma_nc'";
$query2 = mysql_query($sql2);
$row2 = mysql_fetch_array($query2);
echo "<p><b>Tên nghiên cứu:</b> " . $row2["ten_nc"] . "</p><p><b>Mã nghiên cứu:</b> " . $ma_nc . "</p>";
?>
<p class="gd"></p>
    <table id="table1" style="width:100%" class="table-striped table-hover">
        <tr>
            <th class="stt" rowspan="2">STT</th>
            <th class="ma_tnv" rowspan="2">Mã số</th>
            <th colspan="2">Giờ uống thuốc</th>
            <th class="note" rowspan="2">Họ và tên</th>
            <th class="note" rowspan="2">Ghi chú</th>
        </tr>
        <tr>
            <td>Dự kiến</td>
            <td>Thực tế</td>
        </tr>

        <?php
        $i = 1;
        while ($rows = mysql_fetch_array($query)) {
            list($h,$m) = convert(7, $i+29);
            if ($m < 10)
                $m = "0".$m;
            echo "
            <tr>
                <td>" . $i . "</td>
                <td style='font-weight:bold'>" . $rows["ma_tnv"] . "</td>
                <td style='font-weight:bold'>".$h."<sup>".$m."</sup></td>
                <td></td>
                <td>" . $rows["ho_ten"] . "</td>
                <td></td>
            </tr>";
            $i++;
        }
        ?>
    </table>
    <p><span><b><u>Ghi chú: </u></b></span><i>Đánh dấu √ vào ô “Thực tế” nếu thời gian uống thuốc đúng theo dự kiến.
Ghi thời gian uống thuốc thực nếu thời gian uống thuốc khác so với dự kiến.</i></p>
    
    <p style="display: inline;"><b>Người thực hiện</b></p>
    <p style="float: right;margin-right: 14%"><b>Người giám sát</b></p>
    <div class='footer'> 
    <div><p style="font-weight:normal;margin-left:10px;"><i>BE/FM/CLI.10.02</i></p></div>
    <div class='page'><p style='font-size: 10px;font-weight: normal;text-align:center;margin-left: 0; '>1/1</p></div>
    </div>
</div>
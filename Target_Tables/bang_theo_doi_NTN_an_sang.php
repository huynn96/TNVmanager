<?php
$sql = "SELECT tinh_nguyen_vien.ho_ten, tnv_nghien_cuu.ma_tnv FROM tinh_nguyen_vien INNER JOIN tnv_nghien_cuu ON tinh_nguyen_vien.so_cmt=tnv_nghien_cuu.so_cmt AND tnv_nghien_cuu.id='$ma_nc' AND tnv_nghien_cuu.ct='1' ORDER BY tnv_nghien_cuu.ma_tnv";
$query = mysql_query($sql);
$sql2 = "SELECT * FROM nghien_cuu WHERE id='$ma_nc'";
$query2 = mysql_query($sql2);
$ten_nc = mysql_fetch_array($query2);
?>

<head>
    <style>
        table {
            font-size: 13px;
            border-collapse: collapse;
            width: 100%;
            line-height: 17px;
            border: 1px solid black;
        }

        .noi_o {
            width: 20%;
        }

        .phone,
        .so_cmt,
        .date,
        .noi_cap {
            width: 10%;
        }

        .ma_tnv,
        .stt {
            width: 3px;
        }

        .year {
            width: 4px;
        }

        td,
        th {
            border: 1px solid black;
            text-align: center;
            padding: 3px;
            line-height: 17px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
            line-height: 17px;
        }

        #theo_doi_an_sang {
            display: none;
        }

        .p1 {
            display: inline-block;
            margin-left: 10px;
            font-weight: bold;
        }

        .p2 {
            display: inline;
            float: right;
            font-weight: bold;

        }
        h3 {
            text-align: center;
            margin: 0 auto;
        }

        p {
            margin-left: 10%;
        }

        span {
            font-weight: normal;
        }
        .bang{
            position: relative;
            height: 275mm;
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
<div class="bang">
<div class='p1'>BE Center-NIDQC</div>
<div class='p2'><i>Bảng theo dõi NTN ăn sáng</i></div>
<h3>BẢNG THEO DÕI NTN ĂN SÁNG</h3>
<p style='margin-bottom:0;'><b>Tên nghiên cứu:</b>
    <?php echo $ten_nc["ten_nc"]; ?>
</p>
<p style='margin-bottom:0;'><b>Nghiên cứu số:</b>
    <?php echo $ma_nc; ?>
</p>
<p class="gd" style="font-weight: normal;"></p>
<table style="width:100%">
    <tr>
        <th class="stt" rowspan="2">STT</th>
        <th class="ma_tnv" rowspan="2">Mã TNV</th>

        <th class="ho_ten" rowspan="2">Họ và tên</th>
        <th colspan="2">Giờ ăn sáng</th>
        <th rowspan="2">Lượng thức ăn còn lại</th>
        <th rowspan="2">Ghi chú</th>
    </tr>
    <tr>
        <td>Dự kiến</td>
        <td>Thực tế</td>
    </tr>
    <?php
    $thoi_gian = $ten_nc["thoi_gian"];
    $thoi_gian_number = strtok($thoi_gian, ", ");
    $thoi_diem_bat_dau = strtok(", ");
    $khoang_cach = strtok(", ");
    $hou = strtok($thoi_diem_bat_dau,"p h");
    $min = strtok("p h");
    $i=0;
    while ( $rows = mysql_fetch_array($query)){
        list($h,$m) = convert($hou, $i*$khoang_cach+$min-30);
        if ($m < 10)
            $m = "0".$m;
        echo "
            <tr>
                <td>".($i+1)."</td>
                <td><b>".$rows["ma_tnv"]."</b></td>
                <td style='text-align: left;padding-left: 10px;'>".$rows["ho_ten"]."</td>
                <td style='font-weight:bold'>".$h."<sup>".$m."</sup></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>";
        $i++;
    }

    ?>

</table>
<p style="margin: 30px 0 0 0"><u><i>Ghi chú:</i></u><br>
    <span style="margin-left: 30px">- Đánh dấu √ vào ô "Thực tế" nếu NTN ăn đúng giờ dự kiến. Ghi thời gian ăn thực tế nếu thời điểm NTN ăn khác dự kiến.</span><br>
    <span style="margin-left: 30px">- Ghi rõ phần thức ăn còn thừa. Nếu NTN ăn hết bữa sáng thì ghi "ăn hết"</span><br>
    <span style="margin-left: 30px">- Thực đơn bữa sáng: ….</span>
</p>
<p style="text-align:right;margin-right: 14%;font-weight: normal;margin-top: 0">Ngày&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tháng &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;năm&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>

<p class="p2" style="font-style: normal;margin-right:19%">Cán bộ theo dõi
    <br><span>(Ký, ghi rõ họ tên)</span></p>
<div class='footer'> 
<div><p style='font-weight:normal;margin-left:10px;'><i>BE/FM/CLI.19.02</i></p></div>
<div class='page'><p style='font-size: 10px;font-weight: normal;text-align:center;margin-left: 0; '>1/1</p></div>
</div>
</div>
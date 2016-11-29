<?php
$sql = "SELECT tinh_nguyen_vien.ho_ten, tinh_nguyen_vien.year, tinh_nguyen_vien.address, tinh_nguyen_vien.phone, tinh_nguyen_vien.so_cmt, tinh_nguyen_vien.ngay_cap_cmt, tinh_nguyen_vien.noi_cap_cmt, tnv_nghien_cuu.ma_tnv FROM tinh_nguyen_vien INNER JOIN tnv_nghien_cuu ON tinh_nguyen_vien.so_cmt=tnv_nghien_cuu.so_cmt AND tnv_nghien_cuu.id='$ma_nc' ORDER BY tnv_nghien_cuu.ma_tnv";
$query = mysql_query($sql);
$sql2 = "SELECT ten_nc FROM nghien_cuu WHERE id='$ma_nc'";
$query2 = mysql_query($sql2);
$ten_nc = mysql_fetch_array($query2);
?>

<head>
    <style>
        table {
            font-size: 13px;
            border-collapse: collapse;
            width: 100%;
            line-height: 20px;
            border: 1px solid black;
        }

        .noi_o {
            width: 25%;
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
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }

        #dsctdb {
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

        .p3 {
            display: inline-block;
            float: left;
            margin-left: 100px;
            font-weight: bold;
        }

        h3 {
            text-align: center;
           
        }

        p {
            margin-left: 10%;
        }

        span {
            font-weight: normal;
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
        .ma_nc{
            position: absolute;
            bottom: 0;
            right: 0;
            width: 250px;
        }
    </style>
</head>
<?php
$num = mysql_num_rows($query);
$k=2;$i=1;$k=round($num/12);

if (($num %12 < 6) && ($num %12 >0))
    $k++;

for ($j=0; $j < $k; $j++) { 
echo"
<div class='bang'>
<div class='p1'>BE Center-NIDQC</div>
<div class='p2'><i>DANH SÁCH NGƯỜI TÌNH NGUYỆN CHÍNH THỨC VÀ DỰ BỊ</i></div>
<h3 style='margin-bottom:0;'>DANH SÁCH NGƯỜI TÌNH NGUYỆN CHÍNH THỨC VÀ DỰ BỊ</h3>
<p style='margin-bottom:0;'><b>Tên nghiên cứu:</b>
    ".$ten_nc["ten_nc"]."
</p>
<p style='margin-bottom:0;'><b>Nghiên cứu số:</b>
     ".$ma_nc."
</p>
<table style='width:100%'>
    <tr>

        <th class='stt'>STT</th>
        <th class='ma_tnv'>Mã TNV</th>

        <th class='ho_ten'>Họ và tên</th>

        <th class='year'>Năm sinh</th>
        <th class='noi_o'>Nơi ở hiện tại</th>
        <th class='phone'>Điện thoại</th>
        <th class='cmt'>Số CMT</th>
        <th class='date'>Ngày cấp CMT</th>
        <th class='noi_cap'>Nơi cấp CMT</th>
    </tr>";

    while ( ($i<=12*($j+1)) && ($rows = mysql_fetch_array($query))){
        echo "
            <tr>
                <td>".$i."</td>
                <td><b>".$rows["ma_tnv"]."</b></td>
                <td style='text-align: left;padding-left: 10px;'>".$rows["ho_ten"]."</td>
                <td>".$rows["year"]."</td>
                <td>".$rows["address"]."</td>
                <td>".$rows["phone"]."</td>
                <td>".$rows["so_cmt"]."</td>
                <td>".$rows["ngay_cap_cmt"]."</td>
                <td>".$rows["noi_cap_cmt"]."</td>
            </tr>";
        $i++;
    }

echo"
</table>
<p style='text-align:right;margin-right: 12%;font-weight: normal;margin-top: 3%'>Ngày&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tháng &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;năm&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
<p class='p3'>Phụ trách lâm sàng
    <br><span>(Ký, ghi rõ họ tên)</span></p>
<p class='p2' style='font-style: normal;margin-right:19%'>Người lập bảng
    <br><span>(Ký, ghi rõ họ tên)</span></p>
    <br>
<div class='footer'> 
<div><p style='font-weight:normal;margin-left:10px;'><i>BE/FM/CLI.07.06b</i></p></div>
<div class='page'><p style='font-size: 10px;font-weight: normal;text-align:center;margin-left: 0; '>".($j+1)."/".$k."</p></div>
<div class='ma_nc'><p style='font-weight:normal;'><i>Nghiên cứu số:".$ma_nc."</i></p></div>
</div>
</div>
    ";
}
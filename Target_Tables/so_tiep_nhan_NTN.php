<?php
$sql = "SELECT tinh_nguyen_vien.ho_ten, tinh_nguyen_vien.address, tinh_nguyen_vien.phone, tnv_nghien_cuu.ma_tnv FROM tinh_nguyen_vien INNER JOIN tnv_nghien_cuu ON tinh_nguyen_vien.so_cmt=tnv_nghien_cuu.so_cmt AND tnv_nghien_cuu.id='$ma_nc' AND tnv_nghien_cuu.ct='1' ORDER BY tnv_nghien_cuu.ma_tnv";
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
            line-height: 15px;
            border: 1px solid black;
        }

        .noi_o {
            width: 25%;
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
            line-height: 15px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
            line-height: 15px;
        }

        #so_tiep_nhan {
            display: none;
        }

        #p1 {
            display: inline-block;
            margin-left: 10px;
            margin-bottom: 0;
        }

        #p2 {
            display: inline;
            float: right;
            font-weight: bold;
            font-style: italic;
        }

        p {
            margin-left: 14%;
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
        .can_bo{
            margin-left: 0;
            margin-bottom: 0;
            text-align: left;
        }
        .sign{
            font-weight: bold;
            width: 80px;
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
<p id='p1'>BE Center-NIDQC</p>
<p><b>Tên nghiên cứu:</b>".$ten_nc['ten_nc']."
</p>
<p><b>Nghiên cứu số:</b>".$ma_nc."
</p>
<p><b>Danh sách NTN chính thức và dự bị</b></p>
<table style='width:100%'>
    <tr>
        <th class='stt' rowspan='2'>STT</th>
        <th class='ma_tnv' rowspan='2'>Mã TNV</th>
        <th class='ho_ten' rowspan='2'>Họ và tên</th>
        <th class='noi_o' rowspan='2'>Địa chỉ</th>
        <th class='phone' rowspan='2'>Điện thoại</th>
        <th colspan='2'>Giai đoạn 1<p class='can_bo'>Cán bộ trực:</p><p class='can_bo'>Thời gian:</p></th>
        <th colspan='2'>Giai đoạn 2<p class='can_bo'>Cán bộ trực:</p><p class='can_bo'>Thời gian:</p></th>
        <th rowspan='2'>Ghi chú</th>
    </tr>
    <tr>
        <td style=' font-weight: bold;'>Giờ đến</td>
        <td class='sign'>Chữ ký NTN</td>
        <td style=' font-weight: bold;'>Giờ đến</td>
        <td class='sign'>Chữ ký NTN</td>
    </tr>";

    while ( ($i<=12*($j+1)) && ($rows = mysql_fetch_array($query))){
        echo "
            <tr>
                <td>".$i."</td>
                <td>".$rows["ma_tnv"]."</td>
                <td>".$rows["ho_ten"]."</a></td>
                
                <td>".$rows["address"]."</td>
                <td>".$rows["phone"]."</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>";
        $i++;
    }

echo "
</table>
<p style='text-align:right;margin-right: 9%;font-weight: normal;margin-top: 0'>Ngày&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; tháng &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;năm&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
<p style='text-align:right;margin-right: 14%;font-weight: bold'>Phụ trách lâm sàng
    <br><span>(Ký, ghi rõ họ tên)</span></p>
<div style='position:absolute; bottom:30px;'>
<p style='margin: 30px 0 0 50px'><u><i>Ghi chú:</i></u><br>
    <span>- Cột “Ghi chú” trong bảng danh sách NTN ghi các thông tin:</span><br>
    <span style='margin-left: 30px'>+   “Dự bị” nếu NTN ở vị trí dự bị</span><br>
    <span style='margin-left: 30px'>+   Các thông tin cần lưu ý khác tạo điều kiện liên lạc với NTN được thuận tiện.</span><br>
    <span>- Bảng ghi danh sách NTN chính thức và dự bị có thể viết tay, hoặc đánh máy. Trong trường hợp bảng được đánh máy, dán vào sổ cần có chữ ký giáp lai của phụ trách lâm sàng.</span><br>
</p>
</div>
<div class='footer'> 
<div><p style='font-weight:normal;margin-left:10px;'><i>BE/FM/CLI.16.01</i></p></div>
<div class='page'><p style='font-size: 10px;font-weight: normal;text-align:center;margin-left: 0; '>".($j+1)."/".$k."</p></div>
</div>
</div>
";
}?>
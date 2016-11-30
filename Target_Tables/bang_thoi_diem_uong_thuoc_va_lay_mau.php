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
            line-height: 20px;
            border: 1px solid black;
            line-height: 13px;
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
            line-height: 13px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
            line-height: 13px;
        }

        #uong_thuoc_lay_mau {
            display: none;
            line-height: 15px;
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
        .time{
            width: 5%;
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
<div class="bang">
<div class='p1'>BE Center-NIDQC</div>
<div class='p2'><i>Bảng thời điểm uống thuốc và lấy mẫu</i></div>
<h3>BẢNG THỜI ĐIỂM UỐNG THUỐC VÀ LẤY MẪU</h3>
<p style="margin-bottom: 0;"><b>Tên nghiên cứu:</b>
    <?php echo $ten_nc["ten_nc"]; ?>
</p>
<p style="margin-bottom: 0;"><b>Nghiên cứu số:</b>
    <?php echo $ma_nc; ?>
</p>
<p class="gd" style="font-weight: normal;"></p>
<table style="width:100%">
    <tr class="hang_dau_bang_1">

        <th class="stt">STT</th>
        <th class="ma_tnv">Mã TNV</th>

        <th class="ho_ten">Họ và tên</th>

        <th><div>0h</div></th>
    </tr>

    <?php

    $i=1;
    while ( $rows = mysql_fetch_array($query)){
        echo "
            <tr class='hang_bang_1'>
                <td>".$i."</td>
                <td><b>".$rows["ma_tnv"]."</b></td>
                <td style='text-align: left;padding-left: 10px;'>".$rows["ho_ten"]."</td>
                <td></td>
            </tr>";
        $i++;
    }

    ?>

</table>
<div class='footer'> 
<div><p style='font-weight:normal;margin-left:10px;'><i>BE/FM/CLI.11.03</i></p></div>
<div class='page'><p style='font-size: 10px;font-weight: normal;text-align:center;margin-left: 0; '>1/1</p></div>
<div class='ma_nc'><p style='font-weight:normal;'><i>Nghiên cứu số: <?php echo $ma_nc; ?></i></p></div>
</div></div></div>
<script type="text/javascript">
    function convert(h,m)
    {
        while (m >= 60) {
            h++;
            m = m - 60;
        }
        while (h>=24){
            h-=24;
        }
        return [h,m];
    }

    function timetominute(t) {
        l = t.charAt(t.length-1);
        n = parseFloat(t.substring(0,t.length-1));
        if (l=='h')
            n=n*60;
        return n;
    }
    
    thoi_gian_bang_1 = <?php echo "'".$ten_nc["thoi_gian"]."'"; ?>+",";
    thoi_diem_bang_1 = thoi_gian_bang_1.replace(' ',',').split(",");
    number = parseInt(thoi_diem_bang_1[0]);
    
    i=0;
    for (var i = 0; i < number; i++) {
        $('.hang_dau_bang_1').append("<th class='moc_bang_1_"+i+"'>"+thoi_diem_bang_1[i+2]+"</th>");
    }
    i=0;
    $('.hang_bang_1').each(function () {
        h = parseInt(thoi_diem_bang_1[1].replace('p','h').split("h")[0]);
        minutes = parseInt(thoi_diem_bang_1[1].replace('p','h').split("h")[1]);
        a = convert(h,minutes+i);
        if (a[1]<10){
            a[1] = "0"+a[1];
        }
        $(this).find("td:eq(" + 3 + ")").html("<b>"+a[0]+"<sup>"+a[1]+"</b>");
        for (var j = 0; j < number; j++) {
            minutes = timetominute(thoi_diem_bang_1[j+2]);
            b = convert(a[0],minutes+parseInt(a[1]));
            if (b[1]<10){
                b[1] = "0"+b[1];
            }
            $(this).append("<td><b>"+b[0]+"<sup>"+b[1]+"</b></td>");
        }
        i++;
    });

</script> 
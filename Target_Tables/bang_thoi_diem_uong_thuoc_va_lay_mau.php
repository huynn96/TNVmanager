<?php
$sql = "SELECT tinh_nguyen_vien.ho_ten, tnv_nghien_cuu.ma_tnv FROM tinh_nguyen_vien INNER JOIN tnv_nghien_cuu ON tinh_nguyen_vien.so_cmt=tnv_nghien_cuu.so_cmt AND tnv_nghien_cuu.id='$ma_nc' AND tnv_nghien_cuu.ct='1' ORDER BY tnv_nghien_cuu.ma_tnv";
$query = mysql_query($sql);
$sql2 = "SELECT ten_nc FROM nghien_cuu WHERE id='$ma_nc'";
$query2 = mysql_query($sql2);
$ten_nc = mysql_fetch_array($query2);
?>

<head>
    <style>
        #uong_thuoc_lay_mau table {
            font-size: 13px;
            border-collapse: collapse;
            width: 100%;
            line-height: 20px;
            border: 1px solid black;
            line-height: 15px;
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

        #uong_thuoc_lay_mau td,
        th {
            border: 1px solid black;
            text-align: center;
            padding: 3px;
            line-height: 13px;
        }

        #uong_thuoc_lay_mau tr:nth-child(even) {
            background-color: #dddddd;
            line-height: 13px;
        }

        #uong_thuoc_lay_mau {
            display: none;
            line-height: 15px;
        }

        #p1 {
            display: inline-block;
            margin-left: 10px;
            font-weight: bold;
            line-height: 15px;
        }

        #p2 {
            display: inline;
            float: right;
            font-weight: bold;
            font-style: italic;
            line-height: 15px;
        }

        #uong_thuoc_lay_mau h3 {
            text-align: center;
            margin: 0 auto;
        }

        #uong_thuoc_lay_mau p {
            margin-left: 14%;
            line-height: 15px;
        }

        #uong_thuoc_lay_mau span {
            font-weight: normal;
            line-height: 15px;
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
<p id="p1">BE Center-NIDQC</p>
<p id="p2">Bảng thời điểm uống thuốc và lấy mẫu</p>
<h3>BẢNG THỜI ĐIỂM UỐNG THUỐC VÀ LẤY MẪU</h3>
<p><b>Tên nghiên cứu:</b>
    <?php echo $ten_nc["ten_nc"]; ?>
</p>
<p><b>Nghiên cứu số:</b>
    <?php echo $ma_nc; ?>
</p>
<p class="gd" style="font-weight: normal;"></p>
<table style="width:100%">
    <tr>

        <th class="stt">STT</th>
        <th class="ma_tnv">Mã TNV</th>

        <th class="ho_ten">Họ và tên</th>


        <th><div>0h</div></th>
        <th class="time"><div></div></th>
        <th class="time"><div></div></th>
        <th class="time"><div></div></th>
        <th class="time"><div></div></th>
        <th class="time"><div></div></th>
        <th class="time"><div></div></th>
        <th class="time"><div></div></th>
        <th class="time"><div></div></th>
        <th class="time"><div></div></th>
        <th class="time"><div></div></th>
        <th class="time"><div></div></th>
        <th class="time"><div></div></th>
        <th class="time"><div></div></th>
        <th class="time"><div></div></th>
        <th class="time"><div></div></th>
    </tr>

    <?php

    $i=1;
    while ( $rows = mysql_fetch_array($query)){
        echo "
            <tr class='hang'>
                <td>".$i."</td>
                <td><b>".$rows["ma_tnv"]."</b></td>
                <td>".$rows["ho_ten"]."</a></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
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
    i=0;
    $('.hang').each(function () {
        $(this).find("td:eq(" + 3 + ")").html("<b>"+7+"<sup>"+(30+i)+"</b>");
        i++;
    });

    $('th.time').on('click',function (e) {
        index = $(e.target).index();
        console.log(index);
        $(e.target).children().replaceWith("<input type='text' name='time' size=2>");
        $("[name='time']").focus();
        $("[name='time']").focusout(function (e1) {
            h=7;m=30;i=30;
            minutes = timetominute($("[name='time']").val());
            $(e1.target).replaceWith("<div style='display: inline-block'>"+$("[name='time']").val()+"</div>");
            
            $('.hang').each(function () {
                a = convert(h,minutes+i);
                if (a[1]<10){
                    a[1] = "0"+a[1];
                }
                $(this).find("td:eq(" + index + ")").html("<b>"+a[0]+"<sup>"+a[1]+"</b>");
                i++;
            })
    
        });
    })

</script> 
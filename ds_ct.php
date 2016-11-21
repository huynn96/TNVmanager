<?php
    include_once("connect_db.php");
    if (isset($_POST["check"])){
        $cmt = $_POST["cmt"];
        $ma_nc = $_POST["id"];
        $check = $_POST["check"];
        $sql = "UPDATE tnv_nghien_cuu SET ct='$check' WHERE so_cmt='$cmt' AND id='$ma_nc'";
        $query = mysql_query($sql);
    }
    if (isset($_POST["ma"])){
        $cmt = $_POST["cmt"];
        $ma_nc = $_POST["id_nc"];
        $ma_tnv = $_POST["matnv"];
        $sql = "UPDATE tnv_nghien_cuu SET ma_tnv='$ma_tnv' WHERE so_cmt='$cmt' AND id='$ma_nc'";
        $query = mysql_query($sql);
    }
    else 
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
        $ma_tnv = $_POST["ma_tnv"];
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
        $sql = "INSERT INTO tnv_nghien_cuu(so_cmt, id, ma_tnv) VALUES ('$cmt', '$ma_nc', '$ma_tnv') ";
        $query = mysql_query($sql);
        header("location:index.php?page=ds_ct&id_nc=$ma_nc");
    }
    else{
    $ma_nc = $_GET["id_nc"];

    $sql = "SELECT tinh_nguyen_vien.ho_ten, tinh_nguyen_vien.year, tinh_nguyen_vien.address, tinh_nguyen_vien.phone, tinh_nguyen_vien.so_cmt, tinh_nguyen_vien.ngay_cap_cmt, tinh_nguyen_vien.noi_cap_cmt, tnv_nghien_cuu.ct, tnv_nghien_cuu.ma_tnv FROM tinh_nguyen_vien INNER JOIN tnv_nghien_cuu ON tinh_nguyen_vien.so_cmt=tnv_nghien_cuu.so_cmt AND tnv_nghien_cuu.id='$ma_nc' ORDER BY tinh_nguyen_vien.ho_ten DESC";
    $query = mysql_query($sql);

                
?>
<head>
    <style>
        #wrapabox{
            position: relative;
        }
        #table1 {
            position: relative;
            font-size: 13px;
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            line-height: 20px;
        }

        .noi_o{
            width: 20%;
        }
        .date, .noi_cap{
            width: 10%;
        }
        .so_cmt{
             width: 8%;
        }
        .phone{
            width: 11%;
        }
        .ma_tnv,.stt{
            width: 3px;
        }
        .year{
            width: 4px;
        }
        
        td, th {
            border: 1px solid black;
            text-align: center;
            padding: 3px;
        }

        .table-striped > tbody > tr:nth-child(odd) > td,
        .table-striped > tbody > tr:nth-child(odd) > th {
            background-color: #d9d9d9;
        }

        .table-hover > tbody > tr:hover > td,
        .table-hover > tbody > tr:hover > th {
            background-color: #c9c9c9;
        }
        #add{
            float: right;
            margin: 5px 5px 10px 0;
            color:#369;
            text-decoration: none;
            font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
            font-size: 14px; 
            font-weight: 700;
        }

        #abox{
            position: absolute;
            background: white;
            display: none;
            z-index: 2;
            width: 90%;
            padding: 1px;
            left: 5%;
            top: 136px;
            border: 3px outset #a9a9a9;
            border-radius: 10px 10px;
            -moz-border-radius: 10px 10px;
            -webkit-border-radius: 10px 10px;
        }
  </style>
    <script>
        $(function() {
           $('#date').datepicker({
                dateFormat: 'd-m-yy'
            }); 
        });
    </script>
</head>
    <?php
        $sql2 = "SELECT * FROM nghien_cuu WHERE id='$ma_nc'";
        $query2 = mysql_query($sql2);
        $row2 = mysql_fetch_array($query2);
        echo "<a id='add' href='index.php?page=ds_ct&id_nc=".$ma_nc."&add=1'><i class='glyphicon glyphicon-plus'></i>Thêm mới tình nguyện viên vào danh sách</a>";
        echo "<p style='font-weight: bold'>Mã nghiên cứu: ".$ma_nc."</p><p style='font-weight: bold'>Tên nghiên cứu: ".$row2["ten_nc"]."</p>";
    ?>
<div id="wrapabox">
<div id='abox'></div>
<table id="table1" style="width:100%" class="table-striped table-hover">
    
    <tr>
            <th class="stt">STT</th>
            <th class="ct">CT</th>
            <th class="year">Mã TNV</th>
            <th class="ho_ten">Họ và tên</th>
            <th class="year">Năm sinh</th>
            <th class="noi_o">Nơi ở hiện tại</th>
            <th class="phone">Điện thoại</th>
            <th class="cmt">Số CMT</th>
            <th class="date">Ngày cấp CMT</th>
            <th class="noi_cap">Nơi cấp CMT</th>
            <th class="xoa">Xoá</th>
            
    </tr>
    
<?php
    if (isset($_GET["add"])){
        echo "
            <form method='post'>
            <tr>
                <td></td>
                <td></td>
                <td><input type='text' name='ma_tnv' size=2 required ></td>
                <td><input type='text' name='ho_ten' size=15 required ></td>
                <td><input type='text' name='year' size=2 required></td>
                <td><textarea rows='3' cols='15' name='address' required></textarea></td>
                <td><input type='text' name='phone' size=8 required></td>
                <td><input type='text' name='cmt' size=8 required></td>
                <td><input type='text' name='ngay_cap_cmt' id='date' size=8 required></td>
                <td><input type='text' name='noi_cap_cmt' size=8 required></td>
                <td colspan=2><input type='submit' name='submit' value='Cập nhật' id='submit' required></td>

            </tr>
            </form>
            ";
    }
?>

<?php

    $i=1;
        while ( $rows = mysql_fetch_array($query)){
            if($rows["ngay_cap_cmt"]!=null)
                $rows["ngay_cap_cmt"]=date('d-m-Y',strtotime($rows["ngay_cap_cmt"]));
            echo "
            <tr>
                <td>".$i."</td>
                <td>";
            if ($rows["ct"] ==1)
                echo "<input type='checkbox' value='".$rows["so_cmt"]."' checked>";
            else echo "<input type='checkbox' value='".$rows["so_cmt"]."'>";
             echo"</td>
                <td class='matnv'>".$rows["ma_tnv"]."</td>
                <td><a href='index.php?page=tnv&search=".$rows["so_cmt"]."'>".$rows["ho_ten"]."</a></td>
                <td>".$rows["year"]."</td>
                <td>".$rows["address"]."</td>
                <td>".$rows["phone"]."</td>
                <td>".$rows["so_cmt"]."</td>
                <td>".$rows["ngay_cap_cmt"]."</td>
                <td>".$rows["noi_cap_cmt"]."</td>
                <td class='xoa'>
                    <a href='ds_ct.php?cmtdel=".$rows["so_cmt"]."&id_nc=".$ma_nc."' type='button' class='btn btn-sm btn-danger'><i class='glyphicon glyphicon-remove'></i></a>
                </td>
            </tr>";
            $i++;

        }
   
?>
    
</table>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("[type='text']").focus(function () {
            if (this.getAttribute('name') != 'ho_ten')
                $('#abox').hide();
        });

        $("[name='address']").focus(function () {
            $('#abox').hide();
        });

        $("[name='ho_ten']").keypress(function (e) {
            var ten = $("[name='ho_ten']").val();
            $('#abox').show();
            key = String.fromCharCode(e.keyCode);
            ten = ten + key;
            ten = ten.replace(/ /g,"+");
            $('#abox').load("ds_search.php?ten="+ten);
        });

        $('.xoa a').click(function (e) {
            e.preventDefault();
            var b=e.target.getAttribute("href");
            if (e.target.type != 'button'){
                b=$(e.target).parent();
                    
                b=$(b).attr("href");
            }
            
            if (confirm('Chắc chắn xoá tình nguyện viên?')){
                location.href=b;
            }
        });

        $("[type='checkbox']").click(function (e) {
            check=0
            if ($(e.target).is(":checked"))
                check=1;
            $.post("ds_ct.php",{check: check, id: <?php echo "'".$ma_nc."'"; ?>, cmt: $(e.target).val()});

        });

        $(".matnv").click( function (e) {

            $(this).replaceWith("<input type='text' name='matnv' size=2 required value="+ $(this).html() + ">");
            $("[name='matnv']").focusout(function (e) {
                current = $(this).closest("tr");
                cmt = current.find("td:eq(6)").html();
                $.post(
                    "ds_ct.php",
                    {ma: "1", matnv: $(this).val(), id_nc: <?php echo "'".$ma_nc."'"; ?>, cmt: cmt}
                )
                $(this).replaceWith("<td class='matnv'>"+$(this).val()+"</td>");
            });
        });

        
    });
  

</script>

<?php } ?>
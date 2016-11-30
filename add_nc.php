<head>
    <link rel='stylesheet' type='text/css' href='css/add_nc.css' />
    <script>
        $(function () {
            $('.date').datepicker({
                dateFormat: 'd-m-yy'
            });
        });
    </script>
</head>

<?php
    if (isset($_POST["submitbtn"])){
        include("connect_db.php");
        $ma_nc = $_POST["ma_nc"];
        $sql = "SELECT * FROM nghien_cuu WHERE id='$ma_nc'";
        $query = mysql_query($sql);
        if (mysql_num_rows($query) > 0){
            echo "<script type='text/javascript'>
                if (confirm('MÃ TÌNH NGUYỆN VIÊN ĐÃ TỒN TẠI!!!')){
                        location.href= 'index.php';
                }

            </script>";
        }
        else{

        $ten_nc = $_POST["message"];
        $date = $_POST["date"];
        $date=date('Y-m-d',strtotime($date));
        
        $date2 = $_POST["date2"];
        $date2=date('Y-m-d',strtotime($date2));
        
        $gd2_b = $_POST["gd2_b"];
        $gd2_b=date('Y-m-d',strtotime($gd2_b));
        
        $gd2_e = $_POST["gd2_e"];
        $gd2_e=date('Y-m-d',strtotime($gd2_e));
        
        $gd3_b = $_POST["gd3_b"];
        $gd3_b=date('Y-m-d',strtotime($gd3_b));
        
        $gd3_e = $_POST["gd3_e"];
        $gd3_e=date('Y-m-d',strtotime($gd3_e));

        $thoi_gian = $_POST["thoi_gian_number"].",".$_POST["thoi_diem_bat_dau"].",".$_POST["khoang_cach"];
        for ($i=0; $i < $_POST["thoi_gian_number"]; $i++) { 
            $thoi_gian = $thoi_gian.",".$_POST["thoi_diem".$i];
        }

        $sql = "INSERT INTO nghien_cuu(id, ten_nc, date_year, date_year_end, gd2_begin, gd2_end, gd3_begin, gd3_end) VALUES ('$ma_nc', '$ten_nc', '$date', '$date2', '$gd2_b', '$gd2_e', '$gd3_b', '$gd3_e' )";
        $query = mysql_query($sql);

        if ($_POST["date2"] == NULL){
            $sql = "UPDATE nghien_cuu SET date_year_end=NULL WHERE id='$ma_nc'";
            $query = mysql_query($sql);
        }
        if ($_POST["gd2_b"] == NULL){
            $sql = "UPDATE nghien_cuu SET gd2_begin=NULL WHERE id='$ma_nc'";
            $query = mysql_query($sql);
        }
        if ($_POST["gd2_e"] == NULL){
            $sql = "UPDATE nghien_cuu SET gd2_end=NULL WHERE id='$ma_nc'";
            $query = mysql_query($sql);
        }
        if ($_POST["gd3_b"] == NULL){
            $sql = "UPDATE nghien_cuu SET gd3_begin=NULL WHERE id='$ma_nc'";
            $query = mysql_query($sql);
        }
        if ($_POST["gd3_e"] == NULL){
            $sql = "UPDATE nghien_cuu SET gd3_end=NULL WHERE id='$ma_nc'";
            $query = mysql_query($sql);
        }        
        
        require_once 'xlsx/simplexlsx.class.php';   
        $filename = $_FILES["file"]["tmp_name"];

        function DayToSecond($day) //1900
        {
            return ( $day - 25569 ) * 86400 ; // -70year -> 1970
        }

        if($_FILES["file"]["size"] > 0){
            $data = new SimpleXLSX($filename);
            $field = $data->rows()[0];
            for ($i=1; $i < $data->dimension()[1]; $i++){
                $value = $data->rows()[$i];  
                if ($value[4]==null && $value[3]==null)
                    continue;             
                if ($value[4]==null){
                    $value[4] = $value[3];
                    $value[4] = str_replace(' ','',$value[4]);
                    $value[4] .= "(DT)";
                }

                if ($value[5]!=null){
                    $value[5] = DayToSecond($value[5]);
                    $date2=date('Y-m-d',$value[5]);   
                }
                else $date2=null;
                $sql = "INSERT INTO tinh_nguyen_vien($field[0],$field[1],$field[2],$field[3],$field[4],$field[5],$field[6]) VALUES ('$value[0]','$value[1]','$value[2]','$value[3]','$value[4]','$date2','$value[6]')";
                $query = mysql_query($sql); 
                if ($date2==null){
                    $sql = "UPDATE tinh_nguyen_vien SET ngay_cap_cmt = NULL WHERE so_cmt='$value[4]'";
                    $query = mysql_query($sql);
                }
                                
                $sql = "INSERT INTO tnv_nghien_cuu(id, so_cmt, ct) VALUES ('$ma_nc', '$value[4]', '1')";
                $query = mysql_query($sql);
            }   
        }
        
        header("location: index.php?page=ds_ct&id_nc=$ma_nc");
        }
    }
     
?>



    <form id="contactform" name="contact" method="post" action="add_nc.php" enctype="multipart/form-data">
        <p class="note"><span class="req">*</span> Bắt buộc phải điền</p>
        <div class="row">
            <label for="ma_nc">Mã nghiên cứu <span class="req">*</span></label>
            <input type="text" name="ma_nc" id="name" class="txt" tabindex="1" placeholder="Mã nghiên cứu" required>
        </div>

        <div class="row">
            <label for="message">Tên nghiên cứu </label>
            <textarea name="message" id="message" class="txtarea" tabindex="4"></textarea>
        </div>

        <div class="row">
            <label for="date">Giai đoạn 1:<span class="req">*</span></label>
            <input type="text" name="date" class="txt date" tabindex="3" required>
            <input type="text" name="date2" class="txt date" tabindex="3">
            <div></div>
            <label for="gd1">Giai đoạn 2:</label>
            <input type="text" name="gd2_b" class="txt date gd1" tabindex="3">
            <input type="text" name="gd2_e" class="txt date gd1" tabindex="3">
            <div></div>
            <label for="date">Giai đoạn 3:</label>
            <input type="text" name="gd3_b" class="txt date" tabindex="3">
            <input type="text" name="gd3_e" class="txt date" tabindex="3">
        </div>
        
        <div class='row'>
            <label for='thoi_gian_number'>Số lượng mốc thời gian: </label>
            <input type="text" name="thoi_gian_number" class="txt" tabindex="3" style="width: 30px" value=0>
            <label for='thoi_gian_number' style="margin-left: 100px">Thời điểm bắt đầu: </label>
            <input type="text" name="thoi_diem_bat_dau" class="txt" tabindex="3" style="width: 70px" value="0">
            <label for='thoi_gian_number'>VD: 7h30p </label>
            <label for='khoang_cach'>Khoảng cách (phút): </label>
            <input type="text" name="khoang_cach" class="txt" tabindex="3" style="width: 50px" value=1>
            <div class='thoi_gian_n'></div>
        </div>

        <div class='row'>
            <label for="ExampleInputFile">Upload ds:</label>
            <input type="file" name="file" id="file">
        </div>

        <div class="center">
            <input type="submit" id="submitbtn" name="submitbtn" tabindex="5" value="Submit">
        </div>
    </form>

<script type="text/javascript">
        $("[name='ma_nc']").focusout(function () {
            ma = $(this).val();
            if (ma.search(" ") != -1)
                if (confirm("MÃ NGHIÊN CỨU KHÔNG ĐƯỢC CÓ DẤU CÁCH!!!"))
                    location.href='index.php';
        })  

        $("[name='thoi_gian_number']").focusout(function () {
            number = $("[name='thoi_gian_number']").val();
            $('.thoi_gian_n').replaceWith("<div class='thoi_gian_n'></div>")
            $('.thoi_gian_n').append("<div><b>Nhập vào "+ number +" thời điểm (VD: 1.5h, 1h, 10p): </b></div>");
            for (var i =0; i < number; i++) {
                if (i==0)
                    $('.thoi_gian_n').append("<input type='text' name='thoi_diem"+i+"' class='txt' tabindex='3' style='width: 50px' value='0h'>");
                else
                    $('.thoi_gian_n').append("<input type='text' name='thoi_diem"+i+"' class='txt' tabindex='3' style='width: 50px'>");
            }
        })

</script>
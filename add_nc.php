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
        $ma_nc = $_POST["ma_nc"];
        $ten_nc = $_POST["message"];
        $date = $_POST["date"];
        $date=date('Y-m-d',strtotime($date));
        $date2 = $_POST["date2"];
        $date2=date('Y-m-d',strtotime($date2));
        
        include("connect_db.php");

        $sql = "INSERT INTO nghien_cuu(id, ten_nc, date_year, date_year_end) VALUES ('$ma_nc', '$ten_nc', '$date', '$date2')";
        $query = mysql_query($sql);
        
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
                if ($value[4]==null)
                    $value[4]=$value[3];
                echo $value[4]."<br>";

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
                                
                $sql = "INSERT INTO tnv_nghien_cuu(id, so_cmt) VALUES ('$ma_nc', '$value[4]')";
                $query = mysql_query($sql);
            }   
            echo 1;
        }
        
        header("location: index.php?page=ds_ct&id_nc=$ma_nc");
    }
     
?>



    <form id="contactform" name="contact" method="post" action="add_nc.php" enctype="multipart/form-data">
        <p class="note"><span class="req">*</span> Bắt buộc phải điền</p>
        <div class="row">
            <label for="ma_nc">Mã nghiên cứu <span class="req">*</span></label>
            <input type="text" name="ma_nc" id="name" class="txt" tabindex="1" placeholder="Mã nghiên cứu" required>
        </div>

        <div class="row">
            <label for="message">Tên nghiên cứu <span class="req">*</span></label>
            <textarea name="message" id="message" class="txtarea" tabindex="4" required></textarea>
        </div>

        <div class="row">
            <label for="date">Ngày nghiên cứu <span class="req">*</span></label>
            <input type="text" name="date" class="txt date" tabindex="3" placeholder="" required>
            <input type="text" name="date2" class="txt date" tabindex="3" placeholder="" required>
        </div>

        <label for="ExampleInputFile">Upload ds <span class="req">*</span></label>
        <input type="file" name="file" id="file">

        <div class="center">
            <input type="submit" id="submitbtn" name="submitbtn" tabindex="5" value="Submit">
        </div>
    </form>
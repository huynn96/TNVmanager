<head>
    <link rel='stylesheet' type='text/css' href='css/add_nc.css'/>

    <style type="text/css">
        .form-control {
            display: inline;
            width: 30%;
            margin-right: 10px;
        }
        #sua{
            display: none;
        }
    </style>
</head>

<?php
    include_once("connect_db.php");
    $ma_nc = $_GET["id_nc"];
    if (isset($_POST['submitbt'])){
        $id = $_POST["ma_nc"];
        $ten_nc = $_POST["message"];
        $date = $_POST["date"];
        $date=date('Y-m-d',strtotime($date));

        $sql = "UPDATE nghien_cuu SET id='$id', ten_nc='$ten_nc', date_year='$date' WHERE id='$ma_nc'";
        $query = mysql_query($sql);

        if($id != $ma_nc){
            $sql = "UPDATE tnv_nghien_cuu SET id='$id' WHERE id='$ma_nc'";
            $query = mysql_query($sql);
        }

        header("location: index.php");
    }
    else{
        $sql = "SELECT * FROM nghien_cuu WHERE id = '$ma_nc'";
        $query = mysql_query($sql);
        $row = mysql_fetch_array($query);
        $date = $row["date_year"];
        $date=date('d-m-Y',strtotime($date));  
?>
        <div id="dsct">
        <?php
            include_once("bangchinhthuc.php");
        ?>
        </div>
        <select id="select" class="form-control" style="margin:20px 0 0 20px">
            <option value="dsct">Danh sách chính thức</option>
            <option value="mau_mau">Bảng theo dõi mẫu máu</option>
            <option value="uong_thuoc">Bảng theo dõi uống thuốc</option>
        </select>

        <button class="btn btn-default btn-md" onclick="print_table()"><i class="glyphicon glyphicon-print"></i></button>
        <button name="sua" type="button" class="btn btn-primary" style="display: block;margin:20px 0 0 20px;">Chỉnh sửa thông tin nghiên cứu</button>

        <div id="sua">
            <form id="contactform" name="contact" method="post" <?php echo "action='sua_nghien_cuu.php?id_nc=".$ma_nc."'"; ?> >

                <div class="row">
                    <label for="ma_nc">Mã nghiên cứu <span class="req">*</span></label>
                    <input type="text" name="ma_nc" id="name" class="txt" value="<?php echo $row["id"]; ?>" tabindex="1" placeholder="Mã nghiên cứu" required>
                </div>

                <div class="row">
                    <label for="message">Tên nghiên cứu <span class="req">*</span></label> 
                    <textarea name="message" id="message" class="txtarea" tabindex="4" required><?php echo $row["ten_nc"]; ?></textarea>
                </div>

                <div class="row">
                    <label for="date">Ngày nghiên cứu <span class="req">*</span></label>
                    <input type="text" name="date" id="date" class="txt" value="<?php echo $date; ?>" tabindex="3" placeholder="" required>
                </div>

                <div class="center">
                    <input type="submit" id="submitbtn" name="submitbt" tabindex="5" value="Cập nhật">
                </div>
            </form>
        </div>

<script type="text/javascript"> 
        function print_table() {
            var table = document.getElementById('select').value;

            var printContents = document.getElementById(table).innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            window.location = "index.php";
        }
        $("[name='sua']").click(function() {
            $('#sua').toggle();
        });

</script>
<?php
}
?>
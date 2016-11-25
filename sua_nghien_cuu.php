<?php
    include_once("connect_db.php");
    if (isset($_GET["del"])){
        $ma_nc = $_GET["del"];
        $sql = "DELETE FROM nghien_cuu WHERE id='$ma_nc'";
        $query = mysql_query($sql);
        $sql = "DELETE FROM tnv_nghien_cuu WHERE id='$ma_nc'";
        $query = mysql_query($sql);

        header("location: index.php");
    }
    else {
?>
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
        #uong_thuoc{
            display: none;
        }
        #mau_mau{
            display: none;
        }
    </style>
</head>

<?php
    $ma_nc = $_GET["id_nc"];
    if (isset($_POST['submitbt'])){
        $id = $_POST["ma_nc"];
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

        $sql = "UPDATE nghien_cuu SET id='$id', ten_nc='$ten_nc', date_year='$date', date_year_end='$date2', gd2_begin='$gd2_b', gd2_end='$gd2_e', gd3_begin='$gd3_b', gd3_end='$gd3_e' WHERE id='$ma_nc'";
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
    
        if ($row["date_year_end"] == NULL){
            $date2=null;
        }else{
            $date2 = $row["date_year_end"];
            $date2=date('d-m-Y',strtotime($date2));
        }
        if ($row["gd2_begin"] == NULL){
            $gd2_b=null;
        }else{
            $gd2_b = $row["gd2_begin"];
            $gd2_b=date('d-m-Y',strtotime($gd2_b));
        }
        if ($row["gd2_end"] == NULL){
            $gd2_e=null;
        }else{
            $gd2_e = $row["gd2_end"];
            $gd2_e=date('d-m-Y',strtotime($gd2_e));
        }
        if ($row["gd3_begin"] == NULL){
            $gd3_b=null;
        }else{
            $gd3_b = $row["gd3_begin"];
            $gd3_b=date('d-m-Y',strtotime($gd3_b));
        }
        if ($row["gd3_end"] == NULL){
            $gd3_e=null;
        }else{
            $gd3_e = $row["gd3_end"];
            $gd3_e=date('d-m-Y',strtotime($gd3_e));
        }
        function convert($h,$m)
        {
            while ($m >= 60) {
                $h++;
                $m = $m - 60;
            }
            return array($h,$m);
        }
?>
        <h1>Mã nghiên cứu: <?php echo $ma_nc; ?></h1>
        <select id="select_gd" class="form-control" style="display:inline-block;margin:20px 0 0 20px; width: 150px;">
            <option value="I">Giai đoạn I</option>
            <option value="II">Giai đoạn II</option>
            <option value="III">Giai đoạn III</option>
        </select>
        <div style="display: block;"></div>
        <select id="select" class="form-control" style="margin:20px 0 0 20px">
            <option value="dsctdb">Danh sách chính thức và dự bị</option>
            <option value="dsct">Danh sách chính thức</option>
            <option value="dsdb">Danh sách dự bị</option>
            <option value="mau_mau">Bảng theo dõi mẫu máu</option>
            <option value="uong_thuoc">Bảng theo dõi uống thuốc</option>
            <option value="uong_thuoc_lay_mau">Bảng thời điểm uống thuốc và lấy mẫu</option>
            <option value="so_tiep_nhan">Sổ tiếp nhận NTN</option>
            <option value="theo_doi_an_sang">Bảng theo dõi NTN ăn sáng</option>
            <option value="theo_doi_an_chinh">Bảng theo dõi NTN dùng bữa ăn chính</option>
        </select>

        <button class="btn btn-default btn-md" style="display: inline-block" onclick="print_table()"><i class="glyphicon glyphicon-print"></i></button>

        <button class="btn btn-default btn-md" style="display: inline-block" onclick="word_table()"><i class="glyphicon glyphicon-download-alt"></i></button>
        <div id="dsctdb">
            <?php
            include_once("Target_Tables/bang_ct_va_db.php");
            ?>
        </div>
        <div id="dsct">
        <?php
            include_once("Target_Tables/bangchinhthuc.php");
        ?>
        </div>
        <div id="dsdb">
            <?php
            include_once("Target_Tables/bangdubi.php");
            ?>
        </div>
        <div id="uong_thuoc">
        <?php
            include_once("Target_Tables/bang_uong_thuoc.php");
        ?>
        </div>
        <div id="mau_mau">
        <?php
            include_once("Target_Tables/bang_lay_mau_mau.php");
        ?>
        </div>
        <div id="uong_thuoc_lay_mau">
            <?php
            include_once("Target_Tables/bang_thoi_diem_uong_thuoc_va_lay_mau.php");
            ?>
        </div>
        <div id="so_tiep_nhan">
            <?php
            include_once("Target_Tables/so_tiep_nhan_NTN.php");
            ?>
        </div>
        <div id="theo_doi_an_sang">
            <?php
            include_once("Target_Tables/bang_theo_doi_NTN_an_sang.php");
            ?>
        </div>
        <div id="theo_doi_an_chinh">
            <?php
            include_once("Target_Tables/bang_theo_doi_NTN_an_chinh.php");
            ?>
        </div>
        

        <div style="display: block"></div>
        <button name="sua" type="button" class="btn btn-primary" style="display: inline;margin:20px 0 0 20px;">Chỉnh sửa thông tin nghiên cứu</button>

        <?php echo "<div class='xoa' style='display: inline;margin:20px 0 0 20px;''>
                    <a href='sua_nghien_cuu.php?del=".$ma_nc."' type='button' class='btn btn-sm btn-danger' data-toggle='tooltip' title='Xoá nghiên cứu'><i class='glyphicon glyphicon-remove'></i></a>
                </div>" ?>

        <div id="sua">
            <form id="contactform" name="contact" method="post" <?php echo "action='sua_nghien_cuu.php?id_nc=".$ma_nc."'"; ?> >

                <div class="row">
                    <label for="ma_nc">Mã nghiên cứu <span class="req">*</span></label>
                    <input type="text" name="ma_nc" id="name" class="txt" value="<?php echo $row["id"]; ?>" tabindex="1" required>
                </div>

                <div class="row">
                    <label for="message">Tên nghiên cứu <span class="req">*</span></label> 
                    <textarea name="message" id="message" class="txtarea" tabindex="4" required><?php echo $row["ten_nc"]; ?></textarea>
                </div>

                <div class="row">
                    <label for="date">Giai đoạn 1:<span class="req">*</span></label>
                    <input type="text" name="date" class="txt date" tabindex="3" value="<?php echo $date; ?>" required>
                    <input type="text" name="date2" class="txt date" tabindex="3" value="<?php echo $date2; ?>">
                    <div></div>
                    <label for="gd1">Giai đoạn 2:</label>
                    <input type="text" name="gd2_b" class="txt date gd1" tabindex="3" value="<?php echo $gd2_b; ?>">
                    <input type="text" name="gd2_e" class="txt date gd1" tabindex="3" value="<?php echo $gd2_e; ?>">
                    <div></div>
                    <label for="date">Giai đoạn 3:</label>
                    <input type="text" name="gd3_b" class="txt date" tabindex="3" value="<?php echo $gd3_b; ?>">
                    <input type="text" name="gd3_e" class="txt date" tabindex="3" value="<?php echo $gd3_e; ?>">
                </div>

                <div class="center">
                    <input type="submit" id="submitbtn" name="submitbt" tabindex="5" value="Cập nhật">
                </div>
            </form>
        </div>

<script src="library/word/FileSaver.js"></script>
<script src="library/word/jquery.wordexport.js"></script>

<script type="text/javascript"> 
        function print_table() {
            $('.gd').css("font-weight","bold");
            if ($('#select_gd').val() == "I"){
                $('.gd').text("Giai đoạn "+$('#select_gd').val() + ", <?php echo $date; ?> - <?php echo $date2; ?>");
            }
            else 
                if ($('#select_gd').val() == "II"){
                    $('.gd').text("Giai đoạn "+$('#select_gd').val() + ", <?php echo $gd2_b; ?> - <?php echo $gd2_e; ?>");
                }
            else 
                if ($('#select_gd').val() == "III"){
                    $('.gd').text("Giai đoạn "+$('#select_gd').val() + ", <?php echo $gd3_b; ?> - <?php echo $gd3_e; ?>");
                }
            var table = document.getElementById('select').value;

            var printContents = document.getElementById(table).innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            window.location = "index.php?id_nc=<?php echo $ma_nc; ?>";
        }

        function word_table() {
            $('.gd').css("font-weight","bold");
            if ($('#select_gd').val() == "I"){
                $('.gd').text("Giai đoạn "+$('#select_gd').val() + ", <?php echo $date; ?> - <?php echo $date2; ?>");
            }
            else 
                if ($('#select_gd').val() == "II"){
                    $('.gd').text("Giai đoạn "+$('#select_gd').val() + ", <?php echo $gd2_b; ?> - <?php echo $gd2_e; ?>");
                }
            else 
                if ($('#select_gd').val() == "III"){
                    $('.gd').text("Giai đoạn "+$('#select_gd').val() + ", <?php echo $gd3_b; ?> - <?php echo $gd3_e; ?>");
                }
            table = $('#select').val();
            table = "#" + table;
            $(table).wordExport();
        }

        $("[name='sua']").click(function() {
            $('#sua').toggle();
        });

        $('.xoa a').on('click',function (e) {
            e.preventDefault();
            var b=e.target.getAttribute("href");
            if (e.target.type != 'button'){
                b=$(e.target).parent();
                    
                b=$(b).attr("href");
            }
            console.log(b);
            if (confirm('Chắc chắn xoá nghiên cứu?')){
                location.href=b;
            }
        });

        $('.date').datepicker({
            dateFormat: 'd-m-yy'
        }); 

        $('#select').click(function () {
            if ($('#select').val() == "uong_thuoc_lay_mau"){
                $('#uong_thuoc_lay_mau').toggle();
            }
        })
</script>
<?php
}
}
?>
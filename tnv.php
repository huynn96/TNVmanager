<head>  
  <link rel='stylesheet' type='text/css' href='css/tnv_search.css'/>  
    <script type='text/javascript'>
    $(document).ready(function() {
       $('.xoa a').click(function (e) {
            e.preventDefault();
            
            var b=e.target.getAttribute('href');
            if (e.target.type != 'button'){
                b=$(e.target).parent();
                    
                b=$(b).attr('href');
            }
            
            if (confirm('Chắc chắn xoá tình nguyện viên?')){
                location.href=b;
            }
        });
      })
    </script>
</head>
<div style="position: relative;z-index: 1;margin: 25px 200px 0 0;float: right;">
</div>
<?php
  
  include_once("connect_db.php");
    if (isset($_POST["check"])){
        $cmt = $_POST["cmt"];
        $check = $_POST["check"];
        $sql = "UPDATE tinh_nguyen_vien SET ds_den='$check' WHERE so_cmt='$cmt'";
        $query = mysql_query($sql);
    }
  if (isset($_GET["search"])){
     $search = $_GET["search"];
  }
  else
  if (isset($_POST["search"])){
    $search = $_POST["search"];
  }
  else $search = $_SESSION["tnv"];
  if ('0' <= $search[0] && $search[0]<= '9')
    $cmt = $search;
  else $ten = $search;
  
  $sql = "SELECT * FROM tinh_nguyen_vien WHERE tinh_nguyen_vien.so_cmt='$cmt' OR tinh_nguyen_vien.ho_ten='$ten' ";
  $query = mysql_query($sql);
  $num_rows = mysql_num_rows($query);
  if ($num_rows == 0)
    include_once("add_tnv.php");

  while ($row = mysql_fetch_array($query)) {
  if ($row["ngay_cap_cmt"]!=null)
    $row["ngay_cap_cmt"]=date('d-m-Y',strtotime($row["ngay_cap_cmt"]));
  $cmtnd = $row['so_cmt'];
  $sql2 = "SELECT * FROM tnv_nghien_cuu WHERE tnv_nghien_cuu.so_cmt='$cmtnd'";
  $query2 = mysql_query($sql2);
  
  echo "
    <div class='container'>
    <div class='clearfix' style='position:relative;float:right;top:15px;'>";
    include_once('tnv_search.php');
  echo"
      </div><div class='row'>
    
        <div>
   
   
          <div class='panel panel-info'>
            <div class='panel-heading'>
              <h3 class='panel-title'>Thông tin cá nhân của tình nguyện viên</h3>
            </div>
            <div class='panel-body'>
              <div class='row'>
               <div class='panel-footer'>
                        <span class='pull-right'>
                            <a href='index.php?page=edit_tnv&tnv=".$row["so_cmt"]."' data-original-title='Edit this user' data-toggle='tooltip' type='button' class='btn btn-sm btn-warning'><i class='glyphicon glyphicon-edit'></i></a>
                              <div class='xoa' style='display:inline'>
                                <a href='delete_tnv.php?tnv=".$row["so_cmt"]."' type='button' class='btn btn-sm btn-danger'><i class='glyphicon glyphicon-remove'></i></a>
                              </div>
                        </span>
                    </div>

                <div class='' col-md-9 col-lg-9 ''> 
                  <table class='table table-user-information'>
                    <tbody>
                      
                      <tr>
                        <td>Họ tên:</td>
                        <td>".$row["ho_ten"]."</td>
                      </tr>
                      <tr>
                        <td>Năm sinh:</td>
                        <td>".$row["year"]."</td>
                      </tr>
                   
                        
                      <tr>
                        <td>Nơi ở hiện tại:</td>
                        <td>".$row["address"]."</td>
                      </tr>
                        <tr>
                        <td>Điện thoại:</td>
                        <td>".$row["phone"]."</td>
                      </tr>
                      <tr>
                        <td>Số CMT:</td>
                        <td>".$row["so_cmt"]."</td>
                      </tr>
                      <tr>
                        <td>Ngày cấp CMT:</td>
                        <td>".$row["ngay_cap_cmt"]."</td>
                      </tr>
                        <td>Nơi cấp CMT:</td>
                        <td>".$row["noi_cap_cmt"]."</td>
                           
                      </tr>
                      </tr>
                        <td>Ghi chú:</td>
                        <td>".$row["ghi_chu"]."</td>
                      </tr>
                      
                      <tr>
                        <td>Các nghiên cứu:</td>
                        <td>";
                        while ($row2 = mysql_fetch_array($query2)) 
                          echo "<button id='".$row2["id"]."' class='test btn btn-primary' data-toggle='tooltip' name='".$cmtnd."'>".$row2["id"];
                        echo "</td>
                      </tr>
                      <tr>
                        <td>Danh sách đen:</td>
                        <td>";
                            if ($row["ds_den"] == 1)
                                echo "<input type='checkbox' value='".$row["so_cmt"]."' checked>";
                            else echo "<input type='checkbox' value='".$row["so_cmt"]."'>";
                        echo"</td>
                      </tr>
                      <tr>";
                        $sql3 = "SELECT MAX(nghien_cuu.date_year), MAX(nghien_cuu.date_year_end), MAX(nghien_cuu.gd2_begin), MAX(nghien_cuu.gd2_end), MAX(nghien_cuu.gd3_begin), MAX(nghien_cuu.gd3_end) FROM nghien_cuu INNER JOIN tnv_nghien_cuu ON tnv_nghien_cuu.so_cmt = '$cmtnd' AND tnv_nghien_cuu.ct='1' AND tnv_nghien_cuu.id = nghien_cuu.id GROUP BY tnv_nghien_cuu.so_cmt";
                        $query3 = mysql_query($sql3);
                        $row3 = mysql_fetch_array($query3);
                        $ngay = max($row3);
                        $ngay = date('d-m-Y',strtotime($ngay));
                      echo "<td>Ngày tham gia nghiên cứu gần nhất:</td>
                        <td>".$ngay."</td>
                      </tr>
                       </tbody>
                  </table>
                
                </div>
              </div>
            </div>
           
            
          </div>
        </div>
      </div>
    </div>";
        }
?>

<script>
$(document).ready(function(){
    
    $('[data-toggle="tooltip"]').tooltip({title: "<textarea id='note'></textarea>", html: true, placement: "bottom", trigger: "click"}); 
    $('[data-toggle="tooltip"]').click(function (e) {
        $.post('editNote.php',{id: $(e.target).attr('id'),so_cmt: $(e.target).attr('name')},function (data) {
            note=data;
            // console.log(note);
            $('#note').val(note); 
            var elem=$('#note');
            while(elem.height() < elem[0].scrollHeight) {elem.height(elem.height()+10);} 
        }); 
        $('#note').focusout(function () {
            note = $('#note').val();
           
            $.post('editNote.php',{notes: note,id: $(e.target).attr('id'),so_cmt: $(e.target).attr('name')}); 
            $('#note').val(note); 
        })
        $('#note').keyup(function () {
            var elem=$('#note');
            while(elem.height() < elem[0].scrollHeight) {elem.height(elem.height()+10);}
        })
        
    });
});
$("[type='checkbox']").click(function (e) {
    console.log($(e.target).val());
    check=0
    if ($(e.target).is(":checked"))
        check=1;
    $.post("tnv.php",{check: check, cmt: $(e.target).val()});

});
</script>
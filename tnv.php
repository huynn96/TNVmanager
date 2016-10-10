<?php
	include_once("connect_db.php");
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
    echo "Tình nguyện viên không có trong dữ liệu!";
	while ($row = mysql_fetch_array($query)) {
  $cmtnd = $row['so_cmt'];
	$sql2 = "SELECT * FROM tnv_nghien_cuu WHERE tnv_nghien_cuu.so_cmt='$cmtnd'";
  $query2 = mysql_query($sql2);
  echo "<script type='text/javascript'>
      function ConfirmDelete()
      {
            if (confirm('Chắc chắn xoá tình nguyện viên?'))
                location.href='delete_tnv.php?tnv=".$cmtnd."';                             
      }
  </script>";
	echo "
		<div class='container'>
      <div class='row'>
    
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
                            <a onclick='ConfirmDelete()' data-original-title='Remove this user' data-toggle='tooltip' type='button' class='btn btn-sm btn-danger'><i class='glyphicon glyphicon-remove'></i></a>
                        </span>
                    </div>

                <div class='' col-md-9 col-lg-9 ''> 
                  <table class='table table-user-information'>
                    <tbody>
                      <tr>
                        <td>Số CMT:</td>
                        <td>".$row["so_cmt"]."</td>
                      </tr>
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
                        <td>Ngày cấp CMT:</td>
                        <td>".$row["ngay_cap_cmt"]."</td>
                      </tr>
                        <td>Nơi cấp CMT:</td>
                        <td>".$row["noi_cap_cmt"]."</td>
                           
                      </tr>
                      <tr>
                        <td>Các nghiên cứu:</td>
                        <td>";
                        while ($row2 = mysql_fetch_array($query2)) 
                          echo $row2["id"].", ";
                        echo "</td>
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
                     
                   
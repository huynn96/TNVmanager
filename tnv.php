<?php
	include_once("connect_db.php");
	$search = $_POST["search"];
	if ('0' <= $search[0] && $search[0]<= '9')
		$cmt = $search;
	else $ten = $search;

	$sql = "SELECT * FROM tinh_nguyen_vien WHERE tinh_nguyen_vien.so_cmt='$cmt' OR tinh_nguyen_vien.ho_ten='$ten' ";
	$query = mysql_query($sql);
	$num_rows = mysql_num_rows($query);
	
	while ($row = mysql_fetch_array($query)) {
		
	echo "
		<div class='container'>
      <div class='row'>
    
        <div  >
   
   
          <div class='panel panel-info'>
            <div class='panel-heading'>
              <h3 class='panel-title'>Thông tin cá nhân của tình nguyện viên</h3>
            </div>
            <div class='panel-body'>
              <div class='row'>
             	 <div class='panel-footer'>
                        <span class='pull-right'>
                            <a href='edit_tnv.php' data-original-title='Edit this user' data-toggle='tooltip' type='button' class='btn btn-sm btn-warning'><i class='glyphicon glyphicon-edit'></i></a>
                            <a href='delete_tnv.php' data-original-title='Remove this user' data-toggle='tooltip' type='button' class='btn btn-sm btn-danger'><i class='glyphicon glyphicon-remove'></i></a>
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
                        <td>".$row["ngay_cap_cmt"]."</td>
                           
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
                     
                   
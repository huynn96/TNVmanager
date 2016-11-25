<?php
	$sql = "SELECT tnv.ho_ten, nc.ma_tnv FROM tinh_nguyen_vien tnv INNER JOIN tnv_nghien_cuu nc ON nc.ct=1 AND nc.id='$ma_nc' AND nc.so_cmt=tnv.so_cmt ORDER BY tnv.ho_ten DESC";
	$query = mysql_query($sql); 
?>
<head>
	<style type='text/css'>
		.table {
            font-size: 13px;
            border-collapse: collapse;
            width: 100%;
            line-height: 20px;
            border: 3px double black !important;
        }
		td, th, tr{
            border: 3px double black !important;
            text-align: center;
            padding: 3px;
        }
		#name{
			margin: 0 50px 0 50px !important;
		}
		.he{
			width: 300px !important;
			font-weight: normal;
			line-height: 30px !important;
			font-size: 15px !important;
		}
	</style>

</head>
<div id='name'>
<?php 
while ($rows = mysql_fetch_array($query)) {
	$i=0;
	while ($i<2){
		echo "
			<table width='612'>
			<tbody>
			<tr>
				<td style='text-align: center;margin:10px 0 10px 0;' width='287'>
					<p>VIỆN KIỂM NGHIỆM THUỐC TW</p>
					<p>TT Đ&Aacute;NH GI&Aacute; TĐSH</p>
				</td>
				<td style='text-align: center;' width='38'>
					<p>&nbsp;</p>
				</td>
				<td style='text-align: center;margin:10px 0 10px 0;' width='287'>
					<p>VIỆN KIỂM NGHIỆM THUỐC TW</p>
					<p>TT Đ&Aacute;NH GI&Aacute; TĐSH</p>
				</td>
			</tr>
			<tr>
				<td style='text-align: center;' width='287'>
					<p><strong>&nbsp;</strong></p>
					<p style='font-size:20px;margin:10px 0 10px 0;'><strong>".$rows["ho_ten"]."</strong></p>
					<p><strong><em>&nbsp;</em></strong></p>
					<p style='font-size:100px;margin:10px 0 10px 0;'><strong>".$rows["ma_tnv"]."</strong></p>
					<p style='font-size:50px;margin:10px 0 10px 0;'><strong>".$ma_nc."</strong></p>
					<p><strong>&nbsp;</strong></p>
				</td>
				<td style='text-align: center;' width='38'>
					<p>&nbsp;</p>
				</td>
				<td style='text-align: center;' width='287'>
					<p><strong>&nbsp;</strong></p>
					<p style='font-size:20px;margin:10px 0 10px 0;'><strong>".$rows["ho_ten"]."</strong></p>
					<p><strong><em>&nbsp;</em></strong></p>
					<p style='font-size:100px;margin:10px 0 10px 0;'><strong>".$rows["ma_tnv"]."</strong></p>
					<p style='font-size:50px;margin:10px 0 10px 0;'><strong>".$ma_nc."</strong></p>
					<p><strong>&nbsp;</strong></p>
				</td>
			</tr>
			<tr>
				<td width='287'>
					<p>&nbsp;</p>
				</td>
				<td width='38'>
					<p>&nbsp;</p>
				</td>
				<td width='287'>
					<p>&nbsp;</p>
				</td>
			</tr>
			</tbody>
			</table>
			<br>
		";
		$i++;
	}
	echo "<br><br>";
}
?>
</div>
<!-- 
<table class='table'>
			<tr>
				<th class='he'>VIỆN KIỂM NGHIỆM THUỐC TW<br>TT ĐÁNH GIÁ TĐSH</th>
				<th style='width: 50px;'></th>
				<th class='he'>VIỆN KIỂM NGHIỆM THUỐC TW<br>TT ĐÁNH GIÁ TĐSH</th>
			</tr>
			<tr>
				<td>
					<p style='font-weight:bold;font-size:20px;margin:10px 0 10px 0;'>'.$rows['ho_ten'].'</p>
				</td>
			</tr>

		</table>
 -->
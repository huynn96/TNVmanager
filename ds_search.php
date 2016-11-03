<head>
    <style type="text/css">
        table {
            font-size: 13px;
            font-family: arial, sans-serif;
            border-collapse: collapse;
            border: none;
            width: 100%;
            line-height: 20px;
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
        
        td,
        th {
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
        
        #add {
            float: right;
            margin: 5px 5px 10px 0;
            color: #369;
            text-decoration: none;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            font-weight: 700;
        }
    </style>
</head>
<table id="table" class="table-striped table-hover">
    <?php
    $ten = $_GET["ten"];
    echo "Search for: ".$ten." <br>";
    include_once("connect_db.php");
    $sql = "SELECT * FROM tinh_nguyen_vien WHERE ho_ten LIKE '%$ten%'";
    $query = mysql_query($sql);
    $num = mysql_num_rows($query);
    if ($num == 0)
        echo "Tình nguyện viên không có trong dữ liệu";
    while ($rows = mysql_fetch_array($query)) {
        $rows["ngay_cap_cmt"]=date('d-m-Y',strtotime($rows["ngay_cap_cmt"]));
        echo "
            <tr>
                <td class='ho_ten'>".$rows["ho_ten"]."</td>
                <td class='year'>".$rows["year"]."</td>
                <td class='noi_o'>".$rows["address"]."</td>
                <td class='phone'>".$rows["phone"]."</td>
                <td class='so_cmt'>".$rows["so_cmt"]."</td>
                <td class='date'>".$rows["ngay_cap_cmt"]."</td>
                <td class='noi_cap'>".$rows["noi_cap_cmt"]."</td>
            </tr>";
    }
?>
</table>
<script type="text/javascript">
    $('#table tr').on("click", clickDiv);

    function clickDiv(e) {
        selectedRow = $(this);
        var td = selectedRow.children('td');

        $("[name='ho_ten']").val(td.eq(0).text());
        $("[name='year']").val(td.eq(1).text());
        $("[name='address']").val(td.eq(2).text());
        $("[name='phone']").val(td.eq(3).text());
        $("[name='cmt']").val(td.eq(4).text());
        $("[name='ngay_cap_cmt']").val(td.eq(5).text());
        $("[name='noi_cap_cmt']").val(td.eq(6).text());
        $('#abox').hide();
    }
</script>
<?php
    error_reporting(0);
    session_start();
    if (isset($_GET["tnv"]))
        $_SESSION["tnv"] = $_GET["tnv"];

    $ma_nc = $_GET["id_nc"];
?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Trang chủ</title>
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="stylesheet" type="text/css" href="library/css/bootstrap.css">
        <link rel="stylesheet" href="library/jquery-ui-1.12.1/jquery-ui.css">
        <script src="library/jquery-1.12.4.js"></script>
        <script src="library/jquery-ui.js"></script>
        <script src="library/js/bootstrap.js"></script>

        <?php
    error_reporting(0);
    
    switch ($_GET["page"]){
        case "ds_ct": echo "<link rel='stylesheet' type='text/css' href='css/ds_ct.css'/>";
        break;
        case "edit_tnv": echo "<link rel='stylesheet' type='text/css' href='css/sua_profile.css'/>";
        break;
        case "add_nc": echo "<link rel='stylesheet' type='text/css' href='css/add_nc.css'/>";
        break;
        case "tnv": echo "<link rel='stylesheet' type='text/css' href='css/tnv.css'/>";
        break;
        default: echo "<link rel='stylesheet' type='text/css' href='css/tnv_search.css'/>";
        break;
    }
    ?>
    </head>

    <body>
        <div id="wrapper">
            <div id="header">
                <div class="head_top">

                    <a title="Viện Kiểm nghiệm thuốc Trung ương">
                        <img src="./img/New Bitmap Image.bmp" width=100% height=100%>
                    </a>
                </div>
            </div>
            <div id="wp_content" class="clearfix">
                <div id="content">
                    <?php
                    switch ($_GET["page"]){
                        case "ds_ct": include("ds_ct.php");
                        break;  
                        case "edit_tnv": include_once("sua_profile.php");
                        break;
                        case "add_nc": include_once("add_nc.php");
                        break;
                        case "tnv": include_once("tnv.php");
                        break;
                        default: include_once("tnv_search.php");
                        break;
                    }
                ?>

                </div>
                <div id="sidebar">
                    <ul id="tree1">
                        <li><a href="index.php?page=tnv_search">Quản lý tình nguyện viên</a></li>

                        <li id="loadjQuery"><a href="search_nc.php">Quản lý nghiên cứu</a>
                            <ul>
                                <ul>
                                    <?php
                            include_once("connect_db.php");

                            $sql = "SELECT id, date_year FROM nghien_cuu ORDER BY date_year DESC";
                            $query = mysql_query($sql);
                            $year=0;
                            
                            while ($row = mysql_fetch_array($query)) {
                                $year1=date('Y',strtotime($row["date_year"]));
                                
                                if ($year1 != $year){
                                    echo "</ul> </ul> 
                                            <ul>".
                                                "<li>".
                                                    $year1.
                                                    "<ul>".
                                                        "<li><a href='sua_nghien_cuu.php?id_nc=".$row["id"]."'>".
                                                            $row["id"].
                                                            "</a><ul> <li> <a href='ds_ct.php?id_nc=".$row["id"]."'>Ds chính thức</a></li></ul>".
                                                        "</li>";
                                    $year = $year1;
                                }
                                else{
                                    echo "<li><a href='sua_nghien_cuu.php?id_nc=".$row["id"]."'>".$row["id"]."</a><ul> <li> <a href='ds_ct.php?id_nc=".$row["id"]."'>Ds chính thức</a></li></ul></li>";
                                }
                                
                            }

                        ?>
                        </li>
                        </ul>
                </div>
            </div>
            <div id="footer">
                <div class="bottom_content">
                    <p/> Địa chỉ: Cơ sở 1: 48 Hai Bà Trưng, Hoàn Kiếm, Hà Nội - Cơ sở 2: Tựu Liệt, Tam Hiệp, Thanh Trì, Hà Nội.
                    <p/>
                    <p/> Liên hệ: Tel: (84-4) 38252791; (84-4) 38255341 - Fax: (84-4) 38256911 - Email: khth@nidqc.org.vn
                    <p/>
                </div>
            </div>

        </div>

        <script type="text/javascript">
            $('#loadjQuery a').click(function (e) {
                e.preventDefault();
                var link = e.target;
                var next = link.getAttribute("href");
      
                $('#content').load(next);
            });

        </script>

        <script type="text/javascript">
            $.fn.extend({
                treed: function (o) {

                    var openedClass = 'glyphicon-minus-sign';
                    var closedClass = 'glyphicon-plus-sign';

                    if (typeof o != 'undefined') {
                        if (typeof o.openedClass != 'undefined') {
                            openedClass = o.openedClass;
                        }
                        if (typeof o.closedClass != 'undefined') {
                            closedClass = o.closedClass;
                        }
                    };

                    //initialize each of the top levels
                    var tree = $(this);
                    tree.addClass("tree");
                    tree.find('li').has("ul").each(function () {
                        var branch = $(this); //li with children ul
                        branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");

                        branch.addClass('branch');
                        branch.on('click', function (e) {
                            if (this == e.target) {
                                var icon = $(this).children('i:first');
                                icon.toggleClass(openedClass + " " + closedClass);
                                $(this).children().children().toggle();
                            }
                        })
                        //console.log(branch.children().children().text());
                        branch.children().children().toggle();
                    });
                    //fire event from the dynamically added icon
                    tree.find('.branch .indicator').each(function () {
                        $(this).on('click', function () {
                            $(this).closest('li').click();
                        });
                    });
                    //fire event to open branch if the li contains an anchor instead of text
                    tree.find('.branch>a').each(function () {
                        $(this).on('click', function (e) {
                            $(this).closest('li').click();
                            //e.preventDefault();
                        });
                    });
                    //fire event to open branch if the li contains a button instead of text
                    tree.find('.branch>button').each(function () {
                        $(this).on('click', function (e) {
                            $(this).closest('li').click();
                            e.preventDefault();
                        });
                    });
                }
            });

            $('#tree1').treed({
                openedClass: 'glyphicon-folder-open',
                closedClass: 'glyphicon-folder-close'
            });

            $("#loadjQuery").children().children().toggle();
            var icon = $("#loadjQuery").children('i:first');
            icon.toggleClass("glyphicon-folder-open" + " " + "glyphicon-folder-close");

            var p = $("[href='sua_nghien_cuu.php?id_nc=<?php echo $ma_nc; ?>']");
            p=p.parent();
           

            p.parent().parent().children().children().toggle();
            var icon = p.parent().parent().children('i:first');
            icon.toggleClass("glyphicon-folder-open" + " " + "glyphicon-folder-close");

            p.children().children().toggle();
            var icon = p.children('i:first');
            icon.toggleClass("glyphicon-folder-open" + " " + "glyphicon-folder-close");
        </script>

    </body>

    </html>
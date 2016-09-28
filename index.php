<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Trang chủ</title>
<link rel="stylesheet" type="text/css" href="css/index.css">
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<?php
	error_reporting(0);
	switch ($_GET["page"]){
		case "tnv": "<link rel='stylesheet' type='text/css' href='css/tnv.css'>";
		break;

	}
	?>
</head>

<body>
	<div id="wrapper">
        <div id="header">
			<div class="head_top">

<!--				<a  title="Viện Kiểm nghiệm thuốc Trung ương">-->
<!--					<embed type="application/x-shockwave-flash" width="1024" height="160"-->
<!--						   src="http://www.nidqc.org.vn/wp-content/themes/nidqc/images/banner.swf" quality="high"-->
<!--						   name="banner-thuoc" pluginspage="http://www.macromedia.com/go/getflashplayer" style="border-style: solid !important;"/>-->
				<embed type="application/x-shockwave-flash" width="1024" height="160" src="http://www.nidqc.org.vn/wp-content/themes/nidqc/images/banner.swf" quality="high" name="banner-thuoc" pluginspage="http://www.macromedia.com/go/getflashplayer"/>
			</div>
        </div>
        <div id="wp_content" class="clearfix">
            <div id="content">
                <?php
					switch ($_GET["page"]){
						case "tnv": include_once("tnv.php");
						break;

					}
				?>
            </div>
        	<div id="sidebar">
            	<ul id="tree1">
            		<li><a href="index.php?page=tnv">Quản lý tình nguyện viên</a></li>
        			<li><a href="">Quản lý nghiên cứu</a>
          			<ul>
            			<li>2014          
              			<ul>
                			<li>DW CS3
                            <ul>
                                <li>Ds chính thức</li>
                                <li>Ds dự bị</li>
                            </ul>
                            </li>
                			<li>DW CS4</li>
                			<li>DW CS5</li>
                			<li>DW CS6</li>
                			<li>DW CC</li>
              			</ul>
            			</li>
            			<li>2015
						<ul>
							<li>Abcxyz</li>
							<li>xyzabc</li>
						</ul>
            			</li>
          			</ul>
       				</li>
       			</ul>
        	</div>
        </div>
        <div id="footer">
            FOOTER
        </div> 
    </div>

<script type="text/javascript">
$.fn.extend({
    treed: function (o) {
      
      var openedClass = 'glyphicon-minus-sign';
      var closedClass = 'glyphicon-plus-sign';
      
      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
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
            branch.children().children().toggle();
        });
        //fire event from the dynamically added icon
      tree.find('.branch .indicator').each(function(){
        $(this).on('click', function () {
            $(this).closest('li').click();
        });
      });
        //fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
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

$('#tree1').treed({openedClass:'glyphicon-folder-open', closedClass:'glyphicon-folder-close'});
 
</script>
</body>
</html>
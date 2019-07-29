<?php include('php/header.php'); include('php/conn.php'); include("php/stats.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>MAC - Admin Tool</title>

    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="css/lineicons.css">
    <link rel="stylesheet" type="text/css" href="js/gritter/css/jquery.gritter.css" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/styling.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">

    <script src="js/chart-master/Chart.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<section id="container" >

    <header class="header header-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <a href="#" class="logo"><b>Macatalysts - Admin Tool</b></a>
        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <li><button class="logout">Logout</button></li>
            </ul>
        </div>
    </header>
    <aside>
        <div id="sidebar"  class="nav-collapse" style="z-index: 1000">
            <ul class="sidebar-menu" id="nav-accordion">

                <h5 class="centered"></h5>
                <li class="mt">
                    <a href="index.php">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu">
                    <a class="active" href="#">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span>Profile Management</span>
                    </a>
                </li>
                <li class="menu">
                    <a href="posts.php">
                        <i class="fa fa-dashboard"></i>
                        <span>Post Management</span>
                    </a>
                </li>
                <li class="menu">
                    <a href="messages.php">
                        <i class=" fa fa-bar-chart-o"></i>
                        <span>Messages</span>
                    </a>
                </li>
                <li class="menu">
                    <a href="newsOptions.php">
                        <i class="fa fa-th"></i>
                        <span>News Options</span>
                    </a>
                </li>

                <li class="menu">
                    <a href="eventOptions.php">
                        <i class="fa fa-th"></i>
                        <span>Event Options</span>
                    </a>
                </li>
                <li class="menu">
                    <a href="about.php">
                        <i class="fa fa-th"></i>
                        <span>About</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="container content">
                    <h3>Profile Management</h3>
                    <button type="button" class="btn btn-primary">New Profile</button>
                    <button type="button" class="btn btn-success">See Active</button>
                    <button type="button" class="btn btn-danger">See Inactive</button>
                    <button type="button" class="btn btn-primary">See All</button>

                    <hr>
                    <div class="row">
                        <div class="container-fluid content">
                            <div class="container" >
                                <?php
                                $sqliQuery = ("SELECT COUNT(*) FROM `companies`");
                                $res = $mysqli->query($sqliQuery);
                                $row = $res->fetch_row();
                                $count = $row[0];


                                if(isset($_GET['page']))
                                {
                                    $page = preg_replace("#[^0-9]#","",$_GET["page"]);
                                }else{
                                    $page = 1;
                                }

                                $perPage = 12;

                                $lastPage =  ceil($count/$perPage);

                                if($page<1){
                                    $page = 1;
                                }
                                else if($page > $lastPage){
                                    $page = $lastPage;
                                }

                                $limit = "LIMIT ".($page - 1) * $perPage . ", $perPage";

                                $sqliQuery = ("SELECT `ID`, `NAME`, LEFT(`INFO`,200) as INFO, `LOGO`,`STATUS` FROM `companies` ORDER by NAME  ASC $limit ");
                                $res = $mysqli->query($sqliQuery);



                                while($item = $res->fetch_assoc())
                                {
                                    $id = $item['ID'];
                                    $ttle = $item['NAME'];
                                    $Info= strip_tags($item['INFO']);
                                    $activation = "<button type=\"button\" class=\"btn btn-danger\">Deactivate</button>";
                                    if($item['STATUS'] == 0){ $activation = "<button type=\"button\" class=\"btn btn-success\">Activate</button>";}

                                    $status= strip_tags($item['STATUS']);


                                    $thmb = $item['LOGO'];

                                    echo "<div class=\"col-md-12 transparentWhite\" >
                                             <div class=\"col-md-12\" style=\"padding:1px\">
                                                 <h2>$ttle</h2>
                                                 <h5 font-color='blue'>$Info... </h5>
                                                 
                                             </div>
                                             <div class=\"col-md-12\" style=\"padding:1px\">
                                                <button type=\"button\" class=\"btn btn-primary\">Edit</button>
                                               $activation
                                             </div>
                                             <hr>
                                        </div>";
                                }

                                $prevP = "";
                                $nextP = "";

                                if($lastPage != 1)
                                {
                                    if($page != $lastPage)
                                    {
                                        $next = $page + 1;
                                        $nextP = "<li><a href=\"CompaniesS.php?page=$next\" aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a></li>";
                                    }

                                    if($page != 1)
                                    {
                                        $prev = $page - 1;
                                        $prevP = "<li><a href=\"Companies.php?page=$prev\" aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a></li>";
                                    }
                                }


                                $pagination = "<nav><ul class=\"pagination pagination-sm\">";
                                $pagination .= "$prevP";

                                for ($countPage = 0; $countPage < $lastPage; $countPage++) {
                                    $pageNum = $countPage + 1;
                                    if($page == $pageNum)
                                    {
                                        $pagination .= "<li class=\"active\"><a href=\"Companies.php?page=$pageNum\">$pageNum</a></li>";
                                    }else{
                                        $pagination .= "<li><a href=\"Companies.php?page=$pageNum\">$pageNum</a></li>";
                                    }
                                }

                                $pagination .= "$nextP";
                                $pagination .= "</ul></nav>";


                                echo "</div>";
                                echo "<div class=\"container\">
					            <div class=\"row\">
					            <div class=\"col-md-12 text-center\">";
                                echo $pagination;
                                echo "</div>";
                                echo "</div>";
                                ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</section>
<script src="js/jquery.js"></script>
<script src="js/jquery-1.8.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="js/jquery.sparkline.js"></script>
<script src="js/common-scripts.js"></script>
<script type="text/javascript" src="js/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="js/gritter-conf.js"></script>
<script src="js/sparkline-chart.js"></script>
<script src="js/zabuto_calendar.js"></script>
</body>
</html>

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
                    <h3>Profile Management - Editor</h3>
                    <button type="button" class="btn btn-success">Save</button>
                    <button type="button" class="btn btn-primary">Preview</button>
                    <button type="button" class="btn btn-danger">Cancel</button>

                    <hr>
                    <div class="row">
                        <div class="container-fluid content">
                            <div class="container" >

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

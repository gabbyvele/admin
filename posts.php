<?php
include('php/serverCache.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>MAC - Dashboard</title>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">Macatalysts - Admin Tool</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="index.php">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Posts">
                <a class="nav-link" href="companies.php">
                    <i class="fa fa-fw fa-address-book"></i>
                    <span class="nav-link-text">Companies</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Posts">
                <a class="nav-link" href="companyManagement.php">
                    <i class="fa fa-fw fa-address-card"></i>
                    <span class="nav-link-text">Company Management</span>
                </a>
            </li>
            <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Posts">
                <a class="nav-link" href="posts.php">
                    <i class="fa fa-fw fa-gears"></i>
                    <span class="nav-link-text">Posts</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Posts">
                <a class="nav-link" href="postManagement.php">
                    <i class="fa fa-fw fa-gear"></i>
                    <span class="nav-link-text">Post Management</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-fw fa-sign-out"></i>Logout</a>
            </li>
        </ul>
    </div>
</nav>
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Posts</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <h1>Posts</h1>
                <div class="container-fluid content">
                    <div class="col-md-12">
                        <?php
                        if (isset($_GET['page'])) {
                            $page = preg_replace("#[^0-9]#", "", $_GET["page"]);
                        } else {
                            $page = 1;
                        }

                        $perPage = 10;

                        $lastPage = ceil($countAllPosts / $perPage);

                        if ($page < 1) {
                            $page = 1;
                        } else if ($page > $lastPage) {
                            $page = $lastPage;
                        }

                        $limit = "LIMIT " . ($page - 1) * $perPage . ", $perPage";


                        $sqliQuery = ("SELECT pst.ID, pst.SUBJECT, pst.ACTIVE, pst.TIMESTAMP, typ.NAME AS 'TYPE_NAME' 
                                                  FROM posts pst JOIN post_type typ on pst.TYPE=typ.ID 
                                                  ORDER BY pst.TIMESTAMP ASC $limit");

                        $res = $mysqli->query($sqliQuery);
                        echo "<table class=\"table table-hover\">";
                        while ($post = $res->fetch_assoc()) {
                            $totalOnPage++;
                            $id = $post['ID'];
                            $subject = $post['SUBJECT'];
                            $date = $post['TIMESTAMP'];
                            $type = $post['TYPE_NAME'];
                            $active;
                            if ($post['ACTIVE'] == 0) {
                                $active = "<i class=\"fa fa-window-close\" aria-hidden=\"true\"></i>";
                            } else {
                                $active = "<i class=\"fa fa-check-circle-o\" aria-hidden=\"true\"></i>";
                            }
                            echo "
								<tr>
									<td>
										<a href=\"postManagement.php?post-id=$id\">
											<div class=\"row\">
												<div class=\"col-md-12\"><b>Subject: $subject</b></div>
												<div class=\"col-md-12\">$date</div>
											</div>
											<div class=\"row\">
												<div class=\"col-md-12\"><b>Type : $type</b></div>
											</div>
										</a>
									</td>
								    <td> 
									    $active
								    </td>
								</tr>";
                        }
                        echo "</table>";

                        $prevP = "
                                <li class=\"paginate_button page-item previous disabled\" id=\"dataTable_previous\">
                                <a href=\"#\" aria-controls=\"dataTable\" data-dt-idx=\"0\" tabindex=\"0\" class=\"page-link\">Previous</a>
                                </li>";
                        $nextP = "
                                <li class=\"paginate_button page-item next disabled\" id=\"dataTable_next\">
                                <a href=\"#\" aria-controls=\"dataTable\" data-dt-idx=\"7\" tabindex=\"0\" class=\"page-link\">Next</a></li>
                                </ul>";

                        if ($lastPage != 1) {
                            if ($page != 1) {
                                $prev = $page - 1;
                                $prevP = "
                                    <li class=\"paginate_button page-item previous\" id=\"dataTable_previous\">
                                    <a href=\"posts.php?page=$prev\" aria-controls=\"dataTable\" data-dt-idx=\"0\" tabindex=\"0\" class=\"page-link\">Previous</a>
                                    </li>";
                            }
                            if ($page != $lastPage) {
                                $next = $page + 1;
                                $nextP = "
                                    <li class=\"paginate_button page-item next\" id=\"dataTable_next\">
                                    <a href=\"posts.php?page=$next\" aria-controls=\"dataTable\" data-dt-idx=\"$lastPage.1\" tabindex=\"0\" class=\"page-link\">Next</a></li>
                                    </ul>";
                            }

                        }

                        $pagination = "<div class=\"dataTables_paginate paging_simple_numbers\" id=\"dataTable_paginate\"><ul class=\"pagination\">";
                        $pagination .= "$prevP";

                        for ($countPage = 0; $countPage < $lastPage; $countPage++) {
                            $pageNum = $countPage + 1;
                            if ($page == $pageNum) {
                                $pagination .= "
                                    <li class=\"paginate_button page-item active\">
                                    <a href=\"posts.php?page=$pageNum\" aria-controls=\"dataTable\" data-dt-idx=\"$pageNum\" tabindex=\"0\" class=\"page-link\">$pageNum</a>
                                    </li>";
                            } else {
                                $pagination .= "
                                    <li class=\"paginate_button page-item\">
                                    <a href=\"posts.php?page=$pageNum\" aria-controls=\"dataTable\" data-dt-idx=\"$pageNum\" tabindex=\"0\" class=\"page-link\">$pageNum</a>
                                    </li>";                            }
                        }

                        echo "
                        </div>";
                        $pagination .= "$nextP";
                        $pagination .= "</ul>";
                        $showing = $perPage + $totalOnPage;

                        echo "<div class=\"container\">";
                        echo "<div class=\"row\">
                                <div class=\"col-sm-12 col-md-12\">
                                    <div class=\"dataTables_info\" id=\"dataTable_info\" role=\"status\" aria-live=\"polite\">
                                    $pagination
                                    <div>
                                </div>
                              </div>
                              </div>";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>© 2017 Macatalysts | Privacy | Powered by <a href="https://myitzar.co.za/">MyITZAR</a></small>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
</div>
</body>

</html>

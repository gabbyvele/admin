<?php
    include('php/conn.php');

    $sqliQuery = ("SELECT COUNT(*) FROM `companies`");
    $res = $mysqli->query($sqliQuery);
    $row = $res->fetch_row();
    $countAllCompanies = $row[0];

    $sqliQuery = ("SELECT COUNT(*) FROM `members`");
    $res = $mysqli->query($sqliQuery);
    $row = $res->fetch_row();
    $countMembers = $row[0];

    $sqliQuery = ("SELECT COUNT(*) FROM `posts` ");
    $res = $mysqli->query($sqliQuery);
    $row = $res->fetch_row();
    $countAllPosts = $row[0];

    $sqliQuery = ("SELECT COUNT(*) FROM `posts` WHERE ACTIVE = 1");
    $res = $mysqli->query($sqliQuery);
    $row = $res->fetch_row();
    $countActivePosts = $row[0];


    $sqliQuery = ("SELECT COUNT(*) FROM `company_adverts`");
    $res = $mysqli->query($sqliQuery);
    $row = $res->fetch_row();
    $countCompanyAds = $row[0];

    $selectPostsQuery = "SELECT pst.ID, cmp.NAME AS 'COMPANY_NAME', cmp.ID AS 'COMPANY_ID', pst.SUBJECT, pst.ACTIVE, pst.TIMESTAMP, pst.POST, pst.FILE, typ.NAME AS 'TYPE_NAME' 
    FROM posts pst JOIN post_type typ on pst.TYPE=typ.ID 
    JOIN companies cmp on pst.COMPANY_ID=cmp.ID ";

    $sqliQuery = ("SELECT ID, NAME FROM `companies`");
    $companies = $mysqli->query($sqliQuery);

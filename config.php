<?php
    error_reporting(E_ALL);


    define("HOST", "localhost");
    define("USER", "root");
    define("PASS", "12345678");
    define("DBNAME", "store");


    $link = @mysqli_connect(HOST, USER, PASS);


    if (!$link) {
        error_log("Database connection failed: " . mysqli_connect_error());
        echo "<script>alert('Database connection failed!'); window.history.back();</script>";
        exit;
    }


    if (!mysqli_select_db($link, DBNAME)) {
        error_log("Database selection failed: " . mysqli_error($link));
        echo "<script>alert('Failed to select database.'); window.history.back();</script>";
        exit;
    }


    if (!mysqli_set_charset($link, 'utf8')) {
        error_log("Error loading character set utf8: " . mysqli_error($link));
        echo "<script>alert('Error loading character set utf8.'); window.history.back();</script>";
        exit;
    }


    include("functions.php");
?>

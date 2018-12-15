<?php
    session_start();
    header("Access-Control-Allow-Origin: *");
    $_SESSION['customer']['sub-package-selected'] = $_POST['select'];

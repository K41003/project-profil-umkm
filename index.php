<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
include 'includes/header.php';
include "pages/$page.php";
include "includes/footer.php";
?>
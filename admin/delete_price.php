<?php
@ob_start();
//session_start();
require_once 'config/config.php';
require_once 'config/helper.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $deleted = $db->query("DELETE FROM `default_price` WHERE `id` = '$id'");
    if ($deleted) {
        echo "<script>window.location='view_price.php';</script>";
    }
}
ob_flush();

?>
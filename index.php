<?php 
session_start();
$act = isset($_GET['action']) ? $_GET['action'] : '';
require_once 'BackEnd/View/view.php';
$view = new View();
$view->action();
?>
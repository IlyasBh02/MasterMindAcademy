<?php 
session_start();
require_once __DIR__."/../../class/TextCourse.php";
require_once __DIR__."/../../class/VedeoCourse.php";
if (isset($_SESSION['status']) &&  $_SESSION['status'] == 'not allowed') {
    header("Location: ./bannedPage.php");
}

$type = $_GET['type'];
$id = $_GET['id'];


if($type == 'text'){
    TextCourse::deleteCourse($id);
    header("Location: ./MyCourses.php");
}
else if($type == "vedeo"){
    VedeoCourse::deleteCourse($id);
    header("Location: ./MyCourses.php");
}
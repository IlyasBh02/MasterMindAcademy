<?php
require_once __DIR__."/../../session_start.php";
require_once __DIR__ . "/../../class/Admin.php";

$id = $_GET['id'];

if(Admin::activeEnseignant($id)){
    header("Location: ./Dashboard.php");
}
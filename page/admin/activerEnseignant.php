<?php
session_start();
require_once __DIR__ . "/../../class/Admin.php";

$id = $_GET['id'];

if(Admin::activeEnseignant($id)){
    header("Location: ./Dashboard.php");
}
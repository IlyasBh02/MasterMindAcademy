<?php

session_start();
require_once __DIR__ . "/../../class/Admin.php";

$id = $_GET['id'];

if(Admin::desactivEnseignant($id)){
    header("Location: ./Dashboard.php");
}
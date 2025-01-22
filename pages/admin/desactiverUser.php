<?php

require_once __DIR__."/../../class/Admin.php";

$id = $_GET['id'];


if(Admin::desactiveUser($id)){
    header("Location: ./UserTable.php");
}

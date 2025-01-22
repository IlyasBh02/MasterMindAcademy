<?php

require_once __DIR__."/../../class/Category.php";

$id = $_GET['id'];

$cat = Category::deleteCategory($id);

if($cat){
    header("Location: ./CategoryTable.php");
}
else{
    echo "error";
}
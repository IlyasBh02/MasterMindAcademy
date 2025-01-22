<?php

require_once __DIR__."/../../class/Tag.php";

$id = $_GET['id'];

$tag = tag::deleteTag($id);

if($tag){
    header("Location: ./TagsTable.php");
}
else{
    echo "error";
}
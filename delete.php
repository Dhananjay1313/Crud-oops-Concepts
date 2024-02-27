<?php

include_once("xyz.php");

$xyz = new xyz();


$id = $xyz->escape_string($_GET['id']);


$result = $xyz->execute("DELETE FROM data WHERE id=$id");
$result = $xyz->delete($id, 'data');

if ($result) {
    header("Location:add.php");
}
?>
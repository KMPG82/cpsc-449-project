<?php
session_start();
include("connect.php");

$item_id = $_GET['item_id'];

$sql_delete_item = "delete from Item where Item_id='$item_id';";
$conn->query($sql_delete_item);

$conn->close();

header("Location: user_items.php");
exit();

<?php
session_start();
include("connect.php");

$user_email = "user1@email.com";
$recipient = $_GET['Recipient'];
$item_id = $_GET['Item_id'];
$message = $_POST['message'];

$sql = "insert into message (Sender_email, Recipient_email, Item_id, Content)
values ('$user_email','$recipient','$item_id','$message');";

$result = $conn->query($sql);

header("location: http://localhost/cpsc-449-project/view_messages.php?Other_user=".$recipient."&Item_id=".$item_id);

$conn->close();
?>
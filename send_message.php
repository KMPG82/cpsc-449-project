<?php
session_start();
include("connect.php");

$user_email = $_SESSION["Email"];
$recipient = $_GET['Recipient'];
$item_id = $_GET['Item_id'];
$message = $_POST['message'];

$sql_insert_message = "insert into message (Sender_email, Recipient_email, Item_id, Content)
values ('$user_email','$recipient','$item_id','$message');";

$sent_message = $conn->query($sql_insert_message);

$sql_fetch_notification = "select count(*) from notification where Sender_email = '$user_email' and Recipient_email = '$recipient' and Item_id = '$item_id';";
$notification = $conn->query($sql_fetch_notification);

$row = $notification->fetch_assoc();
if ($row['count(*)'] == 0) {
    $sql_insert_notification = "insert into notification (Sender_email, Recipient_email, Item_id)
    values ('$user_email','$recipient','$item_id');";

    $insert_notification = $conn->query($sql_insert_notification);
}

echo "
<script>
alert('Message sent successfully.');
window.location.href='view_messages.php?Other_user=$recipient&Item_id=$item_id';
</script>
";

$conn->close();

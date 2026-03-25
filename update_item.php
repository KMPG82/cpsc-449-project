<?php
session_start();
include("connect.php");

if (!isset($_SESSION["User_id"]) || !isset($_SESSION["Email"])) {
    header("Location: /cpsc-449-project/index.php");
    exit();
}

$user_id = $_SESSION["User_id"];
$user_email = $_SESSION["Email"];
$item_id = $_GET['item_id'];
$title = $_POST["title"];
$type = $_POST["type"];
$category = $_POST["category"];
$location = $_POST["location"];
$date = $_POST["date"];
$description = $_POST["description"];

if (!empty($_FILES["image"]["name"])) {
    $image_name = $_FILES["image"]["name"];
    $image_tmp_name = $_FILES["image"]["tmp_name"];
    $target = "./images/" . $image_name;

    move_uploaded_file($image_tmp_name, $target);

    $sql = "
        update item set 
        Inserted_at = CURRENT_TIMESTAMP,
        Location = ?,
        Description = ?,
        Title = ?,
        Type = ?,
        Category = ?,
        Date = ?,
        Img = ?
        where Item_id = ?;
        ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sssssssi",
        $location,
        $description,
        $title,
        $type,
        $category,
        $date,
        $target,
        $item_id
    );
} else {
    $sql = "
        update item set 
        Inserted_at = CURRENT_TIMESTAMP,
        Location = ?,
        Description = ?,
        Title = ?,
        Type = ?,
        Category = ?,
        Date = ?
        where Item_id = ?;
        ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "ssssssi",
        $location,
        $description,
        $title,
        $type,
        $category,
        $date,
        $item_id
    );
}

$stmt->execute();

echo "
<script>
alert('Item updated successfully.');
window.location.href='user_items.php';
</script>
";

$conn->close();

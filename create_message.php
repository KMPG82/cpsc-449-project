<?php
session_start();
include("connect.php");

if (!isset($_SESSION["User_id"]) || !isset($_SESSION["Email"])) {
    header("Location: /cpsc-449-project/index.php");
    exit();
}

$user_email = $_SESSION["Email"];
$recipient = $_GET['Recipient'];
$item_id = $_GET['Item_id'];

$sql_fetch_notifications = "select count(*) from notification where Recipient_email = '$user_email';";
$notifications = $conn->query($sql_fetch_notifications);

$row = $notifications->fetch_assoc();
$count = $row['count(*)'];
?>

<!doctype html>
<html lang="en" class="h-100" data-bs-theme="dark">

<head>
    <title>Create Message</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<nav class="navbar bg-body-tertiary">
    <a class="navbar-brand ms-2" href="#">L&F</a>

    <ul class="navbar-nav me-auto flex-row d-flex">
        <li class="nav-item me-2">
            <a class="nav-link" href="user_items.php">Your Items</a>
        </li>

        <li class='nav-item me-2'>
            <a class='nav-link' href='view_items.php'>All Items</a>
        </li>

        <li class="nav-item me-2">
            <a class="nav-link" href="lost_items.php">Lost Items</a>
        </li>

        <li class="nav-item me-2">
            <a class="nav-link" href="found_items.php">Found Items</a>
        </li>

        <li class="nav-item me-2">
            <a class="nav-link" href="item_submission.php">Create Item</a>
        </li>

        <?php
        if ($count > 0) {
            echo ("
            <li class='nav-item me-2 active'>
                <a class='nav-link' href='view_conversations.php'>Inbox*</a>
            </li>
            ");
        } else {
            echo ("
            <li class='nav-item me-2 active'>
                <a class='nav-link' href='view_conversations.php'>Inbox</a>
            </li>
            ");
        } ?>
    </ul>

    <a href="logout.php">
        <button class="btn btn-danger me-2" type="button">Logout</button>
    </a>
</nav>

<body>
    <form action="send_message.php?Recipient=<?php echo $recipient; ?>&Item_id=<?php echo $item_id; ?>" method='post' class="h-50">
        <h1 class="mb-2 ms-2"><?php echo 'Sending message to ' . $recipient . ' about item#' . $item_id; ?></h1>

        <textarea required class="form-control w-75 ms-2" rows="5" name="message" placeholder="Type your message here..."></textarea>

        <button type="submit" name="send" class="btn btn-primary btn-lg ms-2 mt-2">Send Message</button>
    </form>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</html>
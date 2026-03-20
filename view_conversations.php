<?php
session_start();
include("connect.php");

if (!isset($_SESSION["User_id"]) || !isset($_SESSION["Email"])) {
    header("Location: /cpsc-449-project/index.php");
    exit();
}

$user_email = $_SESSION["Email"];

$sql_fetch_conversations = "
select *
from message
where Sender_email='$user_email' or Recipient_email='$user_email'
group by Item_id,
case
    when Sender_email='$user_email' then Recipient_email
    else Sender_email
end
order by Inserted_at desc;
";

$recieved_messages = $conn->query($sql_fetch_conversations);

$sql_fetch_notifications = "select count(*) from notification where Recipient_email = '$user_email';";
$notifications = $conn->query($sql_fetch_notifications);

$row = $notifications->fetch_assoc();
$count = $row['count(*)'];
?>

<!doctype html>
<html lang="en" class="h-100" data-bs-theme="dark">

<head>
    <title>Inbox</title>

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
            <li class='nav-item me-2'>
                <a class='nav-link active' href='view_conversations.php'>Inbox*</a>
            </li>
            ");
        } else {
            echo ("
            <li class='nav-item me-2'>
                <a class='nav-link active' href='view_conversations.php'>Inbox</a>
            </li>
            ");
        } ?>
    </ul>

    <a href="logout.php">
        <button class="btn btn-danger me-2" type="button">Logout</button>
    </a>
</nav>

<body>
    <h1 class="display-2 text-center">Inbox</h1>

    <?php while ($row = $recieved_messages->fetch_assoc()) {
    ?>
        <?php if ($row['Sender_email'] == $user_email) { ?>
            <a href="view_messages.php?Other_user=<?php echo $row['Recipient_email']; ?>&Item_id=<?php echo $row['Item_id']; ?>" class="link-underline link-underline-opacity-0 link-body-emphasis">
                <div class="d-flex flex-column border-bottom border-top p-4">
                    <h1 class="ms-2 mt-2 mb-2">
                        <?php
                        $other_user = $row['Recipient_email'];
                        $item_id = $row['Item_id'];

                        $sql_check_notifaction = "select count(*) from notification where Recipient_email = '$user_email' and Sender_email = '$other_user' and Item_id = '$item_id' ;";
                        $check_notifaction = $conn->query($sql_check_notifaction);

                        $check_notifaction_row = $check_notifaction->fetch_assoc();
                        $check_count = $check_notifaction_row['count(*)'];

                        if ($check_count > 0) {
                            echo '[NEW MESSAGE] Conversation with ' . $row['Recipient_email'] . ' for item#' . $row['Item_id'];
                        } else {
                            echo 'Conversation with ' . $row['Recipient_email'] . ' for item#' . $row['Item_id'];
                        }
                        ?>
                    </h1>
                </div>
            </a>
        <?php } else { ?>
            <a href="view_messages.php?Other_user=<?php echo $row['Sender_email']; ?>&Item_id=<?php echo $row['Item_id']; ?>" class="link-underline link-underline-opacity-0 link-body-emphasis">
                <div class="d-flex flex-column border-bottom border-top p-4">
                    <h1 class="ms-2 mt-2 mb-2">
                        <?php
                        $other_user = $row['Sender_email'];
                        $item_id = $row['Item_id'];

                        $sql_check_notifaction = "select count(*) from notification where Recipient_email = '$user_email' and Sender_email = '$other_user' and Item_id = '$item_id' ;";
                        $check_notifaction = $conn->query($sql_check_notifaction);

                        $check_notifaction_row = $check_notifaction->fetch_assoc();
                        $check_count = $check_notifaction_row['count(*)'];

                        if ($check_count > 0) {
                            echo '[NEW MESSAGE] Conversation with ' . $row['Sender_email'] . ' for item#' . $row['Item_id'];
                        } else {
                            echo 'Conversation with ' . $row['Sender_email'] . ' for item#' . $row['Item_id'];
                        }
                        ?>
                    </h1>
                </div>
            </a>
        <?php } ?>
    <?php } ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</html>

<?php
$conn->close();
?>
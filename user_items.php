<?php
session_start();
include("connect.php");

if (!isset($_SESSION["User_id"]) || !isset($_SESSION["Email"])) {
    header("Location: /cpsc-449-project/index.php");
    exit();
}

$user_id = $_SESSION["User_id"];
$user_email = $_SESSION["Email"];

$sql_fetch_user_items = "select * from Item where User_id='$user_id';";

$items = $conn->query($sql_fetch_user_items);

$sql_fetch_notifications = "select count(*) from notification where Recipient_email = '$user_email';";
$notifications = $conn->query($sql_fetch_notifications);

$row = $notifications->fetch_assoc();
$count = $row['count(*)'];
?>

<!doctype html>
<html lang="en" class="h-100" data-bs-theme="dark">

<head>
    <title>View Items</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<nav class="navbar bg-body-tertiary">
    <a class="navbar-brand ms-2" href="#">L&F</a>

    <ul class="navbar-nav me-auto flex-row d-flex">
        <li class="nav-item me-2">
            <a class="nav-link active" href="user_items.php">Your Items</a>
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
                <a class='nav-link' href='view_conversations.php'>Inbox*</a>
            </li>
            ");
        } else {
            echo ("
            <li class='nav-item me-2'>
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
    <h1 class="display-2 text-center mb-4">The Lost & Found</h1>

    <?php while ($row = $items->fetch_assoc()) {
    ?>
        <div class="border-bottom border-top">
            <h1 class="display-4 text-center mb-4"><?php echo $row['Title']; ?></h1>

            <div class="d-flex justify-content-evenly text-center text-break">
                <div class="w-25 d-flex align-items-center flex-column justify-content-center ms-4">
                    <img src="<?php echo $row['Img']; ?>" class="img-thumbnail mb-2 mt-2 rounded">
                </div>

                <div class="w-75 d-flex flex-column">
                    <div class="d-flex justify-content-evenly w-100">
                        <div class="w-100">
                            <b class="text-decoration-underline">Location Lost/Found</b><br>
                            <p><?php echo $row['Location']; ?></p>
                        </div>

                        <div class="w-100">
                            <b class="text-decoration-underline">Type</b><br>
                            <p><?php echo $row['Type']; ?></p>
                        </div>

                        <div class="w-100">
                            <b class="text-decoration-underline">Date Lost/Found</b><br>
                            <p><?php echo $row['Date']; ?></p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-evenly w-100 mt-2 mb-2">
                        <div class="w-100">
                            <b class="text-decoration-underline">Category</b><br>
                            <p><?php echo $row['Category']; ?></p>
                        </div>

                        <div class="w-100">
                            <b class="text-decoration-underline">Status</b><br>
                            <p><?php echo $row['Status']; ?></p>
                        </div>

                        <div class="w-100">
                            <b class="text-decoration-underline">Item#</b><br>
                            <p><?php echo $row['Item_id']; ?></p>
                        </div>
                    </div>

                    <div class="w-100 mt-4">
                        <b class="text-decoration-underline">Description</b><br>
                        <p><?php echo $row['Description']; ?></p>
                    </div>
                </div>
            </div>
            <?php
            echo ("
            <div class='d-flex justify-content-end me-2 mb-2'>
                <a href='delete_item.php?item_id=" . $row['Item_id'] . "'>
                    <button class='btn btn-danger' type='button'>Delete</button>
                </a>
            </div>");
            ?>
        </div>
    <?php } ?>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</html>

<?php
$conn->close();
?>
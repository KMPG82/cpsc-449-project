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

$sql_fetch_item = "select * from item where Item_id=$item_id;";

$item_row = $conn->query($sql_fetch_item);
$item = $item_row->fetch_assoc();

$sql_fetch_notifications = "select count(*) from notification where Recipient_email = '$user_email';";
$notifications = $conn->query($sql_fetch_notifications);

$row = $notifications->fetch_assoc();
$count = $row['count(*)'];
?>

<!doctype html>
<html lang="en" class="h-100" data-bs-theme="dark">

<head>
    <title>Edit Item</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
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
                <a class="nav-link active" href="item_submission.php">Create Item</a>
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

    <h1 class="display-2 text-center mb-4">Edit Item</h1>
    <div class="container">
        <form method="post" action="./update_item.php?item_id=<?php echo $item_id; ?>" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $item['Title']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select class="form-select" id="type" name="type" ?>" required>
                    <?php
                    if ($item['Type'] == 'Lost') {
                        echo ("
                        <option value='Lost' selected>Lost</option>
                        <option value='Found'>Found</option>
                        ");
                    } else {
                        echo ("
                        <option value='Lost'>Lost</option>
                        <option value='Found' selected>Found</option>
                        ");
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" id="category" name="category" value="<?php echo $item['Category']; ?>" required>
                    <?php
                    if ($item['Category'] == 'Electronics') {
                        echo ("
                        <option value='Electronics' selected>Electronics</option>
                        <option value='Clothing'>Clothing</option>
                        <option value='Jewelry'>Jewelry</option>
                        <option value='Books'>Books</option>
                        <option value='Bags'>Bags</option>
                        <option value='Wallets'>Wallets</option>
                        <option value='Other'>Other</option>
                        ");
                    } else if ($item['Category'] == 'Clothing') {
                        echo ("
                        <option value='Electronics'>Electronics</option>
                        <option value='Clothing' selected>Clothing</option>
                        <option value='Jewelry'>Jewelry</option>
                        <option value='Books'>Books</option>
                        <option value='Bags'>Bags</option>
                        <option value='Wallets'>Wallets</option>
                        <option value='Other'>Other</option>
                        ");
                    } else if ($item['Category'] == 'Jewelry') {
                        echo ("
                        <option value='Electronics'>Electronics</option>
                        <option value='Clothing'>Clothing</option>
                        <option value='Jewelry' selected>Jewelry</option>
                        <option value='Books'>Books</option>
                        <option value='Bags'>Bags</option>
                        <option value='Wallets'>Wallets</option>
                        <option value='Other'>Other</option>
                        ");
                    } else if ($item['Category'] == 'Books') {
                        echo ("
                        <option value='Electronics'>Electronics</option>
                        <option value='Clothing'>Clothing</option>
                        <option value='Jewelry'>Jewelry</option>
                        <option value='Books' selected>Books</option>
                        <option value='Bags'>Bags</option>
                        <option value='Wallets'>Wallets</option>
                        <option value='Other'>Other</option>
                        ");
                    } else if ($item['Category'] == 'Bags') {
                        echo ("
                        <option value='Electronics'>Electronics</option>
                        <option value='Clothing'>Clothing</option>
                        <option value='Jewelry'>Jewelry</option>
                        <option value='Books'>Books</option>
                        <option value='Bags' selected>Bags</option>
                        <option value='Wallets'>Wallets</option>
                        <option value='Other'>Other</option>
                        ");
                    } else if ($item['Category'] == 'Wallets') {
                        echo ("
                        <option value='Electronics'>Electronics</option>
                        <option value='Clothing'>Clothing</option>
                        <option value='Jewelry'>Jewelry</option>
                        <option value='Books'>Books</option>
                        <option value='Bags'>Bags</option>
                        <option value='Wallets' selected>Wallets</option>
                        <option value='Other'>Other</option>
                        ");
                    } else {
                        echo ("
                        <option value='Electronics'>Electronics</option>
                        <option value='Clothing'>Clothing</option>
                        <option value='Jewelry'>Jewelry</option>
                        <option value='Books' selected>Books</option>
                        <option value='Bags'>Bags</option>
                        <option value='Wallets'>Wallets</option>
                        <option value='Other' selected>Other</option>
                        ");
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" value="<?php echo $item['Location']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="<?php echo $item['Date']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $item['Description']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</html>

<?php
$conn->close();
?>
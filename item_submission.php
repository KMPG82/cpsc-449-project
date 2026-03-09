<?php
session_start();
include("connect.php");

$user_email = $_SESSION["Email"];
$user_id = $_SESSION["User_id"];

$sql = "
select Item.*, User.Email 
from Item 
join User 
on Item.User_id = User.User_id 
where Item.Status='Unresolved';
";

$items = $conn->query($sql);
?>

<!doctype html>
<html lang="en" class="h-100" data-bs-theme="dark">
    <head>
        <title>Item Submission</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>
    
    <nav class="navbar bg-body-tertiary">
            <a class="navbar-brand ms-2" href="#">L&F</a>
            
                <ul class="navbar-nav me-auto flex-row d-flex">
                    <li class="nav-item me-2">
                        <a class="nav-link active" href="user_items.php">Your Items</a>
                    </li>
                    
                    <li class="nav-item me-2">
                        <a class="nav-link" href="view_conversations.php">Inbox</a>
                    </li>
                    
                    <li class="nav-item me-2">
                        <a class="nav-link" href="view_items.php">All Items</a>
                    </li>

                    <li class="nav-item me-2">
                        <a class="nav-link" href="lost_items.php">Lost Items</a>
                    </li>

                    <li class="nav-item me-2">
                        <a class="nav-link" href="found_items.php">Found Items</a>
                    </li>
                </ul>

            <a href="logout.php">
                <button class="btn btn-danger me-2" type="button">Logout</button>
            </a>
    </nav>

    <body> 
        <h1 class="display-2 text-center mb-4">Item Submission</h1>
 
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>

<?php
$conn->close();
?>
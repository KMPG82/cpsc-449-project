<?php
session_start();
include("connect.php");

$user_email = "user1@email.com";
$recipient = $_GET['Recipient'];
$item_id = $_GET['Item_id'];
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
                        <a class="nav-link active" href="http://localhost/cpsc-449-project/view_conversations.php">Inbox</a>
                    </li>

                    <li class="nav-item me-2">
                        <a class="nav-link" href="http://localhost/cpsc-449-project/view_items.php">View Items</a>
                    </li>
                </ul>

            <a href="http://localhost/cpsc-449-project/logout.php">
                <button class="btn btn-danger me-2" type="button">Logout</button>
            </a>
    </nav>

    <body> 
        <form action="http://localhost/cpsc-449-project/send_message.php?Recipient=<?php echo $recipient; ?>&Item_id=<?php echo $item_id; ?>" method='post' class="h-50">
            <h1 class="mb-2 ms-2"><?php echo 'Sending message to '.$recipient.' about item#'.$item_id; ?></h1>
            
            <textarea required class="form-control w-75 ms-2" rows="5" name="message" placeholder="Type your message here..."></textarea>
            
            <button type="submit" name="send" class="btn btn-primary btn-lg ms-2 mt-2">Send Message</button>
        </form>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>
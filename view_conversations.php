<?php
session_start();
include("connect.php");

$user_email = "email2@email.com";

$sql = "select * from message where Recipient_email='$user_email' group by Sender_email DESC;";

$recieved_messages = $conn->query($sql);
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
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="nav-link active" href="#">Inbox</a>
                    </li>
                </ul>

            <a href="http://localhost/cpsc-449-project/logout.php">
                <button class="btn btn-danger me-2" type="button">Logout</button>
            </a>
    </nav>

    <body class=""> 
        <h1 class="display-2 text-center">Inbox</h1>

        <?php while($row = $recieved_messages->fetch_assoc()) {
            ?>
            <a href="http://localhost/cpsc-449-project/view_messages.php?Sender_email=<?php echo $row['Sender_email']; ?>" class="link-underline link-underline-opacity-0 link-body-emphasis">
                <div class="d-flex flex-column border-bottom border-top">
                    <p class="fw-bold ms-2 mt-2"><?php echo 'From: ' . $row['Sender_email']; ?></p>

                    <p class="ms-2">
                        <?php echo $row['Content']; ?>           
                    </p>     
                </div>
            </a>
            
        <?php } ?>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>
<?php

$conn->close();
?>
<?php
session_start();
include("connect.php");

$user_email = $_SESSION["Email"];

$sql = "
select *
from message
where Sender_email='$user_email' or Recipient_email='$user_email'
group by Item_id,
case
    when Sender_email='$user_email' then Recipient_email
    else Sender_email
end
order by Inserted_at DESC;
";

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
                        <a class="nav-link active" href="#">Inbox</a>
                    </li>

                    <li class="nav-item me-2">
                        <a class="nav-link" href="view_items.php">View Items</a>
                    </li>
                </ul>

            <a href="logout.php">
                <button class="btn btn-danger me-2" type="button">Logout</button>
            </a>
    </nav>

    <body class=""> 
        <h1 class="display-2 text-center">Inbox</h1>

        <?php while($row = $recieved_messages->fetch_assoc()) {
            ?>
            <?php if($row['Sender_email'] == $user_email) {
                ?>
                <a href="view_messages.php?Other_user=<?php echo $row['Recipient_email']; ?>&Item_id=<?php echo $row['Item_id']; ?>" class="link-underline link-underline-opacity-0 link-body-emphasis">
                    <div class="d-flex flex-column border-bottom border-top p-4">
                        <h1 class="ms-2 mt-2 mb-2">
                            <?php echo 'Conversation with '.$row['Recipient_email'].' for item#'.$row['Item_id']; ?>
                        </h1>
                    </div>
                </a>
                <?php } else { ?> 
                <a href="view_messages.php?Other_user=<?php echo $row['Sender_email']; ?>&Item_id=<?php echo $row['Item_id']; ?>" class="link-underline link-underline-opacity-0 link-body-emphasis">
                    <div class="d-flex flex-column border-bottom border-top p-4">
                        <h1 class="ms-2 mt-2 mb-2">
                            <?php echo 'Conversation with '.$row['Sender_email'].' for item#'.$row['Item_id']; ?>
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
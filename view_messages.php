<?php
session_start();
include("connect.php");

if (!isset($_SESSION["User_id"]) || !isset($_SESSION["Email"])) {
    header("Location: /cpsc-449-project/index.php");
    exit();
}

$user_email = $_SESSION["Email"];
$other_user = $_GET['Other_user'];
$item_id = $_GET['Item_id'];

$sql = "select * from message 
where (Recipient_email='$user_email' and Sender_email='$other_user' and Item_id=$item_id) or (Sender_email='$user_email' and Recipient_email='$other_user' and Item_id=$item_id) 
order by Inserted_at ASC;";

$recieved_messages = $conn->query($sql);
?>

<!doctype html>
<html lang="en" class="h-100" data-bs-theme="dark">
    <head>
        <title>Messages</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>
    
    <nav class="navbar bg-body-tertiary">
            <a class="navbar-brand ms-2" href="#">L&F</a>
            
            <ul class="navbar-nav me-auto flex-row d-flex">
                <li class="nav-item me-2">
                    <a class="nav-link" href="user_items.php">Your Items</a>
                </li>

                <li class="nav-item me-2">
                    <a class="nav-link active" href="view_conversations.php">Inbox</a>
                </li>

                <li class="nav-item me-2">
                    <a class="nav-link" href="view_items.php">View Items</a>
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
            </ul>

            <a href="logout.php">
                <button class="btn btn-danger me-2" type="button">Logout</button>
            </a>
    </nav>

    <body> 
        <h1 class="text-center">
            <?php echo 'Conversation with '.$other_user.' for item#'.$item_id; ?>
        </h1>

        <div class="w-100 d-flex justify-content-end">
            <?php echo ("<a href='create_message.php?Recipient=".$other_user."&Item_id=".$item_id."'><button type='button' class='btn btn-info mb-2 me-2'>Reply</button></a>"); ?>
        </div>

        <?php while($row = $recieved_messages->fetch_assoc()) {
            ?>
            <div class="d-flex flex-column">
                <?php if($row['Sender_email'] == $user_email) {
                    ?>
                    <div class="card w-25 ms-auto mb-2 me-2">
                        <div class="card-body text-break">
                            <?php echo $row['Content']; ?>
                        </div>
                    </div>
                <?php } else { ?> 
    
                    <div class="card w-25 ms-2 mb-2">
                        <div class="card-body text-break">
                            <?php echo $row['Content']; ?>
                        </div>

                    </div> 
                <?php } ?>     
            </div>
        <?php } ?>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>

<?php
$conn->close();
?>
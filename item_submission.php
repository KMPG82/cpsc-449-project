<?php
session_start();
include("connect.php");
if (!isset($_SESSION["User_id"]) || !isset($_SESSION["Email"])) {
    header("Location: /cpsc-449-project/index.php");
    exit();
}
$user_id = $_SESSION["User_id"];
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $type = $_POST["type"];
    $category = $_POST["category"];
    $location = $_POST["location"];
    $date = $_POST["date"];
    $description = $_POST["description"];
    $image_name = $_FILES["image"]["name"];
    $image_tmp_name = $_FILES["image"]["tmp_name"];
    $target = "./images/" . $image_name;
        if (move_uploaded_file($image_tmp_name, $target)) {
            $status = "Unresolved";
            $sql = "INSERT INTO ITEM 
                    (Inserted_at, Location, Description, Title, Type, Category, Status, Date, Img, User_id)
                    VALUES
                    (CURRENT_TIMESTAMP, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param(
                "ssssssssi",
                $location,
                $description,
                $title,
                $type,
                $category,
                $status,
                $date,
                $target,
                $user_id
            );
            if ($stmt->execute()) {
                $message = "Item submitted successfully!";
            } else {
                $message = "Failed to save item.";
            }
    } else {
        $message = "Failed to upload image.";
        }
}
?>

<!doctype html>
<html lang="en" class="h-100" data-bs-theme="dark">
    <head>
        <title>List Lost/Found Item</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    </head>

    <body> 
        <nav class="navbar bg-body-tertiary">
            <a class="navbar-brand ms-2" href="#">L&F</a>
            
                <ul class="navbar-nav me-auto flex-row d-flex">
                    <li class="nav-item me-2">
                        <a class="nav-link" href="user_items.php">Your Items</a>
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
                    <li class="nav-item me-2">
                        <a class="nav-link active" href="item_submission.php">Create Item</a>
                    </li>
                </ul>

            <a href="logout.php">
                <button class="btn btn-danger me-2" type="button">Logout</button>
            </a>
        </nav>

        <h1 class="display-2 text-center mb-4">Item Submission</h1>
        <?php if ($message): ?>
            <div class="alert alert-info text-center" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
            <div class="container">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                            <select class="form-select" id="type" name="type" required>
                                <option value="Lost">Lost</option>
                                <option value="Found">Found</option>
                            </select>                
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="category" name="category" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>                </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit Item</button>
                </form>
            </div>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>

<?php
$conn->close();
?>
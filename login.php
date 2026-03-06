<?php
session_start();
include("connect.php");

if (isset($_POST["submit"])) {

    // This'll get the email and password that the user typed
    $email = $_POST["email"];
    $password = $_POST["password"];

    // This'll checks if there is a user with the same email and password
    // Keeping it simple for now, might change later
    $sql = "SELECT * FROM USER WHERE Email = '$email' AND Password = '$password'";
    $result = mysqli_query($conn, $sql);

    // Turn the result into a row we can use
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if ($row) {
        // This'll save user info into session, so the app knows this user is logged in
        $_SESSION["Email"] = $row["Email"];
        $_SESSION["Password"] = $row["Password"];
        $_SESSION["UserID"] = $row["User_id"];

        header("Location: view_items.php");
        exit();
    } else {
        echo '
        <script>
            window.location.href="index.php";
            alert("Login failed. Invalid email or password.");
        </script>
        ';
    }
}

$conn->close();
?>
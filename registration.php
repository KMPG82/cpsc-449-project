<?php
include("connect.php");

if (isset($_POST["submit"])) {

    // It'll grab what the user typed into the form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Firstly, check if this email already exists
    $checkSql = "SELECT * FROM USER WHERE Email = '$email'";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        echo '
        <script>
            window.location.href="registration.php";
            alert("This email is already registered.");
        </script>
        ';
    } else {
        // It'll insert the new user into the database
        // It'll inserted_at uses current_timestamp(), so we do not need to type the time ourselves
        $sql = "INSERT INTO USER (Inserted_at, Email, Password) VALUES (current_timestamp(), '$email', '$password')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo '
            <script>
                window.location.href="index.php";
                alert("Registration successful. Log in now.");
            </script>
            ';
        } else {
            echo '
            <script>
                window.location.href="registration.php";
                alert("Registration failed.");
            </script>
            ';
        }
    }
}

$conn->close();
?>

<!doctype html>
<html lang="en" class="h-100" data-bs-theme="dark">
  <head>
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>

  <body class="text-center h-100 d-flex justify-content-center">
    <div class="container justify-content-center d-flex flex-column align-items-center">
      <img class="img-fluid w-25 rounded-circle mb-2" src="https://media.istockphoto.com/id/1730149969/vector/lost-items-icon-lost-and-found.jpg?s=612x612&w=0&k=20&c=yt1AzDWvu1LDAwOok1tIJOcHQsaRYnAS4flWuTB4nk0=" alt="">

      <form class="w-25" method="POST" action="registration.php">
        <h1 class="h3 mb-3 font-weight-normal">Registration</h1>
            
        <label>Email address</label>
        <input type="email" name="email" class="form-control mb-1" placeholder="Email address" required>

        <label>Password</label>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      
        <button class="btn btn-lg btn-primary btn-block mt-2" type="submit" name="submit">Register</button>

        <a href="index.php">
          <p class="mt-1">Already have an account?</p>
        </a>      
      </form>    
    </div>
    
  </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>
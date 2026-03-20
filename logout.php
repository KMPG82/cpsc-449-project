<?php
session_start();

// This'll clear the session
session_unset();
session_destroy();

// This'll send the user back to the login page
header("Location: index.php");
exit();

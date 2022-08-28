<?php
session_start();

session_unset();
session_destroy();

if (!isset($_SESSION['username'])) {
    echo "You successfully logged-out";
    header("Refresh:3; url=sign-in.php");
}


// echo "<div class='container bg-success mx-auto text-center text-white lead'>You are successfully Logged-out</div>";
// echo "<br>";
// echo "<a href='sign-in.php'>Sign-in Again Here</a>";

//header("refresh:3;location:sign-in.php");
//header("location: sign-in.php");
exit;
?>
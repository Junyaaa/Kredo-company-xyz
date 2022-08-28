<?php
    session_start();

    require_once 'connection.php'; // we will always have this connection.php file

    function login($user_name, $user_pass){
        $conn = db_connect();
        //$hash = password_hash($user_pass, PASSWORD_DEFAULT);


        $sql = "SELECT * FROM users WHERE username='$user_name'"; //query string
        if ($result = $conn->query($sql)) { //bultin query() function
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc(); //will get our database table rows and assigned to variable $rows
                if (password_verify($user_pass, $row['password'])) {
                    $_SESSION['username'] = $row['username']; //this will return the name of the user
                    header("location:add-item.php"); //redirect the user to add-item.php page
                    exit;
                }else {
                    echo "Incorrect password";
                }
            }else {
                echo "Username not found.";
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-in</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<?php include 'nav-bar.php'; ?>
    <div class="my-animation" style="position: absolute; left: 700px"></div>
<br>
    <div class="container W-25 mt-5">
                    
                <form action="" method="post" class="w-50" style="margin: 0 auto;" autocomplete="off">
                    <h2 class="text-center fw-light mb-5">Please sign-in</h2>
                        <div class="form-floating mb-3">
                            <input type="text" name="user_name" id="user-name" class="fs-1 p-4 text-center fw-5 form-control" placeholder="Enter Username" autofocus required>
                            <label for="user-name" class="form-label">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" id="password" class="fs-1 p-4 text-center form-control" placeholder="Enter Password" required>
                            <label for="password" class="form-label">Password</label>
                        </div>
                    <input type="submit" name="btn_signin" value="Login" class="fs-1 btn btn-success form-control">

                    <?php
                        if (isset($_POST['btn_signin'])) {
                            $user_name = $_POST['user_name'];
                            $user_pass = $_POST['password'];

                            login($user_name, $user_pass);
                        }
                    ?>
                    
                </form>
                <div class="text-center mt-3">
                    <p class="text-center mt-3">No Account Yet?</p>
                  <a href="signup.php" class="small">Create Account</a>
               </div>
    </div>

        
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
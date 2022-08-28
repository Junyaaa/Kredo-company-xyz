<?php
    require_once 'connection.php';

    function addUser($user_name, $user_pass){
        $conn = db_connect();


        $sql = "INSERT INTO users(username, password) VALUES('$user_name', '$user_pass')"; //query string

        $sqlResult = $conn->query($sql); //builtin query() function
        if ($sqlResult) {
            echo "<div class='bg-light h4 text-center text-success mt-4'>Successfully Register</div>";
            echo "<div class='bg-light h4 text-center text-success mt-4'>
                    <a class='btn btn-success form-control' href='sign-in.php' role='button'>Login Now To Proceed</a>
                  </div>";
        }else {
            echo "<div class='h4 text-center text-danger mt-4'>Error Unable to register new accounts</div>";
        }
    }

?>
    

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
   
<?php include 'nav-bar.php'; ?>
    <div class="my-animation" style="position: absolute; left: 700px"></div>
<br>
    <div class="container W-25 mt-5">
                <form action="" method="post" class="w-50" style="margin: 0 auto;" autocomplete="off">
                    <h2 class="text-center fw-light mb-5">Please register</h2>
                    
                        <div class="form-floating mb-3">
                            <input type="text" name="user_name" id="user-name" class="fs-1 p-4 text-center fw-5 form-control" placeholder="Enter Username" autofocus required>
                            <label for="user-name" class="form-label">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" id="password" class="fs-1 p-4 text-center form-control" placeholder="Enter Password" required>
                            <label for="password" class="form-label">Password</label>
                        </div>
                    <input type="submit" name="btn_signup" value="Signup" class="fs-1 btn btn-success form-control">

                    <div class="text-center mt-3">
                        <p class="small">Already have an account? <a href="sign-in.php">Log in</a></p>
                    </div>

                    <?php
                        if (isset($_POST['btn_signup'])) {
                            $user_name = $_POST['user_name'];
                            $user_pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

                            addUser($user_name, $user_pass);
                        }
                    ?>
                    
                </form>
                
    </div>

        
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
<?php
    session_start();
    require_once 'connection.php';

    function addItem($item_name, $item_price, $item_qty){
        $conn = db_connect();
        $sqlInsertItem = "INSERT INTO items(item_name, item_price, quantity) VALUES('$item_name', '$item_price', '$item_qty')";
        
        if ($sqlResult = $conn->query($sqlInsertItem)) {
            echo "<div class='bg-light h4 text-center text-success mt-4'>New Item Added Successfully</div>";
        }else {
            echo "<div class='h4 text-center text-danger mt-4'>Error Adding Item</div>";
        }
    }
    
    function getAllItems(){
        $conn = db_connect();

        $getItems = "SELECT * FROM items";
        if ($allItems = $conn->query($getItems)) {
            return $allItems;
        }else {
            die("There is an error retrieving all items ". $conn->error);
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid bg-success text-white">
    <div class="row">
        <div class="col">
            <h2 class="display-5 text-start">Company XYZ</h2>
        </div>
        <div class="col">
            <h2 class="display-5 text-end">Welcome, <?php echo $_SESSION['username'];?> <a class="text-decoration-none text-white" href="logout.php"> Logout <i class="fa-solid fa-right-from-bracket"></i></a> </h2>
        </div>    
    </div>
</div>
    <div class="container bg-light mt-5 w-50 p-2 mb-2">
        <form action="" method="post" class="mx-auto mt-5 w-50">
            <p class="text-center lead">Add Items To The Database</p>
            <label for="item-name" class="form-label">Item Name</label>
            <input type="text" name="item_name" id="item-name" class="form-control mb-2">
            <label for="item-price" class="form-label">Item Price</label>
            <input type="number" name="item_price" id="item-price" class="form-control mb-2">
            <label for="item-quantity" class="form-label">Item Quantity</label>
            <input type="number" name="item_quantity" id="item-quantity" class="form-control mb-2"><br>
            <input type="submit" name="btn_add_item" value="Add Item" class="bg-success form-control text-white mb-2">
        </form>
        <?php
            if (isset($_POST['btn_add_item'])) {
                $item_name = $_POST['item_name'];
                $item_price = $_POST['item_price'];
                $item_qty = $_POST['item_quantity'];

                addItem($item_name, $item_price, $item_qty);
            }
        ?>
    </div>
    <div class="container bg-light mt-2 w-50 p-2 mb-2">
            <table class="table table-hover">
                <thead class="bg-dark text-white">
                    <th style="width: 25%">Id</th>
                    <th style="width: 25%">Name</th>
                    <th style="width: 25%">Price</th>
                    <th style="width: 25%">Quantity</th>
                    <th></th>
                    <th></th>
                </thead>
                <tbody>
                    <?php
                        $getAllLists = getAllItems();
                        while ($row_items = $getAllLists->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?= $row_items['id'] ?></td>
                            <td><?= $row_items['item_name'] ?></td>
                            <td><?= $row_items['item_price'] ?></td>
                            <td><?= $row_items['quantity'] ?></td>
                            <td><a href="edit-item.php?get_id=<?= $row_items['id'] ?>" class="btn btn-warning">Edit</a></td>
                            <td><a href="delete-item.php?get_id=<?= $row_items['id'] ?>" class="btn btn-danger">Delete</a></td>
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
    </div>
    


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
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
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
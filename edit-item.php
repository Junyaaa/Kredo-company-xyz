<?php
    session_start();
    require_once 'connection.php';

    $item_ID = $_GET['get_id'];
   
    $item_row = getAllItems($item_ID);
    
    function getAllItems($item_ID){
        $conn = db_connect();
        
        $getItems = "SELECT * FROM items WHERE id='$item_ID'";
        if ($allItems = $conn->query($getItems)) {
            return $rows = $allItems->fetch_assoc();
            //while ($rows = $allItems->fetch_assoc()) {
                // $item_id = $rows['id'];
                // $item_name = $rows['item_name'];
                // $item_price = $rows['item_price'];
                // $item_quantity = $rows['quantity'];
            //}
        }else {
            die("There is an error retrieving all items ". $conn->error);
        }
    }

    
    
    function updateItem($item_name, $item_price, $item_qty, $item_ID){
        $conn = db_connect();

        $editItems = "UPDATE items SET item_name = '$item_name', item_price = '$item_price', quantity = '$item_qty' WHERE id= '$item_ID'";
        if ($editAllItems = $conn->query($editItems)) {
            echo "<div class='text-center'>Item Update Successful</div>";
            header("location:add-item.php");
        }else {
            die("There is an error updating item details ". $conn->error);
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
<?php include 'nav-bar.php'; ?>
    <div class="container bg-light mt-5 w-50 p-2 mb-2">
        <form action="" method="post" class="mx-auto mt-5 w-50">
            <p class="text-center lead">Edit Item Details Below</p>
            <input type="number" name="item_id" id="item-id" class="form-control" value="<?php echo $item_row['id'];?>" hidden>
            <label for="item-name" class="form-label">Item Name</label>
            <input type="text" name="item_name" id="item-name" class="form-control mb-2" value="<?php echo $item_row['item_name'];?>">
            <label for="item-price" class="form-label">Item Price</label>
            <input type="number" name="item_price" id="item-price" class="form-control mb-2" value="<?php echo $item_row['item_price'];?>">
            <label for="item-quantity" class="form-label">Item Quantity</label>
            <input type="number" name="item_quantity" id="item-quantity" class="form-control mb-2" value="<?php echo $item_row['quantity'];?>"><br>
            <input type="submit" name="btn_edit_item" value="Edit" class="bg-success form-control text-white mb-2">
        </form>
        <?php
            if (isset($_POST['btn_edit_item'])) {
                //$item_id = $_POST['item_id'];
                $item_name = $_POST['item_name'];
                $item_price = $_POST['item_price'];
                $item_quantity = $_POST['item_quantity'];

                updateItem($item_name, $item_price, $item_quantity, $item_ID);

            }
        ?>
    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
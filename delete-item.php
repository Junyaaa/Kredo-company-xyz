<?php
    session_start();
    require_once 'connection.php';

    $item_ID = $_GET['get_id'];
    deleteItem($item_ID);

    function deleteItem($item_ID){
        $conn = db_connect();
        $sqlDelete = "DELETE FROM items WHERE id='$item_ID'";
        if ($conn->query($sqlDelete)) {
            header("location:add-item.php");
        }else {
            echo "Unable to delete item.";
        }
    }


?>
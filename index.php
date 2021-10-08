<?php

require "php/connection.php";

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    $removeSQL = "DELETE FROM product_list WHERE product_id = '$remove_id'";
    if (mysqli_query($conn, $removeSQL)) {
        $msg = "Product removed";
        header("refresh: 1, url=./");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/all.css">
    <title>Products List</title>1
</head>

<body>
    <h1>Product List</h1>
    <table border="1">
        <tr>
            <td>
                <button onclick="window.location.href='pages/products_menu.php'">Products Menu</button>
            </td>
            <td>
                <button onclick="window.location.href='pages/mycart.php'">My Cart</button>
            </td>
            <br>
            <br>
        </tr>
        <tr>
            <th>No.</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php
        $getList = "SELECT* FROM product_list";
        $getQuery = mysqli_query($conn, $getList);
        if (mysqli_num_rows($getQuery) > 0) {
            while ($gotList = mysqli_fetch_assoc($getQuery)) {
                $product_id = $gotList['product_id'];
                $product_name = $gotList['product_name'];
                $product_price = $gotList['product_price'];
        ?>
                <tr>
                    <td><?php echo $product_id; ?></td>
                    <td><?php echo $product_name; ?></td>
                    <td><?php echo $product_price; ?></td>
                    <td id="actions">
                        <a href="./?edit=<?php echo $product_id; ?>">
                            <button>Edit</button>
                        </a>
                        <a href="./?remove=<?php echo $product_id; ?>">
                            <button>Remove</button>
                        </a>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
        <tr>
            <td>
                <button onclick="window.location.href='pages/add.php'">Add New</button>
            </td>
            <td colspan="3">
                <?php if (isset($msg)) : echo ($msg);
                    unset($msg);
                endif ?>
            </td>
        </tr>

    </table>
</body>

</html>
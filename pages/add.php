<?php

require "../php/connection.php";
$productName = $productPrice = $msg = "";
if (isset($_POST['addProduct'])) {
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $add_sql = "INSERT INTO product_list(product_name,product_price) VALUES('$productName','$productPrice')";
    if (mysqli_query($conn, $add_sql)) {
        $msg = "Product " . $productName . " has been added.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/all.css">
    <title>Add Product</title>
</head>

<body>
    <h1>Add Product</h1>
    <table>
        <tr>
            <td>
                <button onclick="window.location.href='products_menu.php'">Product Menu</button>
            </td>
            <td>
                <button onclick="window.location.href='../'">Product List</button>
            </td>
            <td>
                <button onclick="window.location.href='mycart.php'">My Cart</button>
            </td>
            <br>
            <br>
        </tr>
        <form method="POST">
            <tr>
                <td>
                    <label for="productName">Product Name</label>
                </td>
                <td>
                    <input type="text" name="productName" id="productName">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="productPrice">Product Price</label>
                </td>
                <td>
                    <input type="price" name="productPrice" id="productPrice">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Add Product" name="addProduct">
                </td>
            </tr>
            <br>
            <br>
            <tr>
                <td colspan="3">
                    <?php if (isset($msg)) : echo $msg;
                        unset($msg);
                    endif ?>
                </td>
            </tr>
        </form>
    </table>
</body>

</html>
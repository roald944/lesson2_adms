<?php

require "../php/connection.php";
$productName = $productPrice = $msg = "";
$productID = $_GET['edit'];

if (isset($_POST['editProduct'])) {
    $productID = $_GET['edit'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $edit_sql = "UPDATE product_list SET product_name = '$productName', product_price = '$productPrice' WHERE product_id = '$productID'";
    if (mysqli_query($conn, $edit_sql)) {
        $msg = "Product " . $productName . " has been updated.";
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
    <h1>Edit Product</h1>
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
                    <label for="">Product Id</label>
                </td>
                <td>
                    <input type="text" name="" id="" readonly value="<?php echo $_GET['edit']; ?>">
                </td>
            </tr>
            <?php
            $getProduct = "SELECT * FROM product_list WHERE product_id = '$productID'";
            $queryProduct = mysqli_query($conn, $getProduct);
            while ($gotProduct = mysqli_fetch_assoc($queryProduct)) {
                $pname = $gotProduct['product_name'];
                $pprice = $gotProduct['product_price'];
            ?>
                <tr>
                    <td>
                        <label for="productName">Product Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" id="productName" value="<?php echo $pname; ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="productPrice">Product Price</label>
                    </td>
                    <td>
                        <input type="number" name="productPrice" id="productPrice" value="<?php echo $pprice; ?>">
                    </td>
                </tr>
            <?php
            }
            ?>

            <tr>
                <td></td>
                <td>
                    <input type="submit" value="Update" name="editProduct">
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
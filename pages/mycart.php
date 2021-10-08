<?php require "../php/connection.php";

$msg = "";
if (isset($_GET['cid'])) {
    $cid = $_GET['cid'];
    $deletecart = "DELETE FROM cart WHERE products = '$cid'";
    if (mysqli_query($conn, $deletecart)) {
        $getProducts = "SELECT * FROM product_list WHERE product_id = '$cid'";
        $pQuery = mysqli_query($conn, $getProducts);
        while ($gotproducts = mysqli_fetch_assoc($pQuery)) {
            $productName = $gotproducts['product_name'];
            $msg = "Product " . $productName . " has been removed from cart";
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
    <link rel="stylesheet" href="../styles/all.css">
    <title>My Cart</title>
</head>

<body>
    <h1>Products Menu</h1>
    <table border="1">
        <tr>
            <td><button onclick="window.location.href='../'">Product List</button></td>
            <td><button onclick="window.location.href='products_menu.php'">Products Menu</button></td>
        </tr>
        <br><br>
        <tr>
            <th>No.</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php
        $getFromCart = "SELECT * FROM cart";
        $cartQueryList = mysqli_query($conn, $getFromCart);
        if (mysqli_num_rows($cartQueryList) == 0) {
        ?>
            <tr>
                <td colspan="4">No Product Added</td>
            </tr>
            <?php
        } else {
            while ($gotFromCart = mysqli_fetch_assoc($cartQueryList)) {
                $cart_id = $gotFromCart['products'];
                $getFromList = "SELECT * FROM product_list WHERE product_id = '$cart_id'";
                $listQuery = mysqli_query($conn, $getFromList);
                while ($gotFromList = mysqli_fetch_assoc($listQuery)) {
                    $product_id = $cart_id;
                    $product_name = $gotFromList['product_name'];
                    $product_price = $gotFromList['product_price'];
            ?>
                    <tr>
                        <td><?php echo $product_id; ?></td>
                        <td><?php echo $product_name; ?></td>
                        <td><?php echo $product_price; ?></td>
                        <td id="actions">
                            <a href='mycart.php?cid=<?php echo $product_id; ?>'>
                                <button>Remove from cart</button>
                            </a>
                        </td>
                    </tr>
        <?php
                }
            }
        }
        ?>
        <tr>
            <td colspan="4">
                <?php if (isset($msg)) : echo ($msg);
                    unset($msg);
                endif; ?>
            </td>
        </tr>
    </table>
</body>

</html>
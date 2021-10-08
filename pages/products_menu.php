<?php
require "../php/connection.php";
$msg = "";
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $checkProduct = "SELECT * FROM cart WHERE products = '$pid'";
    $checkQ  = mysqli_query($conn, $checkProduct);
    if (mysqli_num_rows($checkQ) >= 1) {
        $msg = "Product Already Added";
    } else {
        $addToCart = "INSERT INTO cart(products) VALUES('$pid')";
        if (mysqli_query($conn, $addToCart)) {
            $getProduct = "SELECT * FROM product_list WHERE product_id = '$pid'";
            $pQuery = mysqli_query($conn, $getProduct);
            while ($gotproduct = mysqli_fetch_assoc($pQuery)) {
                $productName = $gotproduct['product_name'];
                $msg = "Product " . $productName . " has been added";
            }
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
    <title>Products Menu</title>
</head>

<body>
    <h1>Products Menu</h1>
    <!-- <form method="POST"> -->
    <table border="1">
        <tr>
            <td><button onclick="window.location.href='../'">Product List</button></td>
            <td><button onclick="window.location.href='mycart.php'">My Cart</button></td>
        </tr>
        <br><br>
        <tr>
            <th>No.</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
        <?php
        require "../php/connection.php";
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
                    <?php
                    $checkCart = "SELECT * FROM cart WHERE products = '$product_id'";
                    $cartQ = mysqli_query($conn, $checkCart);
                    if (mysqli_num_rows($cartQ) >= 1) {
                    ?>
                        <td id="actions">
                            <button onclick="window.location.href='mycart.php'">My Cart</button>
                        </td>
                    <?php
                    } else {
                    ?>
                        <td id="actions">
                            <a href='products_menu.php?pid=<?php echo $product_id; ?>'>
                                <button>Add To Cart</button>
                            </a>
                        </td>
                    <?php
                    }
                    ?>
                </tr>
        <?php
            }
        }
        ?>
        <tr>
            <td colspan="4">
                <?php if (isset($msg)) : echo $msg;
                    unset($msg);
                endif ?>
            </td>
        </tr>
    </table>
    <!-- </form> -->
</body>

</html>
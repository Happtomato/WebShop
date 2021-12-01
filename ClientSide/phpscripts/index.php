<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();

//manipulate the shopping cart

if(!empty($_GET["action"])) {


    switch($_GET["action"]) {

        //add a new item to the shopping cart
        case "add":
            if(!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery("SELECT * FROM inventory WHERE ItemCode='" . $_GET["code"] . "'");
                $itemArray = array($productByCode[0]["ItemCode"]=>array('name'=>$productByCode[0]["ItemName"], 'code'=>$productByCode[0]["ItemCode"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["ItemPrice"], 'image'=>$productByCode[0]["ItemImage"]));

                //look if any item is in the basket
                if(!empty($_SESSION["cart_item"])) {
                    //look if item already in the basket
                    if(in_array($productByCode[0]["ItemCode"],array_keys($_SESSION["cart_item"]))) {
                        //go through array
                        foreach($_SESSION["cart_item"] as $k => $v) {
                            //search for item
                            if($productByCode[0]["ItemCode"] == $k) {
                                //if empty set quantity 0
                                if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                //add to quantity
                                else{
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                }
                            }
                        }
                        //add a new item into the session
                    } else {
                        $_SESSION["cart_item"] = $_SESSION["cart_item"] + $itemArray;

                    }
                    //start a new session
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;
        //remove item from the shopping cart
        case "remove":
            if(!empty($_SESSION["cart_item"])) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                    if($_GET["code"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    if(empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        //remove session if the shopping cart is empty
        case "empty":
                unset($_SESSION["cart_item"]);
                break;

        case "checkout":
            header("Location: ../account.html");
            exit;
    }


}
?>


<HTML>
<HEAD>
    <TITLE>Simple PHP Shopping Cart</TITLE>
    <link href="phpStyle.css" type="text/css" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/stylesheet.css" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@300;400;600&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#navbarDropdown").click(function() {
                $(".dropdown-menu").toggle();
            })
        });
    </script>
    <style>
        html, body { overflow: visible !important; }
    </style>
</HEAD>
<BODY>

<header>
        <nav class="navbar navbar-expand-sm navbar-light bg-light">
            <a class="navbar-brand" href="/index.html">
                <img src="/Pictures/c. b..svg" width="30" height="30" alt="">
            </a>

            <div class="collapse navbar-collapse width">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item nav-item2 btn-hovereffect rounded-pill"><a class="nav-link" href="/index.html">Welcome</a></li>
                    <li class="nav-item nav-item2 btn-hovereffect rounded-pill active-btn"><a class="nav-link" href="/phpscripts/index.php">Shop</a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto icon-resize">
                    <li class="dropdown nav-item nav-item2" style="margin-top: 7px;">
                        <a href=""><img src="/Pictures/Icon awesome-shopping-basket.svg" alt="" style="max-width: 80%; max-height:80%"></a>
                    </li>
                    <li class="nav-item dropdown nav-item2" style="margin-top: 4px;">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <img src="/Pictures/Icon feather-menu.svg" alt="" style="max-width: 80%; max-height:80%">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/index.html">Welcome</a>
                            <a class="dropdown-item" href="/phpscripts/index.php">Shop</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

<main class="row" style="width: 100vw; height: 100vh;">
        
<div class="col-2" id="index-left-img">
            
</div>

<div class="col-8" id="">   <!-- Start of middle col -->
    <!-- Shopping Cart -->
<div id="shopping-cart">
    <div class="txt-heading">Shopping Cart</div>

    <a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>
    <?php
    if(isset($_SESSION["cart_item"])){
        $total_quantity = 0;
        $total_price = 0;
        ?>
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
            <tbody>
            <tr>
                <th style="text-align:left;">Name</th>
                <th style="text-align:left;">Code</th>
                <th style="text-align:right;" width="5%">Quantity</th>
                <th style="text-align:right;" width="10%">Unit Price</th>
                <th style="text-align:right;" width="10%">Price</th>
                <th style="text-align:center;" width="5%">Remove</th>
            </tr>
            <?php
            foreach ($_SESSION["cart_item"] as $item){
                $item_price = $item["quantity"]*$item["price"];
                ?>
                    <!-- List the item in the shopping cart -->
                <tr>
                    <td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
                    <td><?php echo $item["code"]; ?></td>
                    <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                    <td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
                    <td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
                    <!-- button remove item -->
                    <td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
                </tr>
                <?php
                $total_quantity += $item["quantity"];
                $total_price += ($item["price"]*$item["quantity"]);
            }
            ?>

            <tr>
                <!-- display the total amount -->
                <td colspan="2" align="right">Total:</td>
                <td align="right"><?php echo $total_quantity; ?></td>
                <td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
                <td></td>
            </tr>
            </tbody>
        </table>

        <a id="btnEmpty" href="index.php?action=checkout">Checkout</a>

        <?php
    } else {
        ?>
        <div class="no-records">Your Cart is Empty</div>
        <?php
    }
    ?>
</div>
<!-- List of Products -->

<div id="product-grid">
    <div class="txt-heading">Products</div>
    <?php
    $product_array = $db_handle->runQuery("SELECT * FROM inventory ORDER BY Item_ID ASC");
    if (!empty($product_array)) {
        foreach($product_array as $key=>$value){
            ?>
            <div class="product-item">
                <form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["ItemCode"]; ?>">
                    <!-- <div class="product-image"><img src="<?php echo $product_array[$key]["ItemImage"]; ?>"></div> -->
                    <div class="product-tile-footer">
                        <div class="product-title"><?php echo $product_array[$key]["ItemName"]; ?></div>
                        <div class="product-price"><?php echo $product_array[$key]["ItemPrice"]."fr"; ?></div>
                        <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
                    </div>
                </form>
            </div>
            <?php
        }
    }
    ?>
</div>
</div> <!-- End middle col -->

<div class="col-2" id="index-right-backimg">

</div>

</main>
</BODY>
</HTML>
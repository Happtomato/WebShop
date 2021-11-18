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
    }
}
?>


<HTML>
<HEAD>
    <TITLE>Simple PHP Shopping Cart</TITLE>
    <link href="phpStyle.css" type="text/css" rel="stylesheet" />
</HEAD>
<BODY>

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
        <?php
    } else {
        ?>
        <div class="no-records">Your Cart is Empty</div>
        <?php
    }
    ?>
</div>


<!-- List of Products -->


</BODY>
</HTML>
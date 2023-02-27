<?php get_header(); ?>

<link href="<?php echo get_template_directory_uri(); ?>/css/cart.css" rel="stylesheet" type="text/css">

<div class="container-fluid">
    <?php require_once("navbar.php"); ?>
    <div class="row">
        <div class="col-8">
            <div id="myDiv"></div>
        </div>
        <div class="col-4" style="text-align: center;">
            <h1>Totale</h1>
            <h4 id="total-price">0,00€</h4>
            <button class="btn btn-warning btn-buyall">Acquista Ora</button>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/cookies_utils.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/cookies.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/navutils.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/HItem.js"></script>
<script text="text/javascript">
    var cookieUserData = null;
    var products = null;

    $(document).ready(function () {
        $(".btn-buyall").click(function () {
            console.log("Clicked btn-buyall");
            if (products != null) {
                window.location.href = "http://localhost/sandwech-web/order";
            }
        });

        cookieUserData = CookiesToObject(document.cookie)["userLoginData"];
        console.log(cookieUserData);
        GetUserCart(cookieUserData["userID"], false);
    });

    function GetUserCart(userID, renderOnlyTotal) {
        $.ajax({
            url: "/food-api/API/cart/getCart.php?user=" + userID,
            type: "GET",
            success: function (data) {
                console.log(data);
                products = data;

                if (renderOnlyTotal == false) {
                    RenderCartItems(data);
                    RenderTotalPrice(data);
                } else {
                    RenderTotalPrice(data);
                }
            },
            error: function (request, status, error) { }
        });
    }

    function AddQuantityItemCart(userID, productID, rowID) {
        $.ajax({
            url: "/food-api/API/cart/setAdd.php",
            type: "POST",
            data: JSON.stringify({
                "user": userID,
                "product": productID,
            }),
            success: function (data) {
                console.log(data);
                GetUserCart(userID, true);
            },
            error: function (request, status, error) { }
        });
    }

    function RemoveQuantityItemCart(userID, productID, rowID) {
        $.ajax({
            url: "/food-api/API/cart/setRemove.php",
            type: "POST",
            data: JSON.stringify({
                "user": userID,
                "prod": productID,
            }),
            success: function (data) {
                console.log(data);
                GetUserCart(userID, true);
            },
            error: function (request, status, error) { }
        });
    }

    function DeleteItemCart(userID, productID, rowID) {
        $.ajax({
            url: "/food-api/API/cart/deleteItem.php?user=" + userID + "&product=" + productID,
            type: "GET",
            success: function (data) {
                console.log(data);

                $("#" + rowID).remove();
                GetUserCart(userID, true);
            },
            error: function (request, status, error) { }
        });
    }

    function RenderCartItems(items) {
        for (let i = 0; i < items.length; i++) {
            let rowID = 'row-' + i;
            let colID = 'row-' + i + 'col';

            let rowS = new HItem("div", {
                class: 'row',
                id: rowID,
            }, "myDiv");

            let itemInfo = [
                ["h5", {
                    class: 'col-4',
                    text: items[i].name + " --> quantità: "
                }],
                ["h5", {
                    class: 'col-1',
                    id: "quantityValue-" + items[i].product,
                    text: items[i].quantity
                }],
                ["div", {
                    class: 'col-4',
                    id: colID,
                }]
            ];
            HItem.AppendArray(rowID, itemInfo);

            let buttons = [
                ["button", {
                    class: 'btn btn-primary add',
                    productid: items[i].product,
                    row: rowID,
                    text: "+"
                }],
                ["button", {
                    class: 'btn btn-danger remove',
                    productid: items[i].product,
                    row: rowID,
                    text: "-"
                }],
                ["button", {
                    class: 'btn btn-info delete',
                    productid: items[i].product,
                    row: rowID,
                    text: "delete"
                }]
            ];
            HItem.AppendArray(colID, buttons);
        }

        $(".add").click(function () {
            console.log("clicked add");
            let prodID = $(this).attr('productid');
            let rowID = $(this).attr('row');

            let quant = $("#quantityValue-" + prodID).text();
            if (quant < 99) {
                quant++;
                $("#quantityValue-" + prodID).text(quant);
                AddQuantityItemCart(cookieUserData["userID"], prodID, rowID);
            }
        });
        $(".remove").click(function () {
            console.log("clicked remove");
            let prodID = $(this).attr('productid');
            let rowID = $(this).attr('row');

            let quant = $("#quantityValue-" + prodID).text();
            if (quant > 1) {
                quant--;
                $("#quantityValue-" + prodID).text(quant);
                RemoveQuantityItemCart(cookieUserData["userID"], prodID, rowID);
            }
        });
        $(".delete").click(function (e) {
            console.log("clicked delete");
            let prodID = $(this).attr('productid');
            let rowID = $(this).attr('row');

            DeleteItemCart(cookieUserData["userID"], prodID, rowID);
        });
    }

    function RenderTotalPrice(data) {
        let total = 0.00;
        for (let i = 0; i < data.length; i++) {
            let singleItemTotal = data[i].quantity * data[i].price;
            total += singleItemTotal;
        }

        totalString = parseFloat(total).toFixed(2).replace(".", ",");
        //console.log(totalString);
        $("#total-price").text(totalString + "€");
    }
</script>

<?php get_footer(); ?>
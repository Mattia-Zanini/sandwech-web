<?php get_header(); ?>

<link href="<?php echo get_template_directory_uri(); ?>/css/cart.css" rel="stylesheet" type="text/css">

<div>
    <div class="row">
        <div class="col-3">
            <h1>Cart</h1>
            <button class="btn btn-primary"
                onclick="window.location.href = 'http://localhost/sandwech-web/'">Back</button>
        </div>
        <div class="col-9">
            <div id="myDiv"></div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/cookies_utils.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/cookies.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/HItem.js"></script>
<script text="text/javascript">
    var cookieUserData = null;
    $(document).ready(function () {
        cookieUserData = CookiesToObject(document.cookie)["userLoginData"];
        console.log(cookieUserData);
        GetUserCart(cookieUserData["userID"]);

        /*
        console.log(Math.floor(17 / 4));
        console.log(Math.floor(4.9));
        */
    });

    function GetUserCart(userID) {
        $.ajax({
            url: "/food-api/API/cart/getCart.php?user=" + userID,
            type: "GET",
            success: function (result) {
                //var data = result[0];
                var data = result;
                console.log(data);

                RenderCartItems(data);
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
            success: function (result) {
                var data = result;
                console.log(data);
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
            success: function (result) {
                var data = result;
                console.log(data);
            },
            error: function (request, status, error) { }
        });
    }

    function DeleteItemCart(userID, productID, rowID) {
        $.ajax({
            url: "/food-api/API/cart/deleteItem.php?user=" + userID + "&product=" + productID,
            type: "GET",
            success: function (result) {
                var data = result;
                console.log(data);

                $("#" + rowID).remove();
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

            let sItem = new HItem("h5", {
                class: 'col-6',
                text: items[i].name + " --> quantità: " + items[i].quantity
            }, rowID);

            let btnDiv = new HItem("div", {
                class: 'col-4',
                id: colID,
            }, rowID);

            let plusItem = new HItem("button", {
                class: 'btn btn-primary add',
                productid: items[i].product,
                row: rowID,
                text: "+"
            }, colID);

            let minusItem = new HItem("button", {
                class: 'btn btn-danger remove',
                productid: items[i].product,
                row: rowID,
                text: "-"
            }, colID);

            let deleteItem = new HItem("button", {
                class: 'btn btn-info delete',
                productid: items[i].product,
                row: rowID,
                text: "delete"
            }, colID);
        }

        $(".add").click(function () {
            console.log("clicked add");
            let prodID = $(this).attr('productid');
            let rowID = $(this).attr('row');

            AddQuantityItemCart(cookieUserData["userID"], prodID, rowID);
        });
        $(".remove").click(function () {
            console.log("clicked remove");
            let prodID = $(this).attr('productid');
            let rowID = $(this).attr('row');

            RemoveQuantityItemCart(cookieUserData["userID"], prodID, rowID);
        });
        $(".delete").click(function (e) {
            console.log("clicked delete");
            let prodID = $(this).attr('productid');
            let rowID = $(this).attr('row');

            DeleteItemCart(cookieUserData["userID"], prodID, rowID);
        });
    }
</script>

<?php get_footer(); ?>
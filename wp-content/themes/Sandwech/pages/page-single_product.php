<?php get_header(); ?>

<link href="<?php echo get_template_directory_uri(); ?>/css/single-product.css" rel="stylesheet" type="text/css">

<div class="container-fluid">
    <?php require_once("navbar.php"); ?>
    <div class="row">
        <div class="col-2">
            <h1>Prodotto Singolo</h1>
            <button class="btn btn-primary"
                onclick="window.location.href = 'http://localhost/sandwech-web/order'">Back</button>
        </div>
        <div class="col-9">
            <div id="myDiv">
                <div class="row">
                    <div class="col-7">
                        <img class="img-fluid" style="border-radius: 20px;"
                            src="<?php echo get_template_directory_uri(); ?>/assets/img/panini_farciti.jpg">
                    </div>
                    <div class="col-5">
                        <h1 id="prod-name"></h1>
                        <h2 id="prod-price"></h2>
                        <h4 id="prod-description"></h4>
                        <div class="row">
                            <button class="col-1 btn btn-primary minus">-</button>
                            <input type="number" value="1" class="col-2" id="prod-quantity"
                                style="text-align: center; width: 50px;" min="1" max="99">
                            <button class="col-1 btn btn-primary plus">+</button>
                            <button class="col-2 offset-1 btn btn-danger btn-cart">Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/cookies_utils.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/cookies.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/navutils.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/HItem.js"></script>
<script text="text/javascript">
$(document).ready(function() {
    var cookieUserData = CookiesToObject(document.cookie)["userLoginData"];
    console.log(cookieUserData);
    let url = new URLSearchParams(location.search);
    //let prova = url.get('productID');
    //console.log(prova);

    $(".minus").click(function() {
        let value = $("#prod-quantity").val();
        console.log("Clicked minus: " + value);

        if (value > 1) {
            value--;
            $("#prod-quantity").val(value);
        }
    });
    $(".plus").click(function() {
        let value = $("#prod-quantity").val();
        console.log("Clicked plus: " + value);

        if (value < 99) {
            value++;
            $("#prod-quantity").val(value);
        }
    });
    $(".btn-cart").click(function() {
        let quant = $("#prod-quantity").val();
        let usrID = cookieUserData["userID"];
        let prodID = url.get('productID');

        console.log("Clicked cart:");
        AddItemToCart(usrID, prodID, quant);
        $("#prod-quantity").val("1");
    });

    GetProductInfo(url.get('productID'))
});

function GetProductInfo(productID) {
    $.ajax({
        url: "/food-api/API/product/getProduct.php?PRODUCT_ID=" + productID,
        type: "GET",
        success: function(data) {
            data = data[0];

            console.log(data);
            RenderProductInfo(data);
        },
        error: function(request, status, error) {}
    });
}

function RenderProductInfo(info) {
    $("#prod-name").text(info["Nome prodotto"]);
    $("#prod-price").text(info["Prezzo"] + "€");
    $("#prod-description").text(info["Descrizione"]);
}

function AddItemToCart(usr, product, quantity) {
    //$data->prod, $data->user, $data->quantity
    $.ajax({
        url: "/food-api/API/cart/addProductCart.php?",
        type: "POST",
        data: JSON.stringify({
            "user": usr,
            "prod": product,
            "quantity": quantity
        }),
        success: function(data) {
            console.log(data);
        },
        error: function(request, status, error) {}
    });
}
</script>

<?php get_footer(); ?>
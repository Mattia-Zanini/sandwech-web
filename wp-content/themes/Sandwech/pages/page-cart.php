<?php get_header(); ?>

<link href="<?php echo get_template_directory_uri(); ?>/css/cart.css" rel="stylesheet" type="text/css">

<div>
    <h1>Cart</h1>
    <button class="btn btn-primary" onclick="window.location.href = 'http://localhost/sandwech-web/'">Back</button>
</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/cookies_utils.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/cookies.js"></script>
<script text="text/javascript">
$(document).ready(function() {
    var cookieUserData = CookiesToObject(document.cookie)["userLoginData"];
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
        success: function(result) {
            //var data = result[0];
            var data = result;
            console.log(data);
            /*
                        let name = $("#nameText").text();
                        let surname = $("#surnameText").text();
                        let email = $("#emailText").text();
            
                        $("#nameText").text(name + data["name"]);
                        $("#surnameText").text(surname + data["surname"]);
                        $("#emailText").text(email + data["email"]);
                        */
        },
        error: function(request, status, error) {}
    });
}
</script>

<?php get_footer(); ?>
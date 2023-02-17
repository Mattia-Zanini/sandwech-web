<?php get_header(); ?>

<link href="<?php echo get_template_directory_uri(); ?>/css/cart.css" rel="stylesheet" type="text/css">

<div class="container-fluid">
    <div class="row">
        <div class="col-2">
            <h1>Prodotto Singolo</h1>
            <button class="btn btn-primary"
                onclick="window.location.href = 'http://localhost/sandwech-web/order'">Back</button>
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
    $(document).ready(function () {
        var cookieUserData = CookiesToObject(document.cookie)["userLoginData"];
        console.log(cookieUserData);
    });
</script>

<?php get_footer(); ?>
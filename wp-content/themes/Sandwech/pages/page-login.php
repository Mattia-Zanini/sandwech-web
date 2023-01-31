<?php get_header(); ?>

<link href="<?php echo get_template_directory_uri(); ?>/css/login.css" rel="stylesheet" type="text/css">

<main class="d-flex align-items-center login-body">
    <div class="container">
        <div class="row g-0">
            <div class="col-4 offset-1">
                <img class="img-fluid login-card-shadow"
                    src="<?php echo get_template_directory_uri(); ?>/assets/panino4.jpeg" alt="photo"
                    style="border-radius: 25px 0px 0px 25px; width: 100%;">
            </div>
            <div class="col-6 login-card-shadow" style="border-radius: 0px 25px 25px 0px; background-color: white;">
                <div class="col-8 offset-1">
                    <div class="row">
                        <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/logo.png"
                            alt="photo" style="width: 25%; margin-top: 20%; margin-bottom: 5%;">
                    </div>
                    <div class="row">
                        <div class="form-group mt-3">
                            <label for="email" class="">Email</label>
                            <input type="email" name="email" id="emailInput" class="form-control" placeholder="">
                        </div>
                        <div class="form-group mb-4 mt-4">
                            <label for="password" class="">Password</label>
                            <input type="password" name="password" id="passwordInput" class="form-control"
                                placeholder="">
                        </div>
                        <button class="btn btn-primary" id="login-btn" style="margin-top: 25%; width: 20%;">
                            Login
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script text="text/javascript">
$("button#login-btn").click(function() {
    $.ajax({
        url: "/food-api/API/user/login.php",
        type: "POST",
        data: JSON.stringify({
            "email": $("#emailInput").val(),
            "password": $("#passwordInput").val(),
        }),
        success: function(result) {
            var loginAnswer = result["response"];
        },
        error: function(request, status, error) {
            var result = JSON.parse(request.responseText);
            var loginAnswer = result["response"];
        }
    });
});
</script>

<?php get_footer(); ?>
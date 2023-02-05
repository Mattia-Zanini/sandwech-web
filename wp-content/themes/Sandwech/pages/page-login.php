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
                        <div class="form-floating mt-3">
                            <input type="email" id="emailInput" class="form-control inputFields" placeholder="Email">
                            <label style="margin-left: 0.6vw;" for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating mb-4 mt-4">
                            <input type="password" id="passwordInput" class="form-control inputFields"
                                placeholder="Password">
                            <label style="margin-left: 0.6vw;" for="floatingPassword">Password</label>
                        </div>

                        <button class="btn btn-primary" id="login-btn"
                            style="margin-left: 0.6vw; margin-top: 25%; width: 20%;">
                            Login
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/cookies_utils.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/input_utils.js"></script>
<script text="text/javascript">
    $('.inputFields').pressEnter(function () {
        SendLogin();
    });

    $("button#login-btn").click(function () {
        SendLogin();
    });

    function SendLogin() {
        var username = $("#emailInput").val();
        var password = $("#passwordInput").val();

        if (username != "" && password != "")
            $.ajax({
                url: "/food-api/API/user/login.php",
                type: "POST",
                data: JSON.stringify({
                    "email": username,
                    "password": password,
                }),
                success: function (result) {
                    var loginResult = result["response"];
                    console.log(loginResult);

                    if (loginResult != true)
                        location.reload();
                    else {
                        //alert("Credenziali corrette");

                        var cookies = CookiesToObject(document.cookie);
                        document.cookie = CreateCookie("userLoginData", {
                            "userName": username,
                            "password": password
                        }, addDaysToDate(20));
                        console.log(cookies);
                        window.location.replace("http://localhost/sandwech-web/");
                    }
                },
                error: function (request, status, error) {
                    var result = JSON.parse(request.responseText);
                    var loginResult = result["response"];
                    console.log(loginResult);

                    location.reload();
                }
            });

        else
            alert("Compila tutti i campi");
    }
</script>

<?php get_footer(); ?>
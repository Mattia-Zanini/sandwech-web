<?php get_header(); ?>

<link href="<?php echo get_template_directory_uri(); ?>/css/login.css" rel="stylesheet" type="text/css">

<main class="d-flex align-items-center login-body">
    <div class="container">
        <div class="row" style="border-radius: 20px; background-color: white;">
            <div class="col-4">
                <img class="img-fluid" src="<?php echo get_template_directory_uri(); ?>/assets/login_test.jpg"
                    alt="photo" style="border-radius: 50px 0px 0px 50px;">
            </div>
            <div class="col-8">
                <form action="#">
                    <div class="form-group">
                        <label for="email" class="">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group mb-4">
                        <label for="password" class="">Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="***********">
                    </div>
                    <input name="login-btn" id="login-btn" class="btn btn-primary" type="button" value="Login">
                </form>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
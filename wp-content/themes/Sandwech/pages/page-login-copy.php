<?php get_header(); ?>

<link href="<?php echo get_template_directory_uri(); ?>/css/login.css" rel="stylesheet" type="text/css">

<main class="d-flex align-items-center login-body">
    <div class="container">
        <div class="card login-card">
            <div class="row">
                <div class="col-4" style="background-color: aquamarine;">
                    <div class="container-fluid">
                        <img class="img-fluid"
                            src="<?php echo get_template_directory_uri(); ?>/assets/img/login_test.jpg" alt="photo">
                    </div>
                </div>
                <div class="col-8" style="background-color: blueviolet;">
                    <div class="container">
                        <div class="row">
                            <div class="col-1">
                                <img class="img-fluid"
                                    src="<?php echo get_template_directory_uri(); ?>/assets/img/logo.png" alt="logo">
                            </div>
                        </div>
                        <div class="row">
                            <form action="https://www.bootstrapdash.com/demo/login-template-free-2/#!">
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Email address">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="***********">
                                </div>
                                <input name="login" id="login" class="btn btn-block login-btn mb-4" type="button"
                                    value="Login">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
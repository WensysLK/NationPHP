<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="DashForge">
    <meta name="twitter:description" content="Responsive Bootstrap 5 Dashboard Template">
    <meta name="twitter:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/dashforge">
    <meta property="og:title" content="DashForge">
    <meta property="og:description" content="Responsive Bootstrap 5 Dashboard Template">

    <meta property="og:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 5 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="includes/assets/img/favicon.png">

    <title>The Nations Recruitment Agency</title>

    <!-- vendor css -->
    <link href="includes/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="includes/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="includes/lib/remixicon/fonts/remixicon.css" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="includes/assets/css/dashforge.css">
    <link rel="stylesheet" href="includes/assets/css/dashforge.auth.css">
</head>

<body>

    <header class="navbar navbar-header navbar-header-fixed">
        <a href="#" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
        <div class="navbar-brand">
            <a href="../../index.html" class="df-logo">The<span>Nation</span></a>
        </div><!-- navbar-brand -->
        <div id="navbarMenu" class="navbar-menu-wrapper">
            <div class="navbar-menu-header">
                <a href="../../index.html" class="df-logo">The<span>Nation</span></a>
                <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
            </div><!-- navbar-menu-header -->

        </div><!-- navbar-menu-wrapper -->
        <div class="navbar-right">
            <a href="#" class="btn btn-social"><i class="fab fa-dribbble"></i></a>
            <a href="#" class="btn btn-social"><i class="fab fa-github"></i></a>
            <a href="#" class="btn btn-social"><i class="fab fa-twitter"></i></a>
        </div><!-- navbar-right -->
    </header><!-- navbar -->

    <div class="content content-fixed content-auth">
        <div class="container">
            <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
                <div class="media-body align-items-center d-none d-lg-flex">
                    <div class="mx-wd-600">
                        <img src="uploads/img/benjamin-child-0sT9YhNgSEs-unsplash.jpg" class="img-fluid" alt="">
                    </div>
                </div><!-- media-body -->
                <div class="sign-wrapper mg-lg-l-50 mg-xl-l-60">
                    <div class="wd-100p">
                        <h3 class="tx-color-01 mg-b-5">Sign In</h3>
                        <p class="tx-color-03 tx-16 mg-b-40">Welcome back! Please signin to continue.</p>
                        <form action="public/login.php" method="POST">
                            <div class="form-group">
                                <label>Username or Email</label>
                                <input type="text" class="form-control" name="username_email"
                                    placeholder="Enter your username or email" required>
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-between mg-b-5">
                                    <label class="mg-b-0-f">Password</label>
                                    <a href="forgot_password.php" class="tx-13">Forgot password?</a>
                                </div>
                                <input type="password" class="form-control" name="password"
                                    placeholder="Enter your password" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-brand-02 w-100">Sign In</button>
                        </form>
                    </div>
                </div><!-- sign-wrapper -->
            </div><!-- media -->
        </div><!-- container -->
    </div><!-- content -->

    <footer class="footer">
        <div>
            <span>&copy; 2024 thenations </span>
            <span>Created by <a href="#">WensysLk</a></span>
        </div>
    </footer>

    <script src="includes/lib/jquery/jquery.min.js"></script>
    <script src="includes/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="includes/lib/feather-icons/feather.min.js"></script>
    <script src="includes/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <script src="includes/assets/js/dashforge.js"></script>

    <!-- append theme customizer -->
    <script src="includes/lib/js-cookie/js.cookie.js"></script>
    <script src="includes/assets/js/dashforge.settings.js"></script>
    <script>
    $(function() {
        'use script'

        window.darkMode = function() {
            $('.btn-white').addClass('btn-dark').removeClass('btn-white');
        }

        window.lightMode = function() {
            $('.btn-dark').addClass('btn-white').removeClass('btn-dark');
        }

        var hasMode = Cookies.get('df-mode');
        if (hasMode === 'dark') {
            darkMode();
        } else {
            lightMode();
        }
    })
    </script>
</body>

</html>
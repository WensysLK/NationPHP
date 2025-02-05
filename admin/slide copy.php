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
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.png">

    <title>DashForge Responsive Bootstrap 5 Dashboard Template</title>

    <!-- vendor css -->
    <link href="../includes/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="../includes/lib/typicons.font/src/font/typicons.css" rel="stylesheet">
    <link href="../includes/lib/prismjs/themes/prism-vs.css" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="../includes/assets/css/dashforge.css">
		<link rel="stylesheet" href="../includes/assets/css/dashforge.demo.css">

  </head>
  <body class="pos-relative" data-bs-spy="scroll" data-bs-target="#navSection" data-offset="120">

    <div class="content content-components">
      <div class="container">
       

        <h4 id="section1" class="mg-b-10">Basic Wizard</h4>
        <p class="tx-14 mg-b-30">Below is an example of a basic horizontal form wizard.</p>

        <div class="tx-13 mg-b-25">
          <div id="wizard1">
            <h3>Personal Information</h3>
            <section>
              <p class="mg-b-20">Try the keyboard navigation by clicking arrow left or right!</p>
              <div class="row row-sm">
                <div class="form-group col-sm-6">
                  <label class="form-label">Fullname</label>
                  <input type="text" class="form-control" placeholder="Firstname">
                </div><!-- col -->
                <div class="form-group col-sm-6 d-flex align-items-end">
                  <input type="text" class="form-control" placeholder="Lastname">
                </div><!-- col -->
                <div class="col-sm-4 col-md-5">
                  <label class="form-label">Birthday</label>
                  <select class="form-select" required>
                    <option value="" disabled selected="">Select Month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                  </select>
                </div>
                <div class="col-sm-4 col-md-3 mg-t-10 mg-sm-t-0 d-flex align-items-end">
                  <select class="form-select" required>
                    <option value="" disabled selected="">Select Day</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                </div>
                <div class="col-sm-4 mg-t-10 mg-sm-t-0 d-flex align-items-end">
                  <select class="form-select" required>
                    <option value="" disabled selected="">Select Year</option>
                    <option value="1">2023</option>
                    <option value="2">2018</option>
                    <option value="3">2017</option>
                  </select>
                </div>
              </div><!-- form-row -->
            </section>
            <h3>Billing Information</h3>
            <section>
              <p class="mg-b-20">Wonderful transition effects.</p>
              <div class="row row-sm">
                <div class="form-group col-sm-6">
                  <label class="form-label">Client Name</label>
                  <input type="text" class="form-control" placeholder="Firstname">
                </div><!-- col -->
                <div class="form-group col-sm-6 d-flex align-items-end">
                  <input type="text" class="form-control" placeholder="Lastname">
                </div><!-- col -->
                <div class="col-12">
                  <label class="form-label">Notes</label>
                  <textarea class="form-control" rows="1" placeholder="Enter some notes"></textarea>
                </div><!-- col -->
              </div><!-- row -->
            </section>
            <h3>Payment Details</h3>
            <section>
              <p class="mg-b-20">The next and previous buttons help you to navigate through your content.</p>
              <div class="row row-sm">
                <div class="form-group col-12">
                  <input type="text" class="form-control" placeholder="Credit card number">
                </div><!-- col -->
                <div class="col-sm-6">
                  <input type="text" class="form-control" placeholder="Name on card">
                </div><!-- col -->
                <div class="col-7 col-sm-3 mg-t-20 mg-sm-t-0 d-flex align-items-end">
                  <input type="text" class="form-control" placeholder="Exp. date">
                </div><!-- col -->
                <div class="col-5 col-sm-3 mg-t-20 mg-sm-t-0 d-flex align-items-end">
                  <input type="text" class="form-control" placeholder="CVC/CVV">
                </div><!-- col -->
              </div><!-- row -->
            </section>
          </div>
        </div><!-- df-example -->
      </div><!-- container -->
    </div><!-- content -->

    <script src="../includes/lib/jquery/jquery.min.js"></script>
    <script src="../includes/lib/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="../includes/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../includes/lib/feather-icons/feather.min.js"></script>
    <script src="../includes/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../includes/lib/prismjs/prism.js"></script>
    <script src="../includes/lib/parsleyjs/parsley.min.js"></script>
    

    <script src="../assets/js/dashforge.js"></script>
    <script>
     $(document).ready(function() {
    'use strict';

    $('#wizard1').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        autoFocus: true,
        titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>'
    });

    // Initialize other wizards similarly if needed
});
    </script>
  </body>
</html>

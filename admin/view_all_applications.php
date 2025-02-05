<?php include('../includes/header.php'); ?>

<body>
    <?php include('../includes/navigation-admin.php'); ?>
    <div class="content content-fixed bd-b">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mg-b-5">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Applications</a></li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0">View All</h4>
                </div>
                <div class="mg-t-20 mg-sm-t-0">
                    
                        <a href="#modal6" data-bs-toggle="modal" data-animation="effect-slide-in-bottom"
                            >
                            <button type="button" class="btn btn-primary btn-icon">
  <i data-feather="user-plus"></i>
</button>
                        
                        </a>
                   

                </div>
            </div>
            <div class="content">
                <h1>Administrator Dashboard</h1>
            </div>
        </div>
        <!--Popup form for Precheck Registration -->
        <?php include('popups/precheck_application.php'); ?>
        <!-- End popup -->

        <?php include('../includes/footer.php'); ?>
</body>

</html>
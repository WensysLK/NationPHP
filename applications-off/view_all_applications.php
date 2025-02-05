<?php include('../includes/header.php'); 



?>

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

                    <a href="#modal6" data-bs-toggle="modal" data-animation="effect-slide-in-bottom">
                        <button type="button" class="btn btn-primary btn-icon">
                            <i data-feather="user-plus"></i>
                        </button>

                    </a>


                </div>
            </div>
            
            <div class="content">
            <div class="card-body pd-y-30">
                    <div class="d-sm-flex">
                        <div class="media">
                            <div
                                class="wd-40 wd-md-50 ht-40 ht-md-50 bg-teal tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-6">
                                <i data-feather="bar-chart-2"></i>
                            </div>
                            <div class="media-body">
                                <h6
                                    class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">
                                    Total Applications
                                </h6>
                                <div class="d-flex align-items-center">
                                    <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0" id="availableapp">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    </h4>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                            <div
                                class="wd-40 wd-md-50 ht-40 ht-md-50 bg-pink tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-5">
                                <i data-feather="bar-chart-2"></i>
                            </div>
                            <div class="media-body">
                                <h6
                                    class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">
                                    Incomplete</h6>
                                    <div class="d-flex align-items-center">
                                    <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0" id="incompeleteapp">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    </h4>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                            <div
                                class="wd-40 wd-md-50 ht-40 ht-md-50 bg-primary tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-4">
                                <i data-feather="bar-chart-2"></i>
                            </div>
                            <div class="media-body">
                                <h6
                                    class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">
                                    Processing</h6>
                                    <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0" id="processingcount">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    </h4>
                            </div>
                        </div>
                        <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                            <div
                                class="wd-40 wd-md-50 ht-40 ht-md-50 bg-primary tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-4">
                                <i data-feather="bar-chart-2"></i>
                            </div>
                            <div class="media-body">
                                <h6
                                    class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">
                                    Departure</h6>
                                    <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0" id="departurecount">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    </h4>
                            </div>
                        </div>
                        <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                            <div
                                class="wd-40 wd-md-50 ht-40 ht-md-50 bg-primary tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-4">
                                <i data-feather="bar-chart-2"></i>
                            </div>
                            <div class="media-body">
                                <h6
                                    class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">
                                    Deported</h6>
                                    <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0" id="deportedcount">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="sr-only"></span>
                                        </div>
                                    </h4>
                            </div>
                        </div>
                    </div>
                </div><!-- card-body -->
                <!--- Tab Start -->
                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="available-contracts-tab" data-bs-toggle="tab"
                            data-bs-target="#available-contracts" type="button" role="tab"
                            aria-controls="available-contracts" aria-selected="true">Available Contracts</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending"
                            type="button" role="tab" aria-controls="pending"
                            aria-selected="false">In Complete</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="processing-tab" data-bs-toggle="tab" data-bs-target="#processing"
                            type="button" role="tab" aria-controls="processing"
                            aria-selected="false">Processing</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed"
                            type="button" role="tab" aria-controls="completed" aria-selected="false">Departured</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="deported-tab" data-bs-toggle="tab" data-bs-target="#deported"
                            type="button" role="tab" aria-controls="deported" aria-selected="false">Deported</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="available-contracts" role="tabpanel"
                        aria-labelledby="available-contracts-tab">

                      <?php include('application-view-parts/view_available_applications.php'); ?>

                    </div>
                    <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">

                    
                    <?php include('application-view-parts/view_incomplete_applications.php'); ?>

                    </div>
                    <div class="tab-pane fade" id="processing" role="tabpanel" aria-labelledby="processing-tab">

                    <?php include('application-view-parts/view_processing_applications.php'); ?>

                    </div>
                    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">

                    <?php include('application-view-parts/view_departured_applications.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="deported" role="tabpanel" aria-labelledby="deported-tab">
                    <?php include('application-view-parts/view_deported_applications.php'); ?>
                    
                    </div>
                </div>
                <!--- Tab End -->
            </div>
        </div>
        <!--Popup form for Precheck Registration -->
        <?php include('popups/precheck_application.php'); ?>
        <!-- End popup -->

        <?php include('../includes/footer.php'); ?>

        <!-- Ajax -->
         <?php 
         include('ajax-dashboards/get-available-app-total.php'); 
         include('ajax-dashboards/get-incomplete-app-total.php'); 
         include('ajax-dashboards/get-processing-app-total.php'); 
         include('ajax-dashboards/get-departure-app-total.php'); 
         include('ajax-dashboards/get-depoted-app-total.php'); 
         
         
         ?>
</body>

</html>


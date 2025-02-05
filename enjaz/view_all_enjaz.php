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
                            <li class="breadcrumb-item"><a href="#">Enjaz</a></li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0">View All</h4>
                </div>
<!--                <div class="mg-t-20 mg-sm-t-0">-->
<!---->
<!--                    <a href="#modal6" data-bs-toggle="modal" data-animation="effect-slide-in-bottom">-->
<!--                        <button type="button" class="btn btn-primary btn-icon">-->
<!--                            <i data-feather="user-plus"></i>-->
<!--                        </button>-->
<!---->
<!--                    </a>-->
<!---->
<!---->
<!--                </div>-->
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
                                    Completed
                                </h6>
                                <div class="d-flex align-items-center">
                                    <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0"
                                        id="totalcompletedenjaz">
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
                                    Finance</h6>
                                <div class="d-flex align-items-center">
                                    <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0" id="totalpendingenjaz">
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
                                    Booked</h6>
                                <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0" id="totalbookedenjaz">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only"></span>
                                    </div>
                                </h4>
                            </div>
                        </div>
                    </div>
                </div><!-- card-body -->
                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="available-contracts-tab" data-bs-toggle="tab"
                            data-bs-target="#available-contracts" type="button" role="tab"
                            aria-controls="available-contracts" aria-selected="true">Available Contracts</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="processing-tab" data-bs-toggle="tab" data-bs-target="#processing"
                            type="button" role="tab" aria-controls="processing"
                            aria-selected="false">Processing</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="booked-tab" data-bs-toggle="tab" data-bs-target="#booked"
                            type="button" role="tab" aria-controls="booked" aria-selected="false">Booked</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed"
                            type="button" role="tab" aria-controls="completed" aria-selected="false">Completed</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="available-contracts" role="tabpanel"
                        aria-labelledby="available-contracts-tab">
                        <?php include('enjaz-views/available_enjaz_contacts.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="processing" role="tabpanel" aria-labelledby="processing-tab">
                        <?php include('enjaz-views/processing_enjaz_contacts.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="booked" role="tabpanel" aria-labelledby="booked-tab">
                        <?php include('enjaz-views/booked_enjaz_contacts.php'); ?>
                    </div>
                    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                    <?php include('enjaz-views/completed_enjaz_contacts.php'); ?>
                    </div>
                </div>

            </div>
        </div>

        <!--Popup forms -->
        <?php 
        
        ?>
        <!-- End popup -->



        <?php include('../includes/footer.php'); ?>

        <!-- Dashboard KPI -->
        <?php 
        include('dashboard-kpi/show-enjaz-kpi.php'); 
        
        ?><!-- KPI End-->

        <script>
        // When modal is shown, populate the applicant ID in the input field
        $('#modal6').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var applicantID = button.data('applicant-id');
            var contractID = button.data('contract-id');
            var applicanttitle = button.data('applicant-title');
            var applicantFname = button.data('applicant-fname');
            var applicantLname = button.data('applicant-lname');
            var applicantPassport = button.data('passport-number');
            var applicantNic = button.data('nic');
            var applicantdob = button.data('dob');
            var imageSrc = button.data('image'); // Extract the image path
            var fullImagePath = '../uploads/profile_images/' + imageSrc;

            var fullname = applicanttitle + " " + applicantFname + " " + applicantLname;

            // Ensure that the modal's body contains the correct input element and set the value
            var modal = $(this);
            modal.find('.modal-body #applicantIDInput').val(applicantID);
            modal.find('.modal-body #appContract').val(contractID);
            modal.find('.modal-body #passportnumber').val(applicantPassport);
            modal.find('.modal-body #ClientName').val(fullname);
            modal.find('.modal-body #clientdob').val(applicantdob);
            modal.find('.modal-body #clientNIC').val(applicantNic);

            // Update the image src in the modal
            modal.find('.modal-body img').attr('src', fullImagePath); // Set the profile image
        });
        </script>
        <script>
    // When modal is shown, populate the applicant ID in the input field
    $('#enjazupdate').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var enjazapplicantID = button.data('applicant-id'); // Fetch applicant ID
        var enjazid = button.data('enjaz-id'); // Fetch Enjaz ID
        var contractID = button.data('contract-id'); // Fetch Contract ID
       
        // Ensure that the modal's body contains the correct input element and set the value
        var modal = $(this);
        modal.find('.modal-body #enjazapplicantID').val(enjazapplicantID); // Set applicant ID
        modal.find('.modal-body #enjazidnumber').val(enjazid); // Set Enjaz ID
        modal.find('.modal-body #appContract').val(contractID); // Set contract ID
    });
</script>

</body>

</html>
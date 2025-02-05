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
                        <li class="breadcrumb-item"><a href="#">Help</a></li>
                        <li class="breadcrumb-item"><a href="#">Complaints</a></li>
                    </ol>
                </nav>
                <h4 class="mg-b-0">View All</h4>
            </div>
                            <div class="mg-t-20 mg-sm-t-0">

                                <a href="<?php echo $baseUrl; ?>/help-desk/create-complains.php" >
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
                               All Complaints
                            </h6>
                            <div class="d-flex align-items-center">
                                <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0" id="totalcompletedmedicals">
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
                                Pending</h6>
                            <div class="d-flex align-items-center">
                                <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0" id="totalPending">
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
                                Processing</h6>
                            <div class="d-flex align-items-center">
                                <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0" id="total_processing">
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
                                Completed</h6>
                            <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0" id="total_complte">
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
                            aria-controls="available-contracts" aria-selected="true">All Complaints</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="processing-tab" data-bs-toggle="tab" data-bs-target="#processing"
                            type="button" role="tab" aria-controls="processing"
                            aria-selected="false">Processing</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed"
                            type="button" role="tab" aria-controls="completed" aria-selected="false">Completed</button>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="available-contracts" role="tabpanel"
                     aria-labelledby="available-contracts-tab">

                    <?php include('help_desk_process_parts/available_complains.php'); ?>

                </div>
                <div class="tab-pane fade" id="processing" role="tabpanel" aria-labelledby="processing-tab">

                    <?php include('help_desk_process_parts/processing_complains.php'); ?>

                </div>
                <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                    <?php include('help_desk_process_parts/completed_complains.php'); ?>
                </div>

            </div>
        </div>
    </div>
    <!--Popup form for Precheck Registration -->

    <!-- End popup -->



    <?php include('../includes/footer.php'); ?>



    <script>
        $(document).ready(function() {
            fetchApplicationCount();
        });
        function fetchApplicationCount() {
            $.ajax({
                url: 'help-desk-kpi/get_pending_application.php', // The PHP script
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    // Update the widget with the fetched count
                    $('#totalcompletedmedicals').text(response.total);
                    $('#totalPending').text(response.pending_count);
                    $('#total_processing').text(response.processing_count)
                    $('#total_complte').text(response.completed_count)
                },
                error: function() {
                    $('#totalcompletedmedicals').text('Error loading data');
                }
            });
        }

        // When modal is shown, populate the applicant ID in the input field
        $('#modal4').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var applicantID = button.data('applicant-id');
            var contractID = button.data('contract-id');
            var applicanttitle = button.data('name-title');
            var applicantFname = button.data('app-fname');
            var applicantLname = button.data('app-lname');
            var applicantPassport = button.data('passport');
            var applicantdob = button.data('dob');
            var imageSrc = button.data('image'); // Extract the image path
            var fullImagePath = '../uploads/profile_images/' + imageSrc;

            var fullname = applicanttitle + " " + applicantFname + " " + applicantLname;

            // Ensure that the modal's body contains the correct input element and set the value
            var modal = $(this);
            modal.find('.modal-body #appId').val(applicantID);
            modal.find('.modal-body #contractId').val(contractID);
            modal.find('.modal-body #passportnumbermedi').val(applicantPassport);
            modal.find('.modal-body #clientmedicalfname').val(fullname);
            modal.find('.modal-body #medidob').val(applicantdob);

            // Update the image src in the modal
            modal.find('.modal-body img').attr('src', fullImagePath); // Set the profile image
        });

        $('#updatemedical').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var applicantID = button.data('applicant-id');
            var contractID = button.data('contract-id');
            var applicanttitle = button.data('name-title');
            var applicantFname = button.data('app-fname');
            var applicantLname = button.data('app-lname');
            var applicantPassport = button.data('passport');
            var applicantdob = button.data('dob');
            var allocationdate = button.data('allocation-date');
            var gccdate = button.data('gcc-date');
            var medicalCenter = button.data('medical-center');
            var medicalId = button.data('medical-id');
            var imageSrc = button.data('image'); // Extract the image path
            var fullImagePath = '../uploads/profile_images/' + imageSrc;

            var fullname = applicanttitle + " " + applicantFname + " " + applicantLname;

            // Ensure that the modal's body contains the correct input element and set the value
            var modal = $(this);
            modal.find('.modal-body #appId').val(applicantID);
            modal.find('.modal-body #contractId').val(contractID);
            modal.find('.modal-body #passportnumbermedi').val(applicantPassport);
            modal.find('.modal-body #clientmedicalfname').val(fullname);
            modal.find('.modal-body #medidob').val(applicantdob);
            modal.find('.modal-body #medicalId').val(medicalId);
            modal.find('.modal-body #allocationdate').val(allocationdate);
            modal.find('.modal-body #gccdate').val(gccdate);
            modal.find('.modal-body #medicalcenter').val(medicalCenter);

            // Update the image src in the modal
            modal.find('.modal-body img').attr('src', fullImagePath); // Set the profile image
        });
    </script>
</body>

</html>
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
                        <li class="breadcrumb-item"><a href="#">Interview</a></li>
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
            <!-- card-body -->
            <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="available-contracts-tab" data-bs-toggle="tab"
                            data-bs-target="#available-contracts" type="button" role="tab"
                            aria-controls="available-contracts" aria-selected="true">All Interviews</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="processing-tab" data-bs-toggle="tab" data-bs-target="#processing"
                            type="button" role="tab" aria-controls="processing"
                            aria-selected="false">Completed Interviews</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed"
                            type="button" role="tab" aria-controls="completed" aria-selected="false">Incompleted Interviews</button>
                </li>

            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="available-contracts" role="tabpanel"
                     aria-labelledby="available-contracts-tab">

                    <?php include('interview_process_parts/available_interviews.php'); ?>

                </div>
                <div class="tab-pane fade" id="processing" role="tabpanel" aria-labelledby="processing-tab">

                    <?php include('interview_process_parts/completed_interviews.php'); ?>

                </div>
                <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                    <?php include('interview_process_parts/incompleted_interviews.php'); ?>
                </div>
                <div class="tab-pane fade" id="deported" role="tabpanel" aria-labelledby="deported-tab">
<!--                    --><?php //include('medical_process_parts/completed_complains.php'); ?>
                </div>

            </div>
        </div>
    </div>
    <!--Popup form for Precheck Registration -->
    <?php
//    include('popups/add_medicals.php');
//    include('popups/update_medicals.php');
//    include('popups/book_medicals.php');
    ?>
    <!-- End popup -->



    <?php include('../includes/footer.php'); ?>

    <!-- Dashboard KPI -->
    <?php
//    include('dashboard-ajax/get-completed-medical-total.php');

    ?><!-- KPI End-->

    <script>
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
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
                            <li class="breadcrumb-item"><a href="#">Bureau</a></li>
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
                <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="available-contracts-tab" data-bs-toggle="tab"
                            data-bs-target="#available-contracts" type="button" role="tab"
                            aria-controls="available-contracts" aria-selected="true">Ready Submissions</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="processing-tab" data-bs-toggle="tab" data-bs-target="#processing"
                            type="button" role="tab" aria-controls="processing"
                            aria-selected="false">Processing</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed"
                            type="button" role="tab" aria-controls="completed" aria-selected="false">Submitted</button>
                    </li>
                   <!-- <li class="nav-item" role="presentation">
                        <button class="nav-link" id="deported-tab" data-bs-toggle="tab" data-bs-target="#deported"
                            type="button" role="tab" aria-controls="deported" aria-selected="false">Completed</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="unfit-tab" data-bs-toggle="tab" data-bs-target="#unfit"
                            type="button" role="tab" aria-controls="unfit" aria-selected="false">Unfit</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="guarantee-tab" data-bs-toggle="tab" data-bs-target="#guarantee"
                            type="button" role="tab" aria-controls="guarantee" aria-selected="false">Guarantee Request</button>
                    </li> -->
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="available-contracts" role="tabpanel"
                        aria-labelledby="available-contracts-tab">

                        <?php include('bureau-views/available_bureau_views.php'); ?>
                        
                    </div>
                    <div class="tab-pane fade" id="processing" role="tabpanel" aria-labelledby="processing-tab">

                    <?php include('bureau-views/processing_bureau_view.php'); ?>
                        
                    </div>
                    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                        <p>Content for Completed tab.</p>
                    </div>
                   <!-- <div class="tab-pane fade" id="deported" role="tabpanel" aria-labelledby="deported-tab">
                        <p>Content for Deported tab.</p>
                    </div>
                    <div class="tab-pane fade" id="unfit" role="tabpanel" aria-labelledby="unfit-tab">
                        <p>Content for Deported tab.</p>
                    </div>
                    <div class="tab-pane fade" id="guarantee" role="tabpanel" aria-labelledby="guarantee-tab">
                        <p>Content for Deported tab.</p>-->
                    </div>
                </div>
            </div>
        </div>
       

        <?php include('../includes/footer.php'); ?>

        <script>
            // When modal is shown, populate the applicant ID in the input field
    $('#submitburea').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var applicantID = button.data('applicant-id');
        var contractID = button.data('contract-id');
        var enjazID = button.data('enjaz-id');
        var applicanttitle = button.data('client-title');
        var applicantFname = button.data('applicant-fname');
        var applicantLname = button.data('applicant-lname');
        var applicantPassport = button.data('passport');
        var applicantNic = button.data('nic');
        var sponcertitile = button.data('sponcer-title');
        var sponcerFname = button.data('sponcer-fname');
        var sponcerLname = button.data('sponcer-lname');
        var visanumber = button.data('visanumber');
        var visacategory = button.data('visacategory');
        var visaposition = button.data('position');
        var applicantdob = button.data('dob');
        var imageSrc = button.data('image'); // Extract the image path
        var fullImagePath = '../uploads/profile_images/' + imageSrc;  

        var fullname = applicanttitle +" "+ applicantFname +" "+applicantLname;
        var sponcerfullname = sponcertitile+" "+sponcerFname+" "+sponcerLname;

        // Ensure that the modal's body contains the correct input element and set the value
        var modal = $(this);
        modal.find('.modal-body #applicantID').val(applicantID);
        modal.find('.modal-body #appContract').val(contractID);
        modal.find('.modal-body #passportnumber').val(applicantPassport);
        modal.find('.modal-body #clientNIC').val(applicantNic);
        modal.find('.modal-body #ClientName').val(fullname);
        modal.find('.modal-body #clientdob').val(applicantdob);
        modal.find('.modal-body #sponcername').val(sponcerfullname);
        modal.find('.modal-body #visano').val(visanumber);
        modal.find('.modal-body #visaCategory').val(visacategory);
        modal.find('.modal-body #positions').val(visaposition);
        modal.find('.modal-body #positions').val(visaposition);

        // Update the image src in the modal
    modal.find('.modal-body img').attr('src', fullImagePath);  // Set the profile image
    });
        </script>
</body>

</html>
<?php include('../includes/header.php');

// Initialize variables to handle cases where session data might be missing



?>
<style>
    .step {
        display: none;
    }

    .step.active {
        display: block;
    }

    .step-navigation {
        margin-bottom: 20px;
    }

    .step-navigation .nav-link {
        color: #555;
        border-radius: 0;
    }

    .step-navigation .nav-link.active {
        background-color: #007bff;
        color: #fff;
        font-weight: bold;
    }

    .nav-pills .nav-link {
        border-radius: 50px;
        margin-right: 10px;
    }

    .nav-pills .nav-link i {
        margin-right: 5px;
    }

    .skill-entry {
        margin-bottom: 15px;
    }

    .badge {
        margin-right: 5px;
        margin-top: 5px;
        cursor: pointer;
        background: #949494;
    }

    .badge-selected {
        background-color: #007bff !important;
        color: white;
    }

    .wslk_button {
        width: auto;
        margin-left: 15px;
        margin-bottom: 15px;
    }

    .experience-fields,
    .training-fields {
        display: none;
        /* Initially hide both sections */
    }

    .wslk_fam {
        background: grey;
        padding: 10px;
        margin-bottom: 5px;
    }
</style>

<body>

<?php include('../includes/navigation-admin.php');
include('form-parts/control-scripts/control-scripts.php');
?>
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
                <h4 class="mg-b-0">Register Application</h4>
            </div>
            <div class="mg-t-20 mg-sm-t-0">
            </div>
        </div>
        <div class="content">
            <!-- Custom Form Starts -->
            <!-- Step Navigation using Bootstrap Nav Pills -->
            <ul class="nav nav-pills step-navigation mb-4" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="step1-tab" data-bs-toggle="pill" onclick="showStep(1)"
                            type="button" role="tab">
                        <i class="bi bi-person"></i> Personal Information
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="step2-tab" data-bs-toggle="pill" onclick="showStep(2)"
                            type="button" role="tab">
                        <i class="bi bi-envelope"></i> Contact Details
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="step3-tab" data-bs-toggle="pill" onclick="showStep(3)"
                            type="button" role="tab">
                        <i class="bi bi-people"></i> Family Details
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="step4-tab" data-bs-toggle="pill" onclick="showStep(4)"
                            type="button" role="tab">
                        <i class="bi bi-people"></i> Skills & License
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="step5-tab" data-bs-toggle="pill" onclick="showStep(5)"
                            type="button" role="tab">
                        <i class="bi bi-book"></i> Education & Professional Details
                    </button>
                </li>
            </ul>

            <form id="multiStepForm" action="form-functions/main_insert.php" method="POST"
                  enctype="multipart/form-data">
                <!-- Step 1: Personal Information -->
                <div class="step active" id="step1">
                    <h4>Personal Information</h4>

                    <!-- Personal Information--->
                    <?php include('form-parts/personal_information.php'); ?>



                    <!--<button type="submit" class="btn btn-secondary" name="save">Save</button>-->
                    <button type="button" class="btn btn-primary" onclick="nextStep(2)">Next</button>
                </div>

                <!-- Step 2: Contact Details -->
                <div class="step" id="step2">
                    <h4>Contact Details</h4>

                    <!-- Contact Details -->
                    <?php include('form-parts/contact-details.php'); ?>


                    <!--<button type="submit" class="btn btn-secondary" name="save">Save</button>-->
                    <button type="button" class="btn btn-secondary" onclick="prevStep(1)">Previous</button>
                    <button type="button" class="btn btn-primary" onclick="nextStep(3)">Next</button>
                </div>

                <!-- Step 3: Family Details -->
                <div class="step" id="step3">
                    <h4>Family Details</h4>
                    <!------------- Parents Details ------------->
                    <?php include('form-parts/parents-details.php'); ?>

                    <!------------- Spouce Details ---------------->
                    <?php include('form-parts/spouce-details.php'); ?>

                    <!------------- Sibiling Details ---------------->
                    <?php include('form-parts/sibilings-details.php'); ?>

                    <!------------- Guardian Details ---------------->
                    <?php include('form-parts/guardian-details.php'); ?>

                    <!--<button type="submit" class="btn btn-secondary" name="save">Save</button>-->
                    <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Previous</button>
                    <button type="button" class="btn btn-primary" onclick="nextStep(4)">Next</button>
                </div>

                <!-- Step 4: Education & Professional Details -->
                <div class="step" id="step4">
                    <h4>Skills & License</h4>

                    <!------------ Skills ----------------->
                    <?php include('form-parts/skills-details.php'); ?>

                    <!------------ Driving License ----------------->
                    <?php include('form-parts/license-details.php'); ?>

                    <!------------ Language Details ----------------->
                    <?php include('form-parts/language-details.php'); ?>





                    <!--<button type="submit" class="btn btn-secondary" name="save">Save</button>-->
                    <button type="button" class="btn btn-secondary" onclick="prevStep(3)">Previous</button>
                    <button type="button" class="btn btn-primary" onclick="nextStep(5)">Next</button>

                </div>
                <!-- Step 4: Education & Professional Details -->
                <div class="step" id="step5">
                    <h4>Education & Professional Details</h4>

                    <!------------ Educational Details ----------------->
                    <?php include('form-parts/educational-details.php'); ?>


                    <!------------ Professional Qualification Details ----------------->
                    <?php include('form-parts/proffessional-qualification.php'); ?>


                    <!------------ Work Experiance Details ----------------->
                    <?php include('form-parts/work-experiance-details.php'); ?>

                    <!--<button type="submit" class="btn btn-secondary" name="save">Save</button>-->
                    <button type="button" class="btn btn-secondary" onclick="prevStep(4)">Previous</button>
                    <button type="submit" class="btn btn-success" name="save">Submit</button>
                </div>
            </form>



            <!-- End custom forms -->
        </div>
    </div>
</div>
<?php include('../includes/footer.php'); ?>
<!--Form Multistep Form-->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.showStep = function(stepNumber) {
            // Hide all steps
            document.querySelectorAll('.step').forEach(function(step) {
                step.classList.remove('active');
            });

            // Remove active class from all navigation buttons
            document.querySelectorAll('.step-navigation .nav-link').forEach(function(btn) {
                btn.classList.remove('active');
            });

            // Show the current step and set active class on corresponding navigation button
            document.getElementById('step' + stepNumber).classList.add('active');
            document.querySelectorAll('.step-navigation .nav-link')[stepNumber - 1].classList.add('active');
        };

        window.nextStep = function(stepNumber) {
            showStep(stepNumber);
        };

        window.prevStep = function(stepNumber) {
            showStep(stepNumber);
        };
    });

    $('#wizard1').steps({
        headerTag: 'h3',
        bodyTag: 'section',
        autoFocus: true,
        titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>'
    });
</script>
<!--Form Multistep End Form-->






<!------------------------------- How-did-you-find-us ---------------------------------->
<script>
    document.getElementById('findUs').addEventListener('change', function() {
        var subAgentField = document.getElementById('subAgentField');
        if (this.value === 'subAgent') {
            subAgentField.style.display = 'block';
        } else {
            subAgentField.style.display = 'none';
        }
    });
</script>

<?php// include('form-parts/control-scripts/control-scripts.php'); ?>
</body>

</html>
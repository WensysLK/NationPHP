<?php include('../includes/header.php');

// Initialize variables to handle cases where session data might be missing

$complain_id= $_GET['complain_id'];
$sqlmedical="SELECT  applications.*,complains.*
                 FROM applications
                 JOIN complains ON applications.applicationID = complains.complainant_id
                 WHERE complains.softdeletestatus = 1 AND complains.id=$complain_id ";
$resmedical = mysqli_query($conn, $sqlmedical);
$row = mysqli_fetch_assoc($resmedical);

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

?>
<div class="content content-fixed bd-b">
    <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-5">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item"><a href="#">Complains</a></li>
                    </ol>
                </nav>
                <h4 class="mg-b-0">Add Complains</h4>
            </div>
            <div class="mg-t-20 mg-sm-t-0">
            </div>
        </div>
        <div class="content">
            <form action="functions/complete-complains.php" method="POST">

                <div class="modal-body">
                    <!-- Lead Form Fields -->
                    <div class="container">
                        <div class="mb-3 row">
                            <!-- First Name (Column 1) -->
                            <div class="col-md">
                                <label for="Passport Number" class="form-label">Passport Number:</label>
                                <input type="text" name="passport_number" class="form-control" required value="<?php echo $row['applicantPassno']?>"><br>
                                <label for="followup_type" class="form-label">Complainant Type:</label>
                                <select name="followup_type" class="form-control" required>
<!--                                    <option value="localAgent">Local Agent</option>-->
<!--                                    <option value="foreignAgent">Foreign Agent</option>-->
                                    <option value="employer"selected>Employer</option>
                                </select>
                                <label for="message" class="form-label">Complains:</label>
                                <textarea name="message" class="form-control" required><?php echo $row['message']?></textarea><br>

                                <label for="followup_date" class="form-label">Complains Date:</label>
                                <input type="date" name="followup_date" class="form-control" required value="<?php echo $row['create_date']?>"><br>
                                <label for="message" class="form-label">Procedure take for the complaint:</label>
                                <textarea name="procedure_processing" class="form-control" required><?php echo $row['processing_procedure']?></textarea><br>
                                <label for="message" class="form-label">Last Step Procedure take for the complaint:</label>
                                <textarea name="complete_processing" class="form-control" required></textarea><br>
                                <input type="hidden" name="status" value="completed">
                                <input type="hidden" name="complain_id" value="<?php echo $row['id']?>">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>



            </form>
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
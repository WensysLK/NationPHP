<?php include('../includes/header.php');

// Initialize variables to handle cases where session data might be missing
$complain_id= $_GET['complain_id'];
$sqlNew="SELECT complains.* FROM complains  WHERE complains.softdeletestatus = 1 AND complains.id=$complain_id ";
$resmedicalNew = mysqli_query($conn, $sqlNew);
$row = mysqli_fetch_assoc($resmedicalNew);
//var_dump($row['type']);die();
$application_id=$row['complainant_id'];
if ($row['type']=="Employee"){
    $sqlmedical="SELECT  applications.*
                 FROM applications
                 WHERE applications.applicationID = $application_id ";
    $resmedical = mysqli_query($conn, $sqlmedical);
    $row_new = mysqli_fetch_assoc($resmedical);
}elseif ($row['type']=="LocalAgent"){
    $sqlmedical="SELECT  local_agent_details.*
                 FROM local_agent_details
                 WHERE local_agent_details.localagentId = $application_id ";
    $resmedical = mysqli_query($conn, $sqlmedical);
    $row_new = mysqli_fetch_assoc($resmedical);
}elseif ($row['type']=="ForeignAgent") {
    $sqlmedical = "SELECT  foreign_agent_details.*
                 FROM foreign_agent_details
                 WHERE foreign_agent_details.fagentId = $application_id ";
    $resmedical = mysqli_query($conn, $sqlmedical);
    $row_new = mysqli_fetch_assoc($resmedical);
}

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
            <form action="functions/processing-complains.php" method="POST">

                <div class="modal-body">
                    <!-- Lead Form Fields -->
                    <div class="container">
                        <div class="mb-3 row">
                            <!-- First Name (Column 1) -->
                            <div class="col-md">
                                <?php    if ($row['type']=="Employee"){ ?>
                                    <label for="Passport Number" class="form-label">Passport Number:</label>
                                    <input type="text" name="passport_number" class="form-control" required value="<?php echo $row_new['applicantPassno']?>"><br>
                                    <label for="Passport Number" class="form-label">Name:</label>
                                    <input type="text" name="passport_number" class="form-control" required value="<?php echo $row_new['applicantTitle']?> <?php echo $row_new['applicatFname']?> <?php echo $row_new['applicantMname']?> <?php echo $row_new['applicantLname']?>  "><br>
                                <?php }elseif ($row['type']=="LocalAgent"){ ?>
                                    <label for="Passport Number" class="form-label">NIC Number:</label>
                                    <input type="text" name="passport_number" class="form-control" required value="<?php echo $row_new['Local_Agent_Nic']?>"><br>
                                    <label for="Passport Number" class="form-label">Name:</label>
                                    <input type="text" name="passport_number" class="form-control" required value="<?php echo $row_new['Local_Agent_Title']?> <?php echo $row_new['Local_Agent_Fname']?> <?php echo $row_new['Local_Agent_Mname']?> <?php echo $row_new['Local_Agent_Lname']?>  "><br>

                                <?php }elseif ($row['type']=="ForeignAgent"){ ?>
                                    <label for="Passport Number" class="form-label">IQAMA Number:</label>
                                    <input type="text" name="passport_number" class="form-control" required value="<?php echo $row_new['fagentIqamaNo']?>"><br>
                                    <label for="Passport Number" class="form-label">Name:</label>
                                    <input type="text" name="passport_number" class="form-control" required value="<?php echo $row_new['fagentTitle']?> <?php echo $row_new['fagentFname']?> <?php echo $row_new['fagentMname']?> <?php echo $row_new['fagentLname']?>  "><br>

                                <?php } ?>
                                <label for="followup_type" class="form-label">Complainant Type:</label>
                                <?php    if ($row['type']=="Employee"){ ?>
                                    <input type="text" name="passport_number" class="form-control" required value="Employee"><br>
                                <?php }elseif ($row['type']=="LocalAgent"){ ?>
                                    <input type="text" name="passport_number" class="form-control" required value="Local Agent"><br>
                                <?php }elseif ($row['type']=="ForeignAgent"){ ?>
                                    <input type="text" name="passport_number" class="form-control" required value="Foreign Agent"><br>
                                <?php }?>
                                <label for="message" class="form-label">Complains:</label>
                                <textarea name="message" class="form-control" required><?php echo $row['message']?></textarea><br>

                                <label for="followup_date" class="form-label">Complains Date:</label>
                                <input type="date" name="followup_date" class="form-control" required value="<?php echo $row['create_date']?>"><br>
<!--                                <label for="message" class="form-label">Procedure take for the complaint:</label>-->
<!--                                <textarea name="procedure_processing" class="form-control" required></textarea><br>-->
<!--                                <input type="hidden" name="status" value="processing">-->
                                <input type="hidden" name="complain_id" value="<?php echo $row['id']?>">

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
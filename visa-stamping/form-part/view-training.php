<?php include('../../includes/header.php');

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
<?php
$traningID = $_POST['traningID'];




$sqlapplication = "SELECT contract_details.contractId, contract_details.ContractStartus, 
                          applications.applicationID,applications.applicantDob,applications.applicantTitle, applications.applicatFname, 
                          applications.applicantLname, applications.applicantPassno,applications.profile_image,training_details.*
                   FROM contract_details
                   JOIN applications ON contract_details.applicationID = applications.applicationID
                   JOIN training_details ON training_details.clientId = applications.applicationID
                   WHERE  training_details.softdeletestatus = 1 AND training_details.trainnigStatus='completed' AND training_details.traingId='$traningID'";
$resapplicationNew = mysqli_query($conn,$sqlapplication);
$details=mysqli_fetch_assoc($resapplicationNew);
$traningProgramId=$details['trainingCourse'];
$traningCenterId=$details['traingCenter'];



$traningProgram="SELECT * FROM nationscrm.training_programs where programID='$traningProgramId'";
$program = mysqli_query($conn,$traningProgram);
$detailsProgram=mysqli_fetch_assoc($program);

$traningProgramCenter="SELECT * FROM nationscrm.training_centers where centerID='$traningCenterId'";
$programCenter = mysqli_query($conn,$traningProgramCenter);
$detailsProgramCenter=mysqli_fetch_assoc($programCenter);





 ?>
<body>

<?php include('../../includes/navigation-admin.php');

?>
<div class="content content-fixed bd-b">
    <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-style1 mg-b-5">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item"><a href="#">Training</a></li>
                    </ol>
                </nav>
                <h4 class="mg-b-0">View Training</h4>
            </div>
            <div class="mg-t-20 mg-sm-t-0">
            </div>
        </div>
        <div class="content">
            <form action="functions/sponcer_data_edit.php" method="POST">

                <div class="modal-body">
                    <!-- Lead Form Fields -->
                    <div class="container">
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="clientname" class="form-label">Contract Id</label>
                                <input type="text" name="clinetName" class="form-control" id="clientmedicalfname" value="<?php echo $details['contractId']?>">
<!--                                <input type="hidden" name="sponserId" class="form-control" id="sponserId" value="--><?php //echo $details['sponcerId']?><!--">-->

                            </div>
                            <div class="col">
                                <label for="clientname" class="form-label">Application Id</label>
                                <input type="text" name="clinetName" class="form-control" id="clientmedicalfname" value="<?php echo $details['applicationID']?>">
<!--                                <input type="hidden" name="sponserId" class="form-control" id="sponserId" value="--><?php //echo $details['sponcerId']?><!--">-->

                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="clientname" class="form-label">Name</label>
                                <input type="text" name="clinetName" class="form-control" id="clientmedicalfname" value="<?php echo $details['applicantTitle']?> <?php echo $details['applicatFname']?> <?php echo $details['applicantLname']?>">
                                <!--                                <input type="hidden" name="sponserId" class="form-control" id="sponserId" value="--><?php //echo $details['sponcerId']?><!--">-->

                            </div>

                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="clientname" class="form-label">Program Name</label>
                                <input type="text" name="clinetName" class="form-control" id="clientmedicalfname" value="<?php echo $detailsProgram['programName']?>">
                                <!--                                <input type="hidden" name="sponserId" class="form-control" id="sponserId" value="--><?php //echo $details['sponcerId']?><!--">-->

                            </div>
                            <div class="col">
                                <label for="clientname" class="form-label">Program Center</label>
                                <input type="text" name="clinetName" class="form-control" id="clientmedicalfname" value="<?php echo $detailsProgramCenter['centerName']?>">
                                <!--                                <input type="hidden" name="sponserId" class="form-control" id="sponserId" value="--><?php //echo $details['sponcerId']?><!--">-->

                            </div>
                        </div>


                        <br>



                        <div class="mb-3 row">
                            <div class="col">
                                <label for="clientname" class="form-label">Training Date</label>
                                <input type="text" name="clinetAddress" class="form-control" id="clinetAddress" VALUE="<?php echo $details['trainigDate'] ?>">

                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="clientname" class="form-label">Training Remark</label>
                                <input type="text" name="clinetTel" class="form-control" id="clinetTel"  VALUE="<?php echo $details['trainingRemark'] ?>">

                            </div>
                        </div>



                    </div>


            </form>
           </div>
    </div>
</div>
<?php include('../../includes/footer.php'); ?>
<!--Form Multistep Form-->
<script>
    $(document).ready(function () {
        $('input[type="radio"]').
        click(
            function () {
                const inputValue =
                    $(this).attr("value");
                const targetBox =
                    $("." + inputValue);
                $(".selectt").
                not(targetBox).hide();
                $(targetBox).show();
            }
        );
    });

    document.getElementById('passportSearch').addEventListener('input', function() {
        const query = this.value.trim();
        // alert(query);

        if (query.length > 2) {
            // Perform an AJAX request to search subagents
            fetch(`form-functions/search-fucntions/search-agent.php?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    const suggestionsContainer = document.getElementById('subAgentSuggestions');
                    suggestionsContainer.innerHTML = ''; // Clear previous suggestions

                    if (data.length > 0) {
                        data.forEach(agent => {
                            const suggestionItem = document.createElement('a');
                            suggestionItem.className = 'list-group-item list-group-item-action';
                            suggestionItem.textContent = `${agent.name} (${agent.nic})`;
                            suggestionItem.href = 'javascript:void(0);';
                            suggestionItem.onclick = function() {
                                // Fill the hidden subAgentId field with the selected agent's ID
                                document.getElementById('applicationId').value = agent.id;
                                document.getElementById('passportSearch').value = agent.name;
                                suggestionsContainer.innerHTML = ''; // Clear the suggestions
                            };
                            suggestionsContainer.appendChild(suggestionItem);
                        });
                        document.getElementById('addNewSubagentBtn').style.display = 'none'; // Hide "Add New" button
                    } else {
                        // Show the "Add New Subagent" button if no agents were found
                        document.getElementById('addNewSubagentBtn').style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error fetching subagents:', error);
                    // alert('An error occurred while searching. Please try again.');
                });
        } else {
            // Hide the suggestions if the query is too short
            document.getElementById('subAgentSuggestions').innerHTML = '';
            document.getElementById('addNewSubagentBtn').style.display = 'none';
        }
    });
    document.getElementById('localPassportSearch').addEventListener('input', function() {
        const query = this.value.trim();
        // alert(query);

        if (query.length > 2) {
            // Perform an AJAX request to search subagents
            fetch(`form-functions/search-fucntions/search-local-agent.php?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    const suggestionsContainer = document.getElementById('subAgentSuggestionsLocal');
                    suggestionsContainer.innerHTML = ''; // Clear previous suggestions

                    if (data.length > 0) {
                        data.forEach(agent => {
                            const suggestionItem = document.createElement('a');
                            suggestionItem.className = 'list-group-item list-group-item-action';
                            suggestionItem.textContent = `${agent.name} (${agent.nic})`;
                            suggestionItem.href = 'javascript:void(0);';
                            suggestionItem.onclick = function() {
                                // Fill the hidden subAgentId field with the selected agent's ID
                                document.getElementById('localApplicationId').value = agent.id;
                                document.getElementById('localPassportSearch').value = agent.name;
                                suggestionsContainer.innerHTML = ''; // Clear the suggestions
                            };
                            suggestionsContainer.appendChild(suggestionItem);
                        });
                        document.getElementById('addNewSubagentBtn').style.display = 'none'; // Hide "Add New" button
                    } else {
                        // Show the "Add New Subagent" button if no agents were found
                        document.getElementById('addNewSubagentBtn').style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error fetching subagents:', error);
                    // alert('An error occurred while searching. Please try again.');
                });
        } else {
            // Hide the suggestions if the query is too short
            document.getElementById('subAgentSuggestions').innerHTML = '';
            document.getElementById('addNewSubagentBtn').style.display = 'none';
        }
    });
    document.getElementById('foreignPassportSearch').addEventListener('input', function() {
        const query = this.value.trim();
        // alert(query);

        if (query.length > 2) {
            // Perform an AJAX request to search subagents
            fetch(`form-functions/search-fucntions/search-foreign-agent.php?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    const suggestionsContainer = document.getElementById('subAgentSuggestionsForeign');
                    suggestionsContainer.innerHTML = ''; // Clear previous suggestions

                    if (data.length > 0) {
                        data.forEach(agent => {
                            const suggestionItem = document.createElement('a');
                            suggestionItem.className = 'list-group-item list-group-item-action';
                            suggestionItem.textContent = `${agent.name} (${agent.nic})`;
                            suggestionItem.href = 'javascript:void(0);';
                            suggestionItem.onclick = function() {
                                // Fill the hidden subAgentId field with the selected agent's ID
                                document.getElementById('foreignApplicationId').value = agent.id;
                                document.getElementById('foreignPassportSearch').value = agent.name;
                                suggestionsContainer.innerHTML = ''; // Clear the suggestions
                            };
                            suggestionsContainer.appendChild(suggestionItem);
                        });
                        document.getElementById('addNewSubagentBtn').style.display = 'none'; // Hide "Add New" button
                    } else {
                        // Show the "Add New Subagent" button if no agents were found
                        document.getElementById('addNewSubagentBtn').style.display = 'block';
                    }
                })
                .catch(error => {
                    console.error('Error fetching subagents:', error);
                    // alert('An error occurred while searching. Please try again.');
                });
        } else {
            // Hide the suggestions if the query is too short
            document.getElementById('subAgentSuggestions').innerHTML = '';
            document.getElementById('addNewSubagentBtn').style.display = 'none';
        }
    });

</script>
<!--Form Multistep End Form-->







</body>

</html>
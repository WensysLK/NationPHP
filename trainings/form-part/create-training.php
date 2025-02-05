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
$sqlapplication = "
     SELECT * FROM training_programs;
    ";

$resapplication = mysqli_query($conn,$sqlapplication);


$sqlapplicationCenter = "
     SELECT * FROM training_centers;
    ";

$resapplicationCenter = mysqli_query($conn,$sqlapplicationCenter);
$clientID=$_POST['clientId'];
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
                <h4 class="mg-b-0">Register Training</h4>
            </div>
            <div class="mg-t-20 mg-sm-t-0">
            </div>
        </div>
        <div class="content">
            <form action="../functions/training_data_insert.php" method="POST">

                <div class="modal-body">
                    <!-- Lead Form Fields -->
                    <div class="container">
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="clientname" class="form-label">Training Program Name</label>
                                <select name="traningProgram" id="traningProgram" class="form-control">
                                    <option value="none" selected>Select Training Program</option>

                                    <?php
                                    // Populate dropdown with medical center details
                                    if (mysqli_num_rows($resapplication) > 0) {
                                        while ($row = mysqli_fetch_assoc($resapplication)) {
                                            echo "<option value='" . $row['programID'] . "'>" . $row['programName'] ."</option>";
                                        }
                                    } else {
                                        echo "<option value='none'>No Centers Available</option>";
                                    }
                                    ?>
                                </select>

                                <input type="hidden" name="clientId" class="form-control" id="clientId" value="<?php echo $clientID?>">

                            </div>
                        </div>
                        <br>



                        <div class="mb-3 row">


                                <div class="form-group mt-2">
                                    <label for="passportSearch">Training Center:</label>
                                    <select name="traningCenter" id="traningCenter" class="form-control">
                                        <option value="none" selected>Select Training Center</option>

                                        <?php
                                        // Populate dropdown with medical center details
                                        if (mysqli_num_rows($resapplicationCenter) > 0) {
                                            while ($row = mysqli_fetch_assoc($resapplicationCenter)) {
                                                echo "<option value='" . $row['centerID'] . "'>" . $row['centerName'] ."</option>";
                                            }
                                        } else {
                                            echo "<option value='none'>No Centers Available</option>";
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" id="applicationId" name="applicationId">
                                </div>


                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="clientname" class="form-label">Training date</label>
                                <input type="date" name="trainingDate" class="form-control" id="trainingDate">

                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="col">
                                <label for="clientname" class="form-label">Training Remark</label>
                                <input type="text" name="trainingRemark" class="form-control" id="trainingRemark">

                            </div>
                        </div>


                    <div class="mb-3 row">
                                <div class="col">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
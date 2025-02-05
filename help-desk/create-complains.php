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
            <form action="functions/insert-complains.php" method="POST">

                <div class="modal-body">
                    <!-- Lead Form Fields -->
                    <div class="container">
                        <div class="mb-3 row">
                            <div class="col">
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="Employee">
                                <label class="form-check-label" for="flexRadioDefault1">
                                   Employee
                                </label>
                                </div>

                            </div>
                            <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="LocalAgent">
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Local Agent
                                </label>
                            </div>

                        </div>
                            <div class="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" value="ForeignAgent">
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        Foreign Agent
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                        <div class="mb-3 row">
<!--                            <div class="col">-->
<!--                                <label for="Passport Number" class="form-label">Passport Number:</label>-->
<!--                                <input type="text" name="passport_number" class="form-control" required>-->
<!--                            </div>-->
                            <div id="passportField" class="Employee selectt" style="display: none">
                                <div class="form-group mt-2">
                                    <label for="passportSearch">Search Employee Passport Number:</label>
                                    <input type="text" id="passportSearch" class="form-control"
                                           placeholder="Enter Passport number">
                                    <input type="hidden" id="applicationId" name="applicationId">
                                </div>
                                <!-- Button to add a new sub-agent-->

                                <!-- Suggestions will be shown here  -->
                                <div id="subAgentSuggestions" class="list-group"></div>
                            </div>
                            <div id="localPassportField" class="LocalAgent selectt" style="display: none">
                                <div class="form-group mt-2">
                                    <label for="localPassportSearch">Local Agent Search NIC Number:</label>
                                    <input type="text" id="localPassportSearch" class="form-control"
                                           placeholder="Enter Passport number">
                                    <input type="hidden" id="localApplicationId" name="localApplicationId">
                                </div>
                                <!-- Button to add a new sub-agent-->

                                <!-- Suggestions will be shown here  -->
                                <div id="subAgentSuggestionsLocal" class="list-group"></div>
                            </div>
                            <div id="foreignPassportField" class="ForeignAgent selectt" style="display: none">
                                <div class="form-group mt-2">
                                    <label for="foreignPassportSearch">Foreign Agent NIC Number:</label>
                                    <input type="text" id="foreignPassportSearch" class="form-control"
                                           placeholder="Enter Passport number">
                                    <input type="hidden" id="foreignApplicationId" name="foreignApplicationId">
                                </div>
                                <!-- Button to add a new sub-agent-->

                                <!-- Suggestions will be shown here  -->
                                <div id="subAgentSuggestionsForeign" class="list-group"></div>
                            </div>
                        </div>
                            <div class="mb-3 row">
                                <div class="col">
                            <label for="message" class="form-label">Complains:</label>
                            <textarea name="message" class="form-control" required></textarea>
                                </div>
                            </div>
                    <div class="mb-3 row">
                                <div class="col">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>





            </form>
           </div>
    </div>
</div>
<?php include('../includes/footer.php'); ?>
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
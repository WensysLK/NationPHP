<div class="modal fade" id="registersponcer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel4">Register Sponcer</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="medical-process-data/medical_booking_insert.php" method="POST"
                    enctype="multipart/form-data">
                    <input type="hidden" name="appId" value="" id="appId">
                    <input type="hidden" name="contractId" value="" id="contractId">
                    <div class="row">
                        <div class="col-4">
                            <img src="../../uploads/img/fallback-image.png" class="img-fluid" alt="Responsive image">

                        </div>
                        <div class="col-6">
                            <div class="row">
                                <div class="col">
                                    <label for="clientname" class="form-label">Sponcer Name</label>
                                    <input type="text" name="clinetName" class="form-control" id="clientmedicalfname">

                                </div>
                            </div>
                            <br>
                            <div class="mb-3 row">
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="Employee">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Through a foreign agent
                                        </label>
                                    </div>

                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="LocalAgent">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Direct
                                        </label>
                                    </div>

                                </div>

                            </div>
                            <div class="mb-3 row">
                                <div id="passportField" class="Employee selectt" style="display: none">
                                    <div class="form-group mt-2">
                                        <label for="contractType" class="mt-2">Select Foreign Agent</label>
                                        <select name="medicalCenter" id="medicalCenter" class="form-control">
                                            <option value="none" selected>Select Foreign Agent</option>

                                            <?php
                                            // Populate dropdown with medical center details
                                            if (mysqli_num_rows($resultMedicalCenters) > 0) {
                                                while ($row = mysqli_fetch_assoc($resultMedicalCenters)) {
                                                    echo "<option value='" . $row['medicalCenterID'] . "'>" . $row['MediName'] . "</option>";
                                                }
                                            } else {
                                                echo "<option value='none'>No Centers Available</option>";
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" id="applicationId" name="applicationId">
                                    </div>
                                    <!-- Button to add a new sub-agent-->

                                    <!-- Suggestions will be shown here  -->
                                    <div id="subAgentSuggestions" class="list-group"></div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                <label for="passport" class="form-label">Sponcer ID</label>
                                    <input type="text" name="passportnumbermedi" class="form-control" id="passportnumbermedi">
                                </div>
                                <div class="col">
                                <label for="medidob" class="form-label">Create Date</label>
                                    <input type="date" name="medidob" class="form-control" id="medidob"
                                        readonly>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-2" name="submit">Create Sponcer</button>

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tx-13" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
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
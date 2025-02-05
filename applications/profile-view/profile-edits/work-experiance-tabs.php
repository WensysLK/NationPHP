<a type="button"  class="btn btn-primary btn-sm" style="float: right;" data-bs-toggle="modal" data-bs-target="#workAddinfonew">
    + Add New
</a>
<?php
// Check if 'client_id' is set in the URL
if (isset($_GET['client_id'])) {
    $client_id = $_GET['client_id'];

    // Prepare and execute the query
    $sqlwork = "SELECT w.`workId`, w.`workPosition`, w.`workCompany`, w.`workCountry`, w.`workStart`, w.`workEnd`, w.`createdAt`, 
                       ad.`attachFilename`, ad.`attachemnt`
                FROM `worke` w
                LEFT JOIN `attachemnts_data` ad ON w.`workId` = ad.`attachmentsourceId` AND ad.`attachmentType` = 'WorkExperience'
                WHERE w.`softdeletestatus`=1 AND w.`workClinetID` = ?";
    $stmt2 = $conn->prepare($sqlwork); // Use prepared statements to avoid SQL injection
    $stmt2->bind_param("i", $client_id); // Bind the client ID as an integer
    $stmt2->execute();
    $result2 = $stmt2->get_result(); // Get the result set
    
    // Check if data exists
    if ($result2->num_rows > 0) {
        echo '<div class="card-body p-0">';
        echo '<h4>Work Experiance</h4>';
        echo '<table id="workTable" class="table table-striped table-bordered mt-2" style="width:100%">'; // Ensure proper class for DataTable
        echo '<thead>';
        echo '<tr>';
        echo '<th>No</th>';
        echo '<th>Company Name</th>';
        echo '<th>Position</th>';
        echo '<th>Duration</th>';
        echo '<th>Country</th>';
        echo '<th>Attachment</th>'; // New Attachment column
        echo '<th>Actions</th>'; // Action column for edit and delete
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        $count = 1;
        // Loop through the results and display in the table
        while ($row = $result2->fetch_assoc()) {
            // Calculate the duration between `workStart` and `workEnd`
            $start = new DateTime($row['workStart']);
            $end = ($row['workEnd'] !== null) ? new DateTime($row['workEnd']) : new DateTime(); // If still working, set to current date
            $interval = $start->diff($end);
            $duration = $interval->y . ' years ' . $interval->m . ' months';

            echo '<tr>';
            echo '<td>' . $count . '</td>';
            echo '<td>' . $row['workCompany'] . '</td>';
            echo '<td>' . $row['workPosition'] . '</td>';
            echo '<td>' . $duration . '</td>';
            echo '<td>' . $row['workCountry'] . '</td>';

            // Check if an attachment exists
            if (!empty($row['attachFilename'])) {
                // Display the attachment with a hyperlink to download/view
                echo '<td><a href="../../uploads/work-certificate/' . $row['attachemnt'] . '" target="_blank">' . $row['attachFilename'] . '</a></td>';
            } else {
                // No attachments found
                echo '<td>No attachments</td>';
            }

            // Action buttons for editing and deleting work experience
            echo '<td>';
            echo '<a href="edit_work.php?id=' . $row['workId'] . '" class="btn btn-primary btn-sm">Edit</a> ';
            echo '<a href="delete_work.php?id=' . $row['workId'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this work experience?\')">Delete</a>';
            echo '</td>';
            echo '</tr>';

            $count++;
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
        // No data found message
        echo '<div class="alert alert-warning">No work experience found for this client.</div>';
    }

    // Close the statement and connection
    $stmt2->close(); 
}
?>

<div class="modal fade" id="workAddinfonew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel3">Add Proffessional Qualification Details</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registrationForm" method="post"  action="Functions/work_precheck.php"">
                <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id ?>">

                <div class="mb-5">
                    <?php
                    //include('../includes/db_config.php');
                    // Fetch countries from the database
                    $sql = "SELECT countryID, countryName FROM list_of_countries ORDER BY countryName ASC";
                    $result = $conn->query($sql);

                    $countries = [];
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $countries[] = $row;
                        }
                    }
                    ?>


                    <!-- Work Experience Section -->
                    <div class="row mt-2 experience-fields" >
                        <hr>
                        <h4>Work Experience Details</h4>
                        <div id="experienceContainer">
                            <!-- Initial set of job experience fields -->
                            <div class="experience-entry row">
                                <div class="col p-2">
                                    <label class="form-label">Position</label>
                                    <input class="form-control" type="text" name="workposition">
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">Company Name</label>
                                    <input class="form-control" type="text" name="CompanyName">
                                </div>

                                <div class="col p-2">
                                    <label class="form-label">Country</label>
                                    <select class="form-control" name="JobCountry">
                                        <option value="">Select Country</option>
                                        <?php foreach ($countries as $country): ?>
                                            <option value="<?php echo htmlspecialchars($country['countryName']); ?>">
                                                <?php echo htmlspecialchars($country['countryName']); ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">Job Started</label>
                                    <input class="form-control" type="date" name="yearstart">
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">Job Ended</label>
                                    <input class="form-control" type="date" name="yearEnd">
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">Attach Certificate</label>
                                    <input type="file" class="form-control" name="jobcertificate">
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Training Section: Will only appear if work experience is 'No' -->
                    <div class="row mt-2 training-fields" style="display: none;">
                        <hr>
                        <h4>Training Details</h4>
                        <div class="col p-2">
                            <label class="form-label">Have you completed training?</label>
                            <select name="hasTraining" class="form-control" onchange="toggleTrainingFields(this)">
                                <option value="none" >Select Option</option>
                                <option value="yes">Yes</option>
                                <option value="no" selected >No</option>
                            </select>
                        </div>

                        <!-- Training Details Section -->
                        <div class="row mt-2 training-details" style="display: none;">
                            <div class="col p-2">
                                <label class="form-label">Training Date</label>
                                <input class="form-control" type="date" name="trainingDate">
                            </div>
                            <div class="col p-2">
                                <label class="form-label">Duration</label>
                                <input class="form-control" type="text" name="trainingDuration">
                            </div>
                            <div class="col p-2">
                                <label class="form-label">Training Center</label>
                                <select name="trainingCentre" id="trainingCenterDropdown" class="form-control">
                                    <option value="">Select Training Center</option>
                                </select>
                            </div>
                            <div class="col p-2">
                                <label class="form-label">Training Program</label>
                                <select name="trainingProgram" id="trainingProgramDropdown" class="form-control">
                                    <option value="">Select Training Program</option>
                                </select>
                            </div>
                            <div class="col p-2">
                                <label class="form-label">Certificate</label>
                                <input class="form-control" type="file" name="trainingcertificate">
                            </div>
                            <div class="col p-2">
                                <label class="form-label">Remarks</label>
                                <input class="form-control" type="text" name="trainingRemarks">
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Function to show/hide work experience and training fields
    function toggleExperienceFields(select) {
        const experienceFields = document.querySelector('.experience-fields');
        const trainingFields = document.querySelector('.training-fields');

        if (select.value === 'yes') {
            experienceFields.style.display = 'block';
            trainingFields.style.display = 'none'; // Hide training fields
        } else if (select.value === 'no') {
            experienceFields.style.display = 'none'; // Hide experience fields
            trainingFields.style.display = 'block'; // Show training dropdown
        } else {
            experienceFields.style.display = 'none';
            trainingFields.style.display = 'none';
        }
    }

    // Function to show/hide training details based on training completion
    function toggleTrainingFields(select) {
        const trainingDetails = document.querySelector('.training-details');

        if (select.value === 'yes') {
            trainingDetails.style.display = 'block'; // Show training details
        } else {
            trainingDetails.style.display = 'none'; // Hide training details
        }
    }

    // Function to add a new work experience entry
    function addExperience() {
        const experienceContainer = document.getElementById('experienceContainer');
        const newEntry = document.createElement('div');
        newEntry.className = 'experience-entry row mt-2';

        newEntry.innerHTML = `
            <div class="col p-2">
                <label class="form-label">Position</label>
                <input class="form-control" type="text" name="workposition[]">
            </div>
            <div class="col p-2">
                <label class="form-label">Company Name</label>
                <input class="form-control" type="text" name="CompanyName[]">
            </div>
            <div class="col p-2">
                <label class="form-label">Country</label>
                <select class="form-control" name="JobCountry[]">
                    <option value="">Select Country</option>
                    <?php foreach ($countries as $country): ?>
                    <option value="<?php echo htmlspecialchars($country['countryName']); ?>">
                        <?php echo htmlspecialchars($country['countryName']); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col p-2">
                <label class="form-label">Job Started</label>
                <input class="form-control" type="date" name="yearstart[]">
            </div>
            <div class="col p-2">
                <label class="form-label">Job Ended</label>
                <input class="form-control" type="date" name="yearEnd[]">
            </div>
            <div class="col p-2">
                <label class="form-label">Attach Certificate</label>
                <input type="file" class="form-control" name="jobcertificate[]">
            </div>
            <div class="col p-2">
                <label> </label>
                <button type="button" onclick="removeExperience(this)" class="btn btn-danger mt-4">-</button>
            </div>
        `;

        experienceContainer.appendChild(newEntry);
    }

    // Function to remove a work experience entry
    function removeExperience(button) {
        const experienceEntry = button.closest('.experience-entry');
        experienceEntry.remove();
    }
</script>

<script>
    // Fetch training centers and programs from your PHP API and populate the dropdowns
    function fetchTrainingData() {
        fetch('./api-requests/fetch_training_data.php') // Adjust the path to your PHP file
            .then(response => response.json())
            .then(data => {
                const centerDropdown = document.getElementById('trainingCenterDropdown');
                const programDropdown = document.getElementById('trainingProgramDropdown');

                // Populate training centers
                centerDropdown.innerHTML = '<option value="">Select Training Center</option>';
                data.centers.forEach(center => {
                    const option = document.createElement('option');
                    option.value = center.centerID;
                    option.text = center.centerName;
                    centerDropdown.add(option);
                });

                // Populate training programs
                programDropdown.innerHTML = '<option value="">Select Training Program</option>';
                data.programs.forEach(program => {
                    const option = document.createElement('option');
                    option.value = program.programID;
                    option.text = program.programName;
                    programDropdown.add(option);
                });

            })
            .catch(error => console.error('Error fetching training data:', error));
    }

    // Call fetchTrainingData when the DOM is loaded
    document.addEventListener('DOMContentLoaded', fetchTrainingData);
</script>
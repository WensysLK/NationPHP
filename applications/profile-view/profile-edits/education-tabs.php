<a type="button"  class="btn btn-primary btn-sm" style="float: right;" data-bs-toggle="modal" data-bs-target="#eduAddinfonew">
    + Add New
</a>
<?php
// Check if 'client_id' is set in the URL
if (isset($_GET['client_id'])) {
    $client_id = $_GET['client_id'];
    

    // Prepare and execute the query to get education and attachment details for the client
    $sqleducation = "SELECT ed.educationId, ed.schoolName, ed.edutype, ed.educationYear, 
                            ad.attachFilename, ad.attachemnt
                     FROM education_details ed
                     LEFT JOIN attachemnts_data ad ON ed.educationId = ad.attachmentsourceId 
                     AND ad.attachemnet_ClientID = ed.educationClientId 
                     AND ad.attachmentType = 'Education-Certificate'
                     WHERE ed.educationClientId = ? 
                     AND ed.softdeletestatus = 1";
    
    $stmt8 = $conn->prepare($sqleducation); // Use prepared statements to avoid SQL injection
    $stmt8->bind_param("i", $client_id); // Bind the client ID as an integer
    $stmt8->execute();
    $result8 = $stmt8->get_result(); // Get the result set
    
    // Check if data exists
    if ($result8->num_rows > 0) {
        echo '<div class="card-body p-0">';
        echo '<table id="educationTable" class="table table-striped table-bordered mt-2" style="width:100%">'; // Add id="educationTable"
        echo '<thead>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>School Name</th>';
        echo '<th>Type of Education</th>';
        echo '<th>Year of Education</th>';
        echo '<th>Attachment</th>'; // New Attachment column
        echo '<th>Actions</th>'; // New Actions column
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        $num = 1;
        // Loop through the education records and check for attachments
        while ($row = $result8->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $num++ . '</td>';
            echo '<td>' . $row['schoolName'] . '</td>';
            echo '<td>' . $row['edutype'] . '</td>';
            echo '<td>' . $row['educationYear'] . '</td>';

            // Check if an attachment exists
            if (!empty($row['attachFilename'])) {
                // Display the attachment with a hyperlink to download/view
                echo '<td><a href="../../uploads/education_certificates/' . $row['attachFilename'] . '" target="_blank">' . $row['attachFilename'] . '</a></td>';
            } else {
                // No attachments found
                echo '<td>No attachments</td>';
            }

            // Adding Edit and Delete buttons
            echo '<td>';
            echo '<a href="edit_education.php?id=' . $row['educationId'] . '" class="btn btn-warning btn-sm">Edit</a> ';
            echo '<a href="delete_education.php?id=' . $row['educationId'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this education record?\');">Delete</a>';
            echo '</td>';

            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
        // No education details found
        echo '<div class="alert alert-warning">No education details found for this client.</div>';
    }

    // Close the statement and connection
    $stmt8->close();
}
?>
<div class="modal fade" id="eduAddinfonew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel3">Add Educational Qalification Details</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registrationForm" method="post"  action="Functions/education_precheck.php"">
                <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id ?>">

                <div class="">
                    <div id="educationContainer">
                        <!-- Initial set of education fields -->
                        <div class="education-entry row">
                            <div class="col">
                                <label>School Name</label>
                                <input class="form-control" type="text" name="schoolname">
                            </div>
                            <div class="col">
                                <label>OL/AL</label>
                                <select name="edulevel" class="form-select form-control" onchange="handleEduLevelChange(this)"
                                >
                                    <option value="al">Advance Level</option>
                                    <option value="ol">Ordinary Level</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="status" class="form-label ">Year</label>
                                <input type="number" class="form-control" name="eduyear" id="eduyear">
                            </div>
                            <div class="col">
                                <label for="status" class="form-label ">Attach Certificate</label>
                                <input type="file" class="form-control" name="certificate" id="certificate">
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


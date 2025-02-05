<a href="#" class="btn btn-primary btn-sm" style="float: right;">
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


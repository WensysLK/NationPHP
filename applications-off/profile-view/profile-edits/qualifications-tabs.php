<a href="#" class="btn btn-primary btn-sm" style="float: right;">
                    + Add New
                </a>
<?php
// Check if 'client_id' is set in the URL
if (isset($_GET['client_id'])) {
    $client_id = $_GET['client_id'];

    // Prepare and execute the query
    $sqlqualification = "SELECT pq.`Qualification_ID`, pq.`institueName`, pq.`courseName`, pq.`Qualification_Duration`, pq.`Qualification_Status`, ad.`attachFilename`, ad.`attachemnt` 
                         FROM `professional_qualifications` pq
                         LEFT JOIN `attachemnts_data` ad ON pq.`Qualification_ID` = ad.`attachmentsourceId` 
                         AND ad.`attachmentType` = 'qualification'
                         WHERE pq.`softdeletestatus`=1 AND pq.`QulificationClientID` = ?";
    $stmt1 = $conn->prepare($sqlqualification); // Use prepared statements to avoid SQL injection
    $stmt1->bind_param("i", $client_id); // Bind the client ID as an integer
    $stmt1->execute();
    $result1 = $stmt1->get_result(); // Get the result set

    // Check if data exists
    if ($result1->num_rows > 0) {
        echo '<div class="card-body p-0">';
        echo '<table id="qualificationTable" class="table table-striped table-bordered mt-2" style="width:100%">'; // Ensure proper class for DataTable
        echo '<thead>';
        echo '<tr>';
        echo '<th>No</th>';
        echo '<th>Institute Name</th>';
        echo '<th>Course Name</th>';
        echo '<th>Duration</th>';
        echo '<th>Status</th>';
        echo '<th>Attachment</th>'; // Added Attachment column
        echo '<th>Actions</th>'; // Added Actions column
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        $count = 1;
        // Loop through the results and display in the table
        while ($row = $result1->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $count . '</td>';
            echo '<td>' . $row['institueName'] . '</td>';
            echo '<td>' . $row['courseName'] . '</td>';
            echo '<td>' . $row['Qualification_Duration'] . '</td>';
            echo '<td>' . $row['Qualification_Status'] . '</td>';
            
            // Display the attachment with a hyperlink to download/view
            if (!empty($row['attachFilename'])) {
                echo '<td><a href="../../uploads/attachments/' . $row['attachemnt'] . '" target="_blank">' . $row['attachFilename'] . '</a></td>';
            } else {
                echo '<td>No attachment</td>';
            }

            // Adding Edit and Delete buttons
            echo '<td>';
            echo '<a href="#" class="btn btn-warning btn-sm">Edit</a> ';
            echo '<a href="#" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this qualification?\');">Delete</a>';
            echo '</td>';

            echo '</tr>';

            $count++;
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
        // No data found message
        echo '<div class="alert alert-warning">No professional qualifications found for this client.</div>';
    }

    // Close the statement and connection
    $stmt1->close();
}
?>

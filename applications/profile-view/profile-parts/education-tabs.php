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

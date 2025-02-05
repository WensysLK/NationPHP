<a href="#" class="btn btn-primary btn-sm" style="float: right;">
                    + Add New
                </a>
<?php
// Check if 'client_id' is set in the URL
if (isset($_GET['client_id'])) {
    $client_id = $_GET['client_id'];

    // Prepare and execute the query
    $sqlAttachments = "SELECT `attachemnetId`, `attachmentsourceId`, `attachmentType`, `attachemnt`, `attachFilename` 
                       FROM `attachemnts_data` 
                       WHERE `softdeletestatus` = 1 AND `attachemnet_ClientID` = ?";
    $stmt4 = $conn->prepare($sqlAttachments); // Use prepared statements to avoid SQL injection
    $stmt4->bind_param("i", $client_id); // Bind the client ID as an integer
    $stmt4->execute();
    $result4 = $stmt4->get_result(); // Get the result set

    // Check if data exists
    if ($result4->num_rows > 0) {
        echo '<div class="card-body p-0">';
        echo '<table id="attachmentTable" class="table table-striped table-bordered mt-2" style="width:100%">'; 
        echo '<thead>';
        echo '<tr>';
        echo '<th>No.</th>';
        echo '<th>Attachment Type</th>';
        echo '<th>File Name</th>';
        echo '<th>Actions</th>'; // Action buttons for View, Edit, and Delete
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // Loop through the results and display them in the table
        $num = 1;
        while ($row = $result4->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $num++ . '</td>';
            echo '<td>' . $row['attachmentType'] . '</td>';
            
            // Display the file name as a hyperlink using the full file path in the 'attachemnt' column
            echo '<td><a href="' . $row['attachemnt'] . '" target="_blank">' . $row['attachFilename'] . '</a></td>';

            // Action buttons for Edit, View, and Delete
            echo '<td>';
            echo '<a href="view_attachment.php?id=' . $row['attachemnetId'] . '" class="btn btn-info btn-sm">View</a> '; // View button
            echo '<a href="edit_attachment.php?id=' . $row['attachemnetId'] . '" class="btn btn-primary btn-sm">Edit</a> '; // Edit button
            echo '<a href="delete_attachment.php?id=' . $row['attachemnetId'] . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete this attachment?\')">Delete</a>'; // Delete button
            echo '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
        // No data found message
        echo '<div class="alert alert-warning">No attachments found for this client.</div>';
    }

    // Close the statement and connection
    $stmt4->close();
    $conn->close();
}
?>

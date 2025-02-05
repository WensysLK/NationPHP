<a type="button"  class="btn btn-primary btn-sm" style="float: right;" data-bs-toggle="modal" data-bs-target="#quliAddinfonew">
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
    $result1 = $stmt1->get_result();


    // Get the result set

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
            echo '<a type="button"  class="btn btn-warning btn-sm"  data-bs-toggle="modal" data-bs-target="#quliEditinfonew">Edit</a> ';

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
<div class="modal fade" id="quliAddinfonew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel3">Add Proffessional Qualification Details</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registrationForm" method="post"  action="Functions/qulification_precheck.php"">
                <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id ?>">

                <div class="">
                    <div id="coursesContainer">
                        <!-- Initial set of course fields -->
                        <div class="course-entry row">
                            <div class="col">
                                <label>Name Of Institute</label>
                                <input class="form-control" type="text" name="institueName">
                            </div>
                            <div class="col">
                                <label>Course Name</label>
                                <input class="form-control" type="text" name="CourseName">
                            </div>
                            <div class="col">
                                <label for="status" class="form-label">Status</label>
                                <select name="CourseStatus" class="form-select" >
                                    <option value="Pending">Pending</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="duration" class="form-label">Duration</label>
                                <input type="text" class="form-control" name="duration" id="duration">
                            </div>
                            <div class="col">
                                <label for="status" class="form-label ">Attach Certificate</label>
                                <input type="file" class="form-control" name="courcecertificate" id="">
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
<div class="modal fade" id="quliEditinfonew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel3">Add Proffessional Qualification Details</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php var_dump($result1->fetch_assoc()); ?>
                <form id="registrationForm" method="post"  action="Functions/qulification_precheck.php"">
                <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id ?>">
                <input type="hidden" name="parentid" id="parentid" value="<?php echo $row['Qualification_ID'] ?>">

                <div class="">
                    <div id="coursesContainer">
                        <!-- Initial set of course fields -->
                        <div class="course-entry row">
                            <div class="col">
                                <label>Name Of Institute</label>
                                <input class="form-control" type="text" name="institueName"value="<?php echo $row['institueName'] ?>">
                            </div>
                            <div class="col">
                                <label>Course Name</label>
                                <input class="form-control" type="text" name="CourseName"value="<?php echo $row['courseName'] ?>">
                            </div>
                            <div class="col">
                                <label for="status" class="form-label">Status</label>
                                <select name="CourseStatus" class="form-select" >
                                    <?php if ($row['Qualification_Duration'] == "Pending"){ ?>
                                    <option value="Pending" selected>Pending</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Completed">Completed</option>
                                    <?php }elseif ($row['Qualification_Duration'] == "In Progress"){ ?>
                                    <option value="Pending" >Pending</option>
                                    <option value="In Progress"selected>In Progress</option>
                                    <option value="Completed">Completed</option>
                                    <?php }elseif ($row['Qualification_Duration'] == "Completed"){ ?>
                                    <option value="Pending" >Pending</option>
                                    <option value="In Progress">In Progress</option>
                                    <option value="Completed" selected>Completed</option>
                                     <?php } ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="duration" class="form-label">Duration</label>
                                <input type="text" class="form-control" name="duration" id="duration" value="<?php echo $row['Qualification_Status'] ?>">
                            </div>
                            <div class="col">
                                <label for="status" class="form-label ">Attach Certificate</label>
                                <input type="file" class="form-control" name="courcecertificate" id="">
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

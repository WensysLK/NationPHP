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
    ?>
<?php   if ($result4->num_rows > 0) { ?>
<div class="card-body p-0">
   <table id="attachmentTable" class="table table-striped table-bordered mt-2" style="width:100%">
      <thead>
      <tr>
          <th>No.</th>
           <th>Attachment Type</th>
           <th>File Name</th>
          <th>Action</th>
          </tr>
     </thead>
      <tbody>
      <?php
      $num = 1;
      while ($row = $result4->fetch_assoc()) {?>
        <tr>
           <td><?php echo $num?></td>
           <td><?php echo $row['attachmentType'] ?></td>
           <td><a href="" target="_blank"><?php echo $row['attachFilename'] ?></a></td>

      <?php }?>
     </tbody>
   </table>
  </div>
      <?php }?>
<?php
    // Close the statement and connection
    $stmt4->close();
    $conn->close();
}
?>

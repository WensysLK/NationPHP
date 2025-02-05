<?php

include('../includes/db_config.php');

?>
<table id="viewclints" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Passport</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
                        $sqlapplication = "SELECT a.*, c.* FROM applications a
                        JOIN contact_information c ON a.applicationID = c.applicant_id
                        WHERE a.softdeletStatus = 1;";
                        
                        $resapplication = mysqli_query($conn,$sqlapplication);
                        
                        if($resapplication==true){
                            $count_rows = mysqli_num_rows($resapplication);
                            $num = 1;
                           
                            if($count_rows>0){
                                while($row=mysqli_fetch_assoc($resapplication)){
                                  $applicationID = $row['applicationID'];
                                  $applicationTitle = $row['applicantTitle'];
                                  $applicationFname = $row['applicatFname'];
                                  $applcationMname = $row['applicantMname'];
                                  $applicationLname = $row['applicantLname'];
                                  $applicationPassport = $row['applicantPassno'];
                                  $applicationPhone = $row['applicant_phone'];
                                  $applicationEmial = $row['applicant_email'];
                                 /* $profilepciture = $row[''];  */
                              
                               echo $applicationID;
                                ?>
        <tr>
            <td>1</td>
            <td>
                <div class="d-flex align-items-center">
                <?php if (!empty($cprofile_img) && file_exists('img/profile/' . $cprofile_img)) : ?>
                    <img class="rounded-circle" style="width: 40px; height: 40px;"
                        src="img/profile/<?php echo $cprofile_img; ?>" />
                    <?php else : ?>
                    <img class="rounded-circle" style="width: 40px; height: 40px;" src="img/fallback-image.png"
                        alt="Fallback Image" />
                    <?php endif; ?>
                    <div class="ms-2">
                        <?php echo $applicationTitle . "." . $applicationFname . " " . $applicationLname; ?></div>
                </div>
            </td>
            <td><?php echo $applicationEmial; ?></td>
            <td><?php echo $applicationPhone; ?></td>
            <td><?php echo $applicationPassport; ?></td>
            <td>
                <button href="" class="btn btn-primary btn-sm lni lni-pencil"></button>
                <a href="#"
                    class="btn btn-success btn-sm lni lni-eye"></a>
                <button href="#" class="btn btn-danger btn-sm lni lni-trash"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
        <?php } } }?>
        <!-- Add more rows as needed -->
    </tbody>
</table>

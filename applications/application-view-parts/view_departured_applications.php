<table id="viewclints" class="table table-striped table-bordered mt-2" style="width:100%">

    <?php
                        $sqlapplication = "SELECT a.*, c.*
                        FROM applications a
                        LEFT JOIN contact_information c ON a.applicationID = c.applicant_id
                        WHERE a.softdeletStatus = 1 AND a.ContractCreated = 2";
     

                        
                        $resapplication = mysqli_query($conn,$sqlapplication);
                        
                        if($resapplication==true){
                            $count_rows = mysqli_num_rows($resapplication);
                            $num = 1;
                           
                            if($count_rows>0){?>
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
                              
                               
                                ?>
        <tr>
            <td>1</td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center">

                        <img class="rounded-circle" style="width: 40px; height: 40px;"
                            src="../uploads/img/fallback-image.png" alt="Fallback Image" />

                        <div class="ms-2">
                            <?php echo $applicationTitle . "." . $applicationFname . " " . $applicationLname; ?>
                        </div>
                    </div>
                    <div class="ms-2">
                        <?php echo $applicationTitle . "." . $applicationFname . " " . $applicationLname; ?>
                    </div>
                </div>
            </td>
            <td><?php echo $applicationEmial; ?></td>
            <td><?php echo $applicationPhone; ?></td>
            <td><?php echo $applicationPassport; ?></td>
            <td>
                <button href="" class="btn btn-primary btn-sm lni lni-pencil"><svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2">
                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                    </svg></button>
                <a href="profile-view/application-profile.php?client_id=<?php echo $applicationID;?>" class="btn btn-success btn-sm lni lni-eye"><svg xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg></a>
                <button href="#" class="btn btn-danger btn-sm lni lni-trash"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>
        <?php } }else{
            
            echo "<div class='alert alert-primary mt-2' role='alert'> No Departure Applications !</div>";
            
            
            } }?>
        <!-- Add more rows as needed -->
    </tbody>
</table>
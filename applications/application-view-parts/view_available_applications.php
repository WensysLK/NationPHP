<table id="viewclints" class="table table-striped table-bordered mt-2" style="width:100%">
    <?php
        $sqlapplication = "SELECT a.*, c.* FROM applications a
                           LEFT JOIN contact_information c ON a.applicationID = c.applicant_id
                           WHERE a.softdeletStatus = 1 AND a.ContractCreated = 0 AND a.applicantStatus = 'Completed'";

        $resapplication = mysqli_query($conn,$sqlapplication);

        if($resapplication == true) {
            $count_rows = mysqli_num_rows($resapplication);
            $num = 1;

            if($count_rows > 0) { ?>
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
                    <?php while($row = mysqli_fetch_assoc($resapplication)) {
                        $applicationID = $row['applicationID'];
                        $applicationTitle = $row['applicantTitle'];
                        $applicationFname = $row['applicatFname'];
                        $applicationLname = $row['applicantLname'];
                        $applicationPassport = $row['applicantPassno'];
                        $applicationPhone = $row['applicant_phone'];
                        $applicationEmial = $row['applicant_email'];
                        $profilepciture = $row['profile_image']; 
                              
                                  $profileImage = $baseUrl.'/uploads/profile_images/'.$profilepciture;

                                  $fallbackimage = '../uploads/img/fallback-image.png';
 
                                  // Check if image path exists and is not empty
 $imgSrc = !empty($profileImage) ? $profileImage : $fallbackimage;
                        
                    ?>
                    <tr>
                        <td><?php echo $num++; ?></td>
                        <td>
                            <div class="d-flex align-items-center">
                            <img class="rounded-circle" style="width: 40px; height: 40px;"
                            src="<?php echo $imgSrc; ?>" alt="Fallback Image" />
                                <div class="ms-2">
                                    <?php echo $applicationTitle . " " . $applicationFname . " " . $applicationLname; ?>
                                </div>
                                
                            </div>
                        </td>
                        <td><?php echo $applicationEmial; ?></td>
                        <td><?php echo $applicationPhone; ?></td>
                        <td><?php echo $applicationPassport; ?></td>
                        <td>
                        <form action="profile-view/application-profile-edit.php?client_id=<?php echo $applicationID;?>" style="display: inline-block;" method="POST">
                                <input type="hidden" name="applicationID" value="<?php echo $applicationID; ?>">
                                <button type="submit" class="btn btn-primary btn-sm lni lni-pencil">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                </button>
                            </form>
                            <a href="profile-view/application-profile.php?client_id=<?php echo $applicationID;?>" class="btn btn-success btn-sm lni lni-eye">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </a>
                            <form id="registrationForm" method="post"  action="Functions/delete_application_data.php"style="display:inline;">
                                <!--        <form method="POST" action="Funtions/delete_license_precheck.php" style="display:inline;">-->
                                <input type="hidden" name="applicationID" value="<?php echo $applicationID; ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Application?');">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            <?php } else {
                echo "<div class='alert alert-primary mt-2' role='alert'> No Available Applications !</div>";
            }
        } ?>
</table>

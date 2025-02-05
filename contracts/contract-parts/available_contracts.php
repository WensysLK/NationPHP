<table id="viewclints" class="table table-striped table-bordered mt-4" style="width:100%">
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
                        $sqlapplication = "SELECT a.*, c.*
                        FROM applications a
                        LEFT JOIN contact_information c ON a.applicationID = c.applicant_id
                        WHERE a.softdeletStatus = 1 AND a.ContractCreated = 0 AND a.applicantStatus='Completed'";
     


                        
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
                                 $profilepciture = $row['profile_image'];  
                                
                                 $profileImage = '../uploads/profile_images/'.$profilepciture;

                                 $fallbackimage = '../uploads/img/fallback-image.png';

                                 // Check if image path exists and is not empty
$imgSrc = !empty($profileImage) ? $profileImage : $fallbackimage;

                                ?>
        <tr>
            <td><?php echo $num++; ?></td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center">

                        <img class="rounded-circle" style="width: 40px; height: 40px;"
                            src="<?php echo $imgSrc; ?>" alt="Fallback Image" />

                        <div class="ms-2">
                            <?php echo $applicationTitle . "." . $applicationFname . " " . $applicationLname; ?>
                        </div>
                    </div>
                </div>
            </td>
            <td><?php echo $applicationEmial; ?></td>
            <td><?php echo $applicationPhone; ?></td>
            <td><?php echo $applicationPassport; ?></td>
            <td>


                <a href="#modal6" class="btn btn-primary btn-sm lni " data-bs-toggle="modal" data-animation="effect-slide-in-bottom">
                    <svg
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-file-plus">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">

                        </path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="12" y1="18" x2="12" y2="12"></line>
                        <line x1="9" y1="15" x2="15" y2="15"></line>
                    </svg>
                </a>
<!--                <a href="" class="btn btn-primary btn-sm lni ">-->
<!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"-->
<!--                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"-->
<!--                        class="feather feather-edit">-->
<!--                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>-->
<!--                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>-->
<!--                    </svg>-->
<!--                </a>-->

<!--                <a type="button"  class="btn btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#modal7">-->
<!---->
<!--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"-->
<!--                        stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"-->
<!--                        class="feather feather-eye">-->
<!--                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>-->
<!--                        <circle cx="12" cy="12" r="3"></circle>-->
<!--                    </svg>-->
<!--                </a>-->
                <a href="#" class="btn btn-danger btn-sm lni lni-trash"><i class="fas fa-trash-alt"></i></a>
            </td>
        </tr>
        <?php } } }

                        ?>
        <!-- Add more rows as needed -->
    </tbody>
</table>

<?php include('popups/create_contract_form.php'); ?>
<div class="modal fade" id="modal7" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel6">Create Contract</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../contracts/contract-process/create_contract.php" method="POST"
                      enctype="multipart/form-data">
                    <input type="hidden" name="appId" value="<?php echo $applicationID; ?>">
                    <div class="row">
                        <div class="col-4">
                            <img src="../uploads/img/fallback-image.png" class="img-fluid" alt="Responsive image">
                        </div>
                        <div class="col-6">
                            <p><b>Client Name :</b>
                                <?php echo $applicationTitle . "." . $applicationFname . " " . $applicationLname; ?>
                                <br><b>Passport No :</b> <?php echo $applicationPassport; ?>
                            </p>
                            <?php   $contact_details= "SELECT * 
                        FROM  contract_details WHERE applicationID = ? ";

                            $stmt = $conn->prepare($contact_details);
                            $stmt->bind_param("i", $applicationID);
                            $stmt->execute();
                            $result_n = $stmt->get_result();
                            $rownew = $result_n->fetch_assoc();
                            var_dump($applicationID);

                            ?>
                            <label for="contractType">Contract Type</label>
                            <select name="contractType" class="form-control">
                                <option value="none" selected>select Type</option>
                                <option value="domestic">Domestic</option>
                                <option value="non-domestic">Non-Domestic</option>
                            </select>

                            <!-- Checkboxes for options -->
                            <div class="mt-3">
                                <h6>Contract Options:</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="options[]" value="muzaned" id="muzaned">
                                    <label class="form-check-label" for="muzaned">
                                        Muzaned
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="options[]" value="enjaze" id="enjaze">
                                    <label class="form-check-label" for="enjaze">
                                        Enjaze
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="options[]" value="fingerprint" id="fingerprint">
                                    <label class="form-check-label" for="fingerprint">
                                        Finger Print
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-2" name="submit">Create Contract</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tx-13" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
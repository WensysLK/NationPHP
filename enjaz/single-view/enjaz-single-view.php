<div class="page-content-wrapper">
            <div class="page-content">
                <!--breadcrumb-->
                <div class="page-breadcrumb d-none d-md-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">User Profile</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class='bx bx-home-alt'></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="ms-auto">
                        <?php include("Enjaz-form-Control/Enjaz-profile-buttons.php"); ?>
                    </div>
                </div>
                <!--end breadcrumb-->

                <div class="user-profile-page">
                    <div class="card radius-15">
                        <div class="card-body">
                            <?php
							    if(isset($_GET['EnjazID'])){

							    $enjaz_id = $_GET['EnjazID'];
							    $sqlenjaztdata = "SELECT e.*, c.*
                                FROM enjazexp e
                                JOIN clientlist c ON e.ClientId = c.client_id
                                WHERE e.EnjazID = $enjaz_id";
							    $resenjaz = mysqli_query($conn,$sqlenjaztdata);
							    if($rowenjaz = mysqli_fetch_assoc($resenjaz)){
                                    //Enjaz Data
                                    $EnjazID = $rowenjaz['EnjazID'];
                                    $EappDate = $rowenjaz['EappDate'];
                                    $ClientId = $rowenjaz['ClientId'];
                                    $enjazDoB = $rowenjaz['enjazDoB'];
                                    $clinetPassport = $rowenjaz['clinetPassport'];
                                    $enjSponcer = $rowenjaz['enjSponcer'];
                                    $enjVIsacategory = $rowenjaz['enjVIsacategory'];
                                    $enjVisano = $rowenjaz['enjVisano'];
                                    $enjREF = $rowenjaz['enjREF'];
                                    $anjazPosition = $rowenjaz['anjazPosition'];
                                    $createdby = $rowenjaz['createdby'];
                                    $createdAt = $rowenjaz['createdAt'];
                                    $updatedby = $rowenjaz['updatedby'];
                                    $Updated_At = $rowenjaz['Updated_At'];
                                    $softdeletestatus = $rowenjaz['softdeletestatus'];
                                    $EnjazFullStatus = $rowenjaz['EnjazFullStatus'];
                                    $processType = $rowenjaz['processType'];
                                    //client Data
                                    $client_id = $rowenjaz['client_id'];
                                    $clientSerialNumber = $rowenjaz['SerialNumber'];
                                    $clientTitle = $rowenjaz['clientTitle'];
                                    $client_fname = $rowenjaz['client_fname'];
                                    $client_mname = $rowenjaz['client_mname'];
                                    $client_lname = $rowenjaz['client_lname'];
                                    $client_phone = $rowenjaz['client_phone'];
                                    $cphone2 = $rowenjaz['cphone2'];
                                    $land_phone_no = $rowenjaz['land_phone_no'];
                                    $client_birthday = $rowenjaz['client_birthday'];
                                    $clinet_passport = $rowenjaz['clinet_passport'];
                                    $clinet_passport_copy1 = $rowenjaz['clinet_passport_copy1'];
                                    $clinet_passport_copy2 = $rowenjaz['clinet_passport_copy2'];
                                    $cNicnumber = $rowenjaz['cNicnumber'];
                                    $client_FFno = $rowenjaz['client_FFno'];
                                    $cfileNo = $rowenjaz['cfileNo'];
                                    $cpassportExp = $rowenjaz['cpassportExp'];
                                    $client_email = $rowenjaz['client_email'];
                                    $client_address1 = $rowenjaz['client_address1'];
                                    $client_address2 = $rowenjaz['client_address2'];
                                    $client_city = $rowenjaz['client_city'];
                                    $client_province = $rowenjaz['client_province'];
                                    $gsdivision = $rowenjaz['gsdivision'];
                                    $clinet_photo = $rowenjaz['clinet_photo'];
                                    $cpass_photo = $rowenjaz['cpass_photo'];
                                    $nic_front = $rowenjaz['nic_front'];
                                    $nic_back = $rowenjaz['nic_back'];
                                    $createdOn = $rowenjaz['createdOn'];
                                    $createdby = $rowenjaz['createdby'];
                                    $client_remarks = $rowenjaz['client_remarks'];
                                    $relationship = $rowenjaz['relationship'];
                                    $main_acc_id = $rowenjaz['main_acc_id'];
                                    $passport_exp_date = $rowenjaz['passport_exp_date'];
                                    $status = $rowenjaz['status'];
                                    $RemarkFam = $rowenjaz['RemarkFam'];
                                    $FullImage = $rowenjaz['FullImage'];
                                    $subagentId = $rowenjaz['subagentId'];
                                    $cgender = $rowenjaz['cgender'];
                                    $creligion = $rowenjaz['creligion'];
                                    $crase = $rowenjaz['crase'];
                                    $cmstatus = $rowenjaz['cmstatus'];
                                    $cheight = $rowenjaz['cheight'];
                                    $cweight = $rowenjaz['cweight'];
                                    $cnationality = $rowenjaz['cnationality'];
                                    $cnicNo = $rowenjaz['cnicNo'];
                                    $appliedJobs = $rowenjaz['appliedJobs'];
                                    $howfoundus = $rowenjaz['howfoundus'];
                                    $appStatus = $rowenjaz['appStatus'];
                                    $inetrviewvideo = $rowenjaz['inetrviewvideo'];
                                    $softdeletestatus = $rowenjaz['softdeletestatus'];
                                    //Sponcer Name
                                  
                                

                                    ?>
                            <div class="row">
                                <div class="col-6 col-lg-7 border-right">
                                    <div class="d-md-flex align-items-center">
                                        <div class="mb-md-0 mb-3">
                                            <img src="img/profile/<?php echo $clinet_photo;?>"
                                                class="rounded-circle shadow" width="130" height="130" alt="" />
                                        </div>
                                        <div class="ms-md-4 flex-grow-1">
                                            <div class="d-flex align-items-center mb-1">
                                                <h4 class="mb-0">
                                                    <?php echo $clientTitle." ".$client_fname." ".$client_mname." ".$client_lname; ?>
                                                </h4>

                                            </div>
                                            <p class="mb-0 text-muted"><?php // echo $serialNumber; ?></p>
                                            <p class="text-primary"><i
                                                    class='bx bx-buildings'></i><?php echo $EnjazFullStatus;  ?></p>
                                            <button type="button" class="btn btn-primary">Connect</button>
                                            <button type="button" class="btn btn-outline-secondary ml-2">Resume</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-5">
                                    <div class="row pt-2">
                                        <div class="row">
                                            <div class="col">Phone No:</div>
                                            <div class="col"><?php echo $client_phone;  ?></div>
                                        </div>
                                        <div class="row pt-2">
                                            <div class="col">NIC No:</div>
                                            <div class="col"><?php echo $cnicNo;  ?></div>
                                        </div>
                                        <div class="row pt-2">
                                            <div class="col">Email:</div>
                                            <div class="col"><?php echo $client_email;  ?></div>
                                        </div>
                                        <div class="row pt-2">
                                            <div class="col ">Address:</div>
                                            <div class="col">
                                                <?php echo $client_address1 . "<br>" . $client_address2 . "<br>" . $client_city . ", " . $client_province.", ".$gsdivision;  ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <hr>
                                <h5>Enjaz Information</h5>
                                <div class="row pt-2">
                                    <div class="row">
                                        <div class="col">Passport No:<br><?php echo $clinet_passport;  ?></div>
                                        <div class="col">Visa Category:<br><?php echo $enjVIsacategory;  ?></div>
                                        <div class="col">Visa Number:<br><?php echo $enjVisano;  ?></div>
                                        <div class="col">Sponcer Name:<br><?php echo $enjSponcer; ?></div>
                                        <div class="col">Enjaz REF:<br><?php echo $enjREF;  ?></div>
                                        <div class="col">Enjaz App Date:<br><?php echo $EappDate;  ?></div>
                                        <div class="col">Position:<br><?php echo $anjazPosition;  ?></div>
                                        <?php

							}

							?><?php



							}

                            if(isset($_GET['fAgentID'])) {
                                $fagent_id = $_GET['fAgentID']; // Assuming fAgentID is passed via GET parameter
                            
                                // Query to calculate available visa count
                                $sqlvisaavailability =  "SELECT f.*, v.*, 
                                                                v.VisaQty - COALESCE(SUM(j.jobQty), 0) AS RemainingQty
                                                         FROM fagent f
                                                         LEFT JOIN visadetails v ON f.fAgentID = v.fAgentID
                                                         LEFT JOIN joborder j ON v.VisaID = j.visaID
                                                         WHERE f.softdeletestatus = 1 AND f.fAgentID = $fagent_id
                                                         GROUP BY f.fAgentID, v.VisaID";
                            
                                $resfagentavailable = mysqli_query($conn, $sqlvisaavailability);
                            
                                if($resfagentavailable && mysqli_num_rows($resfagentavailable) > 0) {
                                    $rowfagentavbl = mysqli_fetch_assoc($resfagentavailable);
                                    $availablevisas = $rowfagentavbl['RemainingQty'];
                            ?>
                                        <div class="col">Available Visa:<br><?php echo $availablevisas; ?></div>
                                        <?php
                                }
                            }
?>

                                        <ul class="nav nav-pills mt-4">
                                            <li class="nav-item"> <a class="nav-link active" id="profile-tab"
                                                    data-bs-toggle="tab" href="#Biography"><span
                                                        class="p-tab-name">Payment Details</span><i
                                                        class='bx bxs-user-rectangle font-24 d-sm-none'></i></a>
                                            </li>
                                            <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab"
                                                    href="#Edit-Profile"><span class="p-tab-name">Selected
                                                        Candidates</span><i
                                                        class='bx bx-message-edit font-24 d-sm-none'></i></a>
                                            </li>
                                            <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab"
                                                    href="#education-tab"><span class="p-tab-name">Documents</span><i
                                                        class='bx bx-message-edit font-24 d-sm-none'></i></a>
                                            </li>
                                            <!--!	<li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#Workexperiance"><span class="p-tab-name">Tasks</span><i class='bx bx-message-edit font-24 d-sm-none'></i></a>
									</li>
									<li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#documentations"><span class="p-tab-name">Documentations</span><i class='bx bx-message-edit font-24 d-sm-none'></i></a>
									</li>
									<li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#interview-tab"><span class="p-tab-name">Interview</span><i class='bx bx-message-edit font-24 d-sm-none'></i></a>
									</li>
									<li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#notes-task"><span class="p-tab-name">Tasks</span><i class='bx bx-message-edit font-24 d-sm-none'></i></a>
									</li>
						-->
                                        </ul>
                                        <div class="tab-content mt-3">
                                            <div class="tab-pane fade show active" id="Experience">





                                            </div>

                                            <div class="tab-pane fade show active" id="Biography">
                                                <div class="card shadow-none  border mb-0 radius-15">
                                                    <div class="card-body">
                                                        <?php include("Enjaz-form-Control/Enjaz-Payments.php");?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="Edit-Profile">
                                                <div class="card shadow-none border mb-0 radius-15">
                                                    <div class="card-body">

                                                        <?php //include("subagent-control/subagentwise-accounts-tabs.php");?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="education-tab">
                                                <div class="card shadow-none border mb-0 radius-15">
                                                    <div class="card-body">

                                                        <?php// include("subagent-control/subagent-documentation-tabs.php");?>

                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="tab-pane fade" id="Workexperiance">
										<div class="card shadow-none border mb-0 radius-15">
											<div class="card-body">
												
											<?php //include("user-profile-tabs/work-experiance-tabs.php");?>

											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="documentations">
										<div class="card shadow-none border mb-0 radius-15">
											<div class="card-body">
												
											<?php // include("user-profile-tabs/documentation-tabs.php");?>

											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="interview-tab">
										<div class="card shadow-none border mb-0 radius-15">
											<div class="card-body">
												
											<?php // include("user-profile-tabs/ineterview-tab.php");?>

											</div>
										</div>
									</div>
									<div class="tab-pane fade" id="notes-task">
										<div class="card shadow-none border mb-0 radius-15">
											<div class="card-body">
												
											<?php // include("user-profile-tabs/tasks-tabs.php");?>

											</div>
										</div> 
									</div>-->
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>


                        <!--end row-->

                    </div>
                </div>
            </div>
        </div>
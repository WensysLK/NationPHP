<?php include('../../includes/header.php'); 
function getBadge($status) {
    switch ($status) {
        case 'not_started':
            return ['badge bg-danger', 'Pending'];
        case 'processing':
            return ['badge bg-warning', 'Processing'];
        case 'finance':
            return ['badge bg-primary', 'Finance'];
        case 'completed':
            return ['badge bg-success', 'Completed'];
        default:
            return ['badge bg-light', 'Unknown'];
    }
}
?>

<body class="">

    <?php include('../../includes/navigation-admin.php'); ?>

    <div class="content content-fixed ">
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
                        <?php include("profile-parts/user-profile-buttons.php"); ?>
                    </div>
                </div>
                <!--end breadcrumb-->

                <div class="user-profile-page">
                    <div class="card radius-15">
                        <div class="card-body">
                            <?php
							if(isset($_GET['client_id'])){

							$client_id = $_GET['client_id'];
							$sql = "SELECT * FROM applications WHERE applicationID=$client_id";
							$res = mysqli_query($conn,$sql);
							if($row = mysqli_fetch_assoc($res)){
								

								$clientTitle = $row["applicantTitle"];
								$client_fname = $row["applicatFname"];
								$client_mname = $row["applicantMname"];
								$client_lname = $row["applicantLname"];
								$client_passport = $row["applicantPassno"];
								$client_religion = $row["appReligion"];
								$client_birthday = $row["applicantDob"];
								$client_photo = $row["profile_image"];
                                $clientstatus = $row["applicantStatus"];
                                $client_register_date = $row["register_date"]; // Assuming registration date is stored in this field
								

								// Calculate age
								$birthdate = new DateTime($client_birthday);
								$today = new DateTime('today');
								$age = $birthdate->diff($today);

                                $profileImage = '../../uploads/profile_images/'.$client_photo;
                                $fallbackimage = '../../uploads/img/fallback-image.png';
                                $imgSrc = !empty($profileImage) ? $profileImage : $fallbackimage;

                                // Query to fetch contract statuses from the `contracts` table
                                $sqlContractStatus = "SELECT `interviewStatus`,`medicalStatus`, `EnjazSatus`, `MuzanedStatus`, `fprintStatus`, `BeauroStatus`, `contractType`, `ContractStartus`, `contractCreated`
                                                    FROM `contract_details` 
                                                    WHERE `applicationID` = ? LIMIT 1";
                                $stmtContract = $conn->prepare($sqlContractStatus);
                                $stmtContract->bind_param("i", $client_id);
                                $stmtContract->execute();
                                $resultContract = $stmtContract->get_result();

                                // Check if any contract exists for the client
                                $contractExists = false;
                                if ($resultContract->num_rows > 0) {
                                    $contract = $resultContract->fetch_assoc();
                                    $contractExists = true;
                                }
?>
                            <div class="row">
                                <div class="col-12 col-lg-4 border-right">
                                    <div class="d-md-flex align-items-center">
                                        <div class="mb-md-0 mb-3">
                                            <img src="<?php echo $imgSrc; ?>" class="rounded-circle shadow" width="130"
                                                height="130" alt="" />
                                        </div>
                                        <div class="ms-md-4 flex-grow-1">
                                            <div class="d-flex align-items-center mb-1">
                                                <h4 class="mb-0">
                                                    <?php echo $clientTitle." ".$client_fname." ".$client_mname." ".$client_lname; ?>
                                                </h4>
                                            </div>
                                            <p class="mb-0 text-muted"><?php // echo $serialNumber; ?></p>
                                            <p class="text-primary"><i class='bx bx-buildings'></i>
                                                <span class="badge text-bg-success"><?php  echo $clientstatus; ?></span>
                                            </p>
                                            <p><strong>Register Date:</strong> <?php echo date('d M Y', strtotime($client_register_date)); ?></p> <!-- Registration Date -->
                                            <button type="button" class="btn btn-primary">Connect</button>
                                            <button type="button" class="btn btn-outline-secondary ml-2">Resume</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">

                                    <!-- Display Contract Statuses -->
                                    <?php if ($contractExists): 
                                        ?>
                                        
                                    <table class="table table-striped table-bordered mt-2" style="width:100%">
                                        <thead>
                                            <tr style="background-color: #f2f2f2;">
                                                <th>Contract Status</th>
                                                <th>Medical Status</th>
                                                <th>Fingerprint Status</th>
                                                <th>Muzaned Status</th>
                                                <th>Interview Status</th>
                                                <th>Enjaz Status</th> <!-- Empty or Placeholder column -->
                                                <th>Burea Status</th> <!-- Empty or Placeholder column -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span class="badge text-bg-warning"><?php echo $contract['ContractStartus']; ?></span></td>
                                                <td><span class="<?php echo getBadge($contract['medicalStatus'])[0]; ?>">
                                                    <?php echo getBadge($contract['medicalStatus'])[1]; ?>
                                                </span></td>
                                                <td><span class="<?php echo getBadge($contract['fprintStatus'])[0]; ?>">
                                                    <?php echo getBadge($contract['fprintStatus'])[1]; ?>
                                                </span></td>
                                                <td><span class="<?php echo getBadge($contract['MuzanedStatus'])[0]; ?>">
                                                    <?php echo getBadge($contract['MuzanedStatus'])[1]; ?>
                                                </span></td>
                                                <td><span class="<?php echo getBadge($contract['interviewStatus'])[0]; ?>">
                                                    <?php echo getBadge($contract['interviewStatus'])[1]; ?>
                                                </span></td>
                                                <td><span class="<?php echo getBadge($contract['EnjazSatus'])[0]; ?>">
                                                    <?php echo getBadge($contract['EnjazSatus'])[1]; ?>
                                                </span></td>
                                                <td><span class="<?php echo getBadge($contract['BeauroStatus'])[0]; ?>">
                                                    <?php echo getBadge($contract['BeauroStatus'])[1]; ?>
                                                </span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                   
                                    <?php else: ?>
                                        <div class="alert alert-warning" role="alert">No contract has been started for this applicant.</div>
                                    
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
							}
							}
							?>
                            <!--end row-->
                            <ul class="nav nav-pills mt-4">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#Experience">
                                        <span class="p-tab-name">Personal Infomation</span><i
                                            class='bx bx-donate-blood font-24 d-sm-none'></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#Biography">
                                        <span class="p-tab-name">Family Memebers</span><i
                                            class='bx bxs-user-rectangle font-24 d-sm-none'></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#Edit-Profile">
                                        <span class="p-tab-name">Pro-Qualifications</span><i
                                            class='bx bx-message-edit font-24 d-sm-none'></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#education-tab">
                                        <span class="p-tab-name">Education</span><i
                                            class='bx bx-message-edit font-24 d-sm-none'></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#Workexperiance">
                                        <span class="p-tab-name">Experiance</span><i
                                            class='bx bx-message-edit font-24 d-sm-none'></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#documentations">
                                        <span class="p-tab-name">Documentations</span><i
                                            class='bx bx-message-edit font-24 d-sm-none'></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#interview-tab">
                                        <span class="p-tab-name">Interview</span><i
                                            class='bx bx-message-edit font-24 d-sm-none'></i>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#notes-task">
                                        <span class="p-tab-name">Tasks</span><i
                                            class='bx bx-message-edit font-24 d-sm-none'></i>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content mt-3">
                                <div class="tab-pane fade show active" id="Experience">
                                    <div class="card shadow-none border mb-0 radius-15">
                                        <?php include("profile-parts/personal-information-tabs.php");?>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Biography">
                                    <div class="card shadow-none border mb-0 radius-15">
                                        <div class="card-body">
                                            <?php include("profile-parts/family-members-tabs.php");?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Edit-Profile">
                                    <div class="card shadow-none border mb-0 radius-15">
                                        <div class="card-body">
                                            <?php include("profile-parts/qualifications-tabs.php");?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="education-tab">
                                    <div class="card shadow-none border mb-0 radius-15">
                                        <div class="card-body">
                                            <?php include("profile-parts/education-tabs.php");?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Workexperiance">
                                    <div class="card shadow-none border mb-0 radius-15">
                                        <div class="card-body">
                                            <?php include("profile-parts/work-experiance-tabs.php");?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="documentations">
                                    <div class="card shadow-none border mb-0 radius-15">
                                        <div class="card-body">
                                            <?php include("profile-parts/documentation-tabs.php");?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="interview-tab">
                                    <div class="card shadow-none border mb-0 radius-15">
                                        <div class="card-body">
                                            <?php //include("user-profile-tabs/ineterview-tab.php");?>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="notes-task">
                                    <div class="card shadow-none border mb-0 radius-15">
                                        <div class="card-body">
                                            <?php //include("user-profile-tabs/tasks-tabs.php");?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- content -->

    <!--Popup form for Precheck Registration -->
    <?php //include('popups/precheck_application.php'); ?>
    <!-- End popup -->

    <?php include('../../includes/footer.php'); ?>
</body>

</html>

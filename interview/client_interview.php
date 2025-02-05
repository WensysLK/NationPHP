<?php include('../includes/header.php');

// Initialize variables to handle cases where session data might be missing
$client_id = $_GET['client_id'];
$sql = "SELECT * FROM applications WHERE applicationID=$client_id";
$res = mysqli_query($conn,$sql);
if($row = mysqli_fetch_assoc($res)){
    // Retrieve form data from session
//    var_dump(	 $row);die();
    $applicationID = $client_id;

    // Safely assign session data to variables
    $applicantTitle = $row["applicantTitle"];
    $applicantFname = $row['applicatFname'];
    $applicantMname = $row['applicantMname'];
    $applicantLname = $row['applicantLname'];
    $applicantDob = $row['applicantDob'];
    $passportNumber = $row['applicantPassno'];
    $nicNumber = $row['applicantNICno'];
    $height = $row['applicanthight'];
    $weight = $row['applicantWeight'];
    $gender = $row['applicantGender'];
    $civilStatus = $row['maritalestatus'];


    // Optionally, clear the session data if it's no longer needed
    //unset($_SESSION['form_data']);




} else {
    // Handle case where session data is not set
    echo "No form data available.";
    exit;
}



?>
<style>
.step {
    display: none;
}

.step.active {
    display: block;
}

.step-navigation {
    margin-bottom: 20px;
}

.step-navigation .nav-link {
    color: #555;
    border-radius: 0;
}

.step-navigation .nav-link.active {
    background-color: #007bff;
    color: #fff;
    font-weight: bold;
}

.nav-pills .nav-link {
    border-radius: 50px;
    margin-right: 10px;
}

.nav-pills .nav-link i {
    margin-right: 5px;
}

.skill-entry {
    margin-bottom: 15px;
}

.badge {
    margin-right: 5px;
    margin-top: 5px;
    cursor: pointer;
    background: #949494;
}

.badge-selected {
    background-color: #007bff !important;
    color: white;
}

.wslk_button {
    width: auto;
    margin-left: 15px;
    margin-bottom: 15px;
}

.experience-fields,
.training-fields {
    display: none;
    /* Initially hide both sections */
}

.wslk_fam {
    background: grey;
    padding: 10px;
    margin-bottom: 5px;
}
</style>

<body>

    <?php include('../includes/navigation-admin.php');

    ?>

    <div class="content content-fixed bd-b">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mg-b-5">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Interview Applications</a></li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0">Interview Form</h4>
                </div>
                <div class="mg-t-20 mg-sm-t-0">
                </div>
            </div>
            <form id="multiStepForm" action="interview_form_function/interview_data_insert.php" method="POST"
                  enctype="multipart/form-data">
            <div class="content">
                <!-- Custom Form Starts -->
                <!-- Step Navigation using Bootstrap Nav Pills -->

                <!-- Step 1: Personal Information -->

                <?php
                // Pre-fill data (this could be fetched from the database if it exists)
                $name = $_POST['name'] ?? '';
                $passportNumber = $_POST['passportNumber'] ?? '';
                $phoneNumber = $_POST['phone_number'] ?? '';
                $contactInfo = $_POST['contact_info'] ?? ''; // for next step
                ?>
                <div class="row">
                    <div class="col-3">
                        <div class="profile-image-container">
                            <img src="../uploads/img/fallback-image.png" alt="Profile Image" class="profile-image" id="profileImage">
                            <label for="profileImageInput" class="camera-icon">
                                <img src="../uploads/img/camera-icon.png" alt="Camera Icon">
                            </label>
                            <input type="file" id="profileImageInput" name="profileImage" accept="image/*" class="profile-image-input">
                        </div>
<!--                        <div class="camera-options">-->
<!--                            <button type="button" id="openCameraButton">Take Photo</button>-->
<!--                            <button type="button" id="saveCameraPhotoButton" style="display:none;">Save Photo</button>-->
<!--                        </div>-->
                        <video id="cameraPreview" style="display: none; width: 150px; height: 150px; border-radius: 50%;"></video>
                        <canvas id="cameraCanvas" style="display: none;"></canvas>
                    </div>

                    <div class="col-9">
                        <div class="row mb-3">

                            <div class="col p-2">
                                <label class="form-label">Application Number</label>
                                <input type="text" class="form-control" placeholder="applicationNumber" value="<?php echo $client_id; ?>"
                                       name="applicationNumber" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col p-2">
                                <label class="form-label">Title</label>
                                <select name="name-title" class="form-control" id="exampleFormControlSelect1">
                                    <option selected Value="<?php echo $applicantTitle; ?>"><?php echo $applicantTitle; ?></option>
                                    <option Value="Dr">Dr</option>
                                    <option Value="Mr">Mr</option>
                                    <option Value="Mrs">Mrs</option>
                                    <option Value="Ms">Ms</option>
                                    <option Vlaue="Rev.Fr">Rev.Fr</option>
                                    <option Vlaue="Rev.Sis">Rev.Sis</option>
                                    <option Vlaue="Jr">Junior</option>
                                </select>
                            </div>
                            <div class="col p-2">
                                <label class="form-label">First Name </label>
                                <input type="text" class="form-control" placeholder="First name" value="<?php echo $applicantFname; ?>"
                                       name="Cfname" required>
                            </div>
                            <div class="col p-2">
                                <label class="form-label">Middle Name </label>
                                <input type="text" class="form-control" placeholder="middle name" value="<?php echo $applicantMname; ?>"
                                       name="cmname">
                            </div>
                            <div class="col p-2">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" placeholder="Last name" value="<?php echo $applicantLname; ?>"
                                       name="clname" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col p-2">
                                <label class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" placeholder="Birthday"
                                       value="<?php echo $applicantDob; ?>" name="dateofbirth">
                                <div id="ageDisplay"></div>
                            </div>
                            <div class="col p-2">
                                <label for="heightFeet" class="form-label">Hieght (in feet):</label>
                                <input type="number" id="heightFeet" class="form-control" name="height" value="<?php echo $height; ?>" step="0.1" min="0" onchange="convertHeight()">
                                <div id="resultHeight" style="font-size:12px;"></div>
                            </div>
                            <div class="col p-2">
                                <label class="form-label">Weight </label>
                                <input type="number" class="form-control" name="weight" step="0.1" min="0" id="" value="<?php echo $weight; ?>">
                            </div>
                            <div class="col p-2">
                                <label class="form-label">NIC No</label>
                                <input type="text" class="form-control" name="nicnumber" value="<?php echo $nicNumber; ?>" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col p-2">
                                <label class="form-label">Passport Details</label>
                                <input type="text" class="form-control" name="cpassport" value="<?php echo $passportNumber; ?>">
                            </div>
                            <div class="col p-2">
                                <label class="form-label">Gender</label>
                                <input type="text" class="form-control" name="cpassport" value="<?php echo $gender; ?>">
                            </div>

                            <div class="col p-2">
                                <label class="form-label">Civil Status</label>
                                <input type="text" class="form-control" name="rase" id="" value="<?php echo $civilStatus; ?>">
                            </div>

                        </div>




                    </div>
                </div>
                <h4 class="mg-b-0">Personal Specifications </h4>
                <div class="row mb-5">
                    <div class="col-4 mt-2">
                        <label class="form-label">Appearance/Phyysical Fitness</label>
                        <div class="wslk-radio">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="male" name="appearance" value="excellent">
                                <label class="form-check-label" for="male">
                                    Excellent
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input " type="radio" id="female" name="appearance" value="good">
                                <label class="form-check-label" for="female">
                                    Good
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="male" name="appearance" value="average">
                                <label class="form-check-label" for="male">
                                    Average
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input " type="radio" id="female" name="appearance" value="belowAverage">
                                <label class="form-check-label" for="female">
                                    Below Average
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 mt-2">
                        <label class="form-label">Communications</label>
                        <div class="wslk-radio">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="male" name="communications" value="excellent">
                                <label class="form-check-label" for="male">
                                    Excellent
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input " type="radio" id="female" name="communications" value="good">
                                <label class="form-check-label" for="female">
                                    Good
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="male" name="communications" value="average">
                                <label class="form-check-label" for="male">
                                    Average
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input " type="radio" id="female" name="communications" value="belowAverage">
                                <label class="form-check-label" for="female">
                                    Below Average
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 mt-2">
                        <label class="form-label">Self Confidence / Enthusiasm</label>
                        <div class="wslk-radio">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="male" name="confidence" value="excellent">
                                <label class="form-check-label" for="male">
                                    Excellent
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input " type="radio" id="female" name="confidence" value="good">
                                <label class="form-check-label" for="female">
                                    Good
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="male" name="confidence" value="average">
                                <label class="form-check-label" for="male">
                                    Average
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input " type="radio" id="female" name="confidence" value="belowAverage">
                                <label class="form-check-label" for="female">
                                    Below Average
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="row mb-5">

                    <div class="col-4 mt-2">
                        <label class="form-label">Past Experience</label>
                        <div class="wslk-radio">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="male" name="experience" value="excellent">
                                <label class="form-check-label" for="male">
                                    Excellent
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input " type="radio" id="female" name="experience" value="good">
                                <label class="form-check-label" for="female">
                                    Good
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="male" name="experience" value="average">
                                <label class="form-check-label" for="male">
                                    Average
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input " type="radio" id="female" name="experience" value="belowAverage">
                                <label class="form-check-label" for="female">
                                    Below Average
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 mt-2">
                        <label class="form-label">Attitude / Politeness</label>
                        <div class="wslk-radio">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="male" name="attitude" value="excellent">
                                <label class="form-check-label" for="male">
                                    Excellent
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input " type="radio" id="female" name="attitude" value="good">
                                <label class="form-check-label" for="female">
                                    Good
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="male" name="attitude" value="average">
                                <label class="form-check-label" for="male">
                                    Average
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input " type="radio" id="female" name="attitude" value="belowAverage">
                                <label class="form-check-label" for="female">
                                    Below Average
                                </label>
                            </div>
                        </div>
                    </div>

                </div>


                <h4 class="mg-b-0">Communication Skill (English) </h4>
                <div class="row mb-5">
                    <div class="col-4 mt-2">
                        <label class="form-label">Read</label>
                        <div class="wslk-radio">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="male" name="read" value="excellent">
                                <label class="form-check-label" for="male">
                                    Excellent
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input " type="radio" id="female" name="read" value="good">
                                <label class="form-check-label" for="female">
                                    Good
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="male" name="read" value="average">
                                <label class="form-check-label" for="male">
                                    Average
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input " type="radio" id="female" name="read" value="belowAverage">
                                <label class="form-check-label" for="female">
                                    Below Average
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 mt-2">
                        <label class="form-label">Understand</label>
                        <div class="wslk-radio">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="male" name="understand" value="excellent">
                                <label class="form-check-label" for="male">
                                    Excellent
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input " type="radio" id="female" name="understand" value="good">
                                <label class="form-check-label" for="female">
                                    Good
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="male" name="understand" value="average">
                                <label class="form-check-label" for="male">
                                    Average
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input " type="radio" id="female" name="understand" value="belowAverage">
                                <label class="form-check-label" for="female">
                                    Below Average
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 mt-2">
                        <label class="form-label">Speak</label>
                        <div class="wslk-radio">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="male" name="speak" value="excellent">
                                <label class="form-check-label" for="male">
                                    Excellent
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input " type="radio" id="female" name="speak" value="good">
                                <label class="form-check-label" for="female">
                                    Good
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="male" name="speak" value="average">
                                <label class="form-check-label" for="male">
                                    Average
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input " type="radio" id="female" name="speak" value="belowAverage">
                                <label class="form-check-label" for="female">
                                    Below Average
                                </label>
                            </div>
                        </div>
                    </div>

                </div>

                <h4 class="mg-b-0">View More Details </h4>
                <br>
                <a href="application-profile.php?client_id=<?php echo $client_id;?>" class="btn btn-success btn-sm lni lni-eye">
                 View More
                </a>

                <div class="row mb-5">
                    <div class="col-4 mt-2">
                        <label class="form-label">InterView Status</label>
                        <select  class="form-control" id="exampleFormControlSelect1" name="status">
                            <option Value="completed">Completed</option>
                            <option Value="Incompleted">Rejected</option
                        </select>

                        <input type="hidden" class="form-control" name="statusyu" >
                    </div>
                    <div class="col-4 mt-2">
                        <label class="form-label">Evaluated By</label>
                        <input type="text" class="form-control" name="evaluatedBy" >
                    </div>

                    <div class="col-4 mt-2">
                        <label class="form-label">Date</label>
                        <input type="date" class="form-control" name="date" id="" >
                    </div>

                </div>

                <button type="submit" class="btn btn-secondary" name="save">Submit</button>


            </div>
            </form>
        </div>
    </div>
    <?php include('../includes/footer.php'); ?>



</body>

</html>
<?php include('../includes/header.php'); ?>
<style>
/* Profile Image CSS*/
.profile-image-container {
    position: relative;
    display: inline-block;
    width: 250px;
    height: 250px;
    border-radius: 50%;
    overflow: hidden;
    margin-bottom: 10px;
}

.profile-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.camera-icon {
    position: absolute;
    bottom: 10px;
    right: 10px;
    background: rgba(0, 0, 0, 0.6);
    border-radius: 50%;
    padding: 5px;
    cursor: pointer;
    z-index: 2;
}

.camera-icon img {
    width: 24px;
    height: 24px;
}

.profile-image-input {
    display: none;
}

.camera-options {
    display: flex;
    gap: 10px;
}

#cameraPreview {
    display: none;
    width: 250px;
    height: 250px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 10px;
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
    <?php include('../includes/navigation-admin.php'); ?>
    <div class="content content-fixed bd-b">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mg-b-5">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Applications</a></li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0">Register Application</h4>
                </div>
                <div class="mg-t-20 mg-sm-t-0">
                </div>
            </div>
            <div class="content">
                <!--Content Starts Here -->
                <div class="container mt-5">

                    <!-- Step Navigation using Bootstrap Nav Pills -->
                    <ul class="nav nav-pills step-navigation mb-4" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="step1-tab" data-bs-toggle="pill" onclick="showStep(1)"
                                type="button" role="tab">
                                <i class="bi bi-person"></i> Personal Information
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="step2-tab" data-bs-toggle="pill" onclick="showStep(2)"
                                type="button" role="tab">
                                <i class="bi bi-envelope"></i> Contact Details
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="step3-tab" data-bs-toggle="pill" onclick="showStep(3)"
                                type="button" role="tab">
                                <i class="bi bi-people"></i> Family Details
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="step4-tab" data-bs-toggle="pill" onclick="showStep(4)"
                                type="button" role="tab">
                                <i class="bi bi-book"></i> Skills & License
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="step5-tab" data-bs-toggle="pill" onclick="showStep(4)"
                                type="button" role="tab">
                                <i class="bi bi-book"></i> Education & Professional Details
                            </button>
                        </li>
                    </ul>

                    <form id="multiStepForm" method="post" action="Functions/user_data_register.php"
                        enctype="multipart/form-data">
                        <!-- Step 1: Personal Information -->
                        <div class="step active" id="step1">
                            <h4>Personal Information</h4>
                            <div class="row">
                                <div class="col-3">
                                    <div class="profile-image-container">
                                        <img src="img/fallback-image.png" alt="Profile Image" class="profile-image"
                                            id="profileImage">
                                        <label for="profileImageInput" class="camera-icon">
                                            <img src="img/camera-icon.png" alt="Camera Icon">
                                        </label>
                                        <input type="file" id="profileImageInput" name="profileImage" accept="image/*"
                                            class="profile-image-input">
                                    </div>
                                    <div class="camera-options">
                                        <button type="button" id="openCameraButton">Take Photo</button>
                                    </div>
                                    <video id="cameraPreview"
                                        style="display: none; width: 150px; height: 150px; border-radius: 50%;"></video>

                                    <script>
                                    document.addEventListener('DOMContentLoaded', () => {
                                        const profileImageInput = document.getElementById(
                                            'profileImageInput');
                                        const profileImage = document.getElementById('profileImage');
                                        const openCameraButton = document.getElementById(
                                            'openCameraButton');
                                        const cameraPreview = document.getElementById('cameraPreview');
                                        let stream;

                                        // Function to handle file input change and preview
                                        profileImageInput.addEventListener('change', (event) => {
                                            const file = event.target.files[0];
                                            if (file) {
                                                const reader = new FileReader();
                                                reader.onload = function(e) {
                                                    profileImage.src = e.target.result;
                                                }
                                                reader.readAsDataURL(file);
                                            }
                                        });

                                        // Function to open camera and take a photo
                                        openCameraButton.addEventListener('click', async () => {
                                            if (navigator.mediaDevices && navigator.mediaDevices
                                                .getUserMedia) {
                                                try {
                                                    stream = await navigator.mediaDevices
                                                        .getUserMedia({
                                                            video: true
                                                        });
                                                    cameraPreview.srcObject = stream;
                                                    cameraPreview.style.display = 'block';
                                                    cameraPreview.play();

                                                    if (!document.getElementById(
                                                            'takePhotoButton')) {
                                                        const takePhotoButton = document
                                                            .createElement('button');
                                                        takePhotoButton.type = 'button';
                                                        takePhotoButton.id = 'takePhotoButton';
                                                        takePhotoButton.innerText =
                                                            'Capture Photo';
                                                        takePhotoButton.addEventListener(
                                                            'click',
                                                            capturePhoto);
                                                        openCameraButton.parentElement
                                                            .appendChild(
                                                                takePhotoButton);
                                                    }
                                                } catch (error) {
                                                    console.error(
                                                        'Error accessing the camera: ',
                                                        error);
                                                }
                                            } else {
                                                alert('Camera not supported on this device');
                                            }
                                        });

                                        // Function to capture the photo from the video stream
                                        const capturePhoto = () => {
                                            const canvas = document.createElement('canvas');
                                            canvas.width = cameraPreview.videoWidth;
                                            canvas.height = cameraPreview.videoHeight;
                                            const context = canvas.getContext('2d');
                                            context.drawImage(cameraPreview, 0, 0, canvas.width, canvas
                                                .height);
                                            profileImage.src = canvas.toDataURL('image/png');

                                            // Stop the video stream
                                            stream.getTracks().forEach(track => track.stop());
                                            cameraPreview.style.display = 'none';

                                            const takePhotoButton = document.getElementById(
                                                'takePhotoButton');
                                            if (takePhotoButton) {
                                                takePhotoButton.remove();
                                            }
                                        };
                                    });
                                    </script>
                                </div>
                                <div class="col-9">
                                    <div class="row mb-3">
                                        <div class="col p-2">
                                            <label class="form-label">Title</label>
                                            <select name="name-title" class="form-control"
                                                id="exampleFormControlSelect1">
                                                <option selected Value="none"><?php echo  $appTitle; ?></option>
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
                                            <input type="text" class="form-control" placeholder="First name"
                                                name="Cfname" value="<?php echo $appFirstname; ?>" required>
                                        </div>
                                        <div class="col p-2">
                                            <label class="form-label">Middle Name </label>
                                            <input type="text" class="form-control" placeholder="middle name"
                                                name="cmname" value="<?php echo $appMiddlename; ?>">
                                        </div>
                                        <div class="col p-2">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" class="form-control" placeholder="Last name"
                                                name="clname" value="<?php echo $appLatsname; ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col p-2">
                                            <label class="form-label">Date of Birth</label>
                                            <input type="date" class="form-control" id="dob" placeholder="Birthday"
                                                name="dateofbirth" value="<?php echo $dateofbirth; ?>">
                                            <div id="ageDisplay"></div>
                                        </div>
                                        <div class="col p-2">
                                            <label for="heightFeet" class="form-label">Hieght (in feet):</label>
                                            <input type="number" id="heightFeet" class="form-control" name="height"
                                                onchange="convertHeight()">
                                            <div id="resultHeight" style="font-size:12px;"></div>
                                            <!-- Hight Calculation Javascript Function -->
                                            <script>
                                            function convertHeight() {
                                                var feet = parseFloat(document.getElementById('heightFeet')
                                                    .value) || 0;
                                                var resultHeight = document.getElementById('resultHeight');

                                                var heightInCm = (feet * 30.48);

                                                if (!isNaN(heightInCm)) {
                                                    resultHeight.innerHTML =
                                                        `Height in cm: ${heightInCm.toFixed(2)} cm`;
                                                    resultHeight.style.display = 'block';
                                                } else {
                                                    resultHeight.style.display = 'none';
                                                }
                                            }
                                            </script>
                                        </div>
                                        <div class="col p-2">
                                            <label class="form-label">Weight </label>
                                            <input type="number" class="form-control" name="weight" id="">
                                        </div>
                                        <div class="col p-2">
                                            <label class="form-label">NIC No</label>
                                            <input type="text" class="form-control" name="nicnumber"
                                                value="<?php echo $nicnumber; ?>" id="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col p-2">
                                            <label class="form-label">Gender</label>
                                            <div class="wslk-radio">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" id="male" name="gender"
                                                        value="male">
                                                    <label class="form-check-label" for="male">
                                                        Male
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input " type="radio" id="female"
                                                        name="gender" value="female">
                                                    <label class="form-check-label" for="female">
                                                        Female
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col p-2">
                                            <label class="form-label">Religion</label>
                                            <div class="wslk-radio">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" id="male"
                                                        name="Religion" value="Muslim">
                                                    <label class="form-check-label" for="male">
                                                        Muslim
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input " type="radio" id="female"
                                                        name="Religion" value="Non-muslim">
                                                    <label class="form-check-label" for="female">
                                                        Non-Muslim
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col p-2">
                                            <label class="form-label">Rase</label>
                                            <input type="text" class="form-control" name="rase" id="">
                                        </div>
                                        <div class="col p-2">
                                            <label class="form-label">Nationality</label>
                                            <input type="text" class="form-control" name="nationality" id="">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col p-2">
                                            <label class="form-label">Passport Details</label>
                                            <input type="text" class="form-control" name="cpassport"
                                                value="<?php echo $passport; ?>">
                                        </div>
                                        <div class="col p-2">
                                            <label class="form-label">Pasport Issue.Date </label>
                                            <input type="date" class="form-control" placeholder="Passport Exp.Date"
                                                id="expiryDate" name="cpassportdate">
                                            <div id="expiryDisplay"></div>
                                        </div>
                                        <div class="col p-2">
                                            <label class="form-label">Marital Status</label>
                                            <select name="maritalstatus" class="form-control"
                                                id="exampleFormControlSelect1">
                                                <option selected Value="none">Merital Status</option>
                                                <option Value="single">Single</option>
                                                <option Value="married">Married</option>
                                                <option Value="widow">Widowed</option>
                                            </select>
                                        </div>
                                        <div class="col p-2">
                                            <label class="form-label">File Number Details</label>
                                            <input type="text" class="form-control" placeholder="File No"
                                                name="cffileno">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-4 mt-2">
                                    <label for="findUs">How Did You Hear About Us?</label>
                                    <select id="findUs" class="form-control" name="findUs">
                                        <option value="">Select an option</option> <!-- Placeholder option -->
                                        <option value="none">None</option>
                                        <option value="newspaper">Newspaper</option>
                                        <option value="onlineAds">Online Ads</option>
                                        <option value="subAgent">Sub Agent</option>
                                    </select>

                                    <!-- Sub Agent Fields, hidden initially -->
                                    <div id="subAgentField" class="sub-agent-field" style="display: none;">
                                        <div class="form-group mt-2">
                                            <label for="subAgentSearch">Search Subagent:</label>
                                            <input type="text" id="subAgentSearch" class="form-control"
                                                placeholder="Enter name, NIC, or phone number">
                                            <input type="hidden" id="subAgentId" name="subAgentId">
                                            <!-- Updated ID -->
                                        </div>
                                        <div id="addNewSubagentBtn" class="add-new-subagent" style="display: none;">
                                            <a type="button" href="javascript:;" data-bs-toggle="modal"
                                                data-bs-target="#mainmodlesubagent">Add New</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <label class="form-label mt-3">Attachments</label>
                                        <hr>
                                        <div class="col">
                                            <lable class="form-label">Nic Front Copy</lable>
                                            <input type="file" class="form-control" name="clientNicFront" id="">
                                        </div>
                                        <div class="col">
                                            <lable class="form-label">Nic Back Copy</lable>
                                            <input type="file" class="form-control" name="clientNicBack" id="">
                                        </div>
                                        <div class="col">
                                            <lable class="form-label">Passport Copy o1</lable>
                                            <input type="file" class="form-control" name="clientpassportCopy1" id="">
                                        </div>
                                        <div class="col">
                                            <lable class="form-label">Passport Copy o2</lable>
                                            <input type="file" class="form-control" name="clientpassportcopy2" id="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            document.getElementById('findUs').addEventListener('change', function() {
                                var subAgentField = document.getElementById('subAgentField');
                                if (this.value === 'subAgent') {
                                    subAgentField.style.display = 'block';
                                } else {
                                    subAgentField.style.display = 'none';
                                }
                            });
                            </script>
                            <button type="submit" class="btn btn-secondary">Save</button>
                            <button type="button" class="btn btn-primary" onclick="nextStep(2)">Next</button>
                        </div>

                        <!-- Step 2: Contact Details -->
                        <div class="step" id="step2">
                            <h4>Contact Details</h4>
                            <div class="row">
                                <div class="col p-2">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email"
                                        name="cemail">
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">Land Phone</label>
                                    <input type="text" class="form-control" placeholder="Land Phone No" name="clphone">
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">Mobile No</label>
                                    <input type="text" class="form-control" id="mobileNumber1" placeholder="Phone No"
                                        name="cphone2">
                                    <div id="messagingIcons1">
                                        <!-- Icons for mobile number 1 will be dynamically inserted here -->
                                    </div>
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">Mobile No</label>
                                    <input type="text" class="form-control" id="mobileNumber2" placeholder="Phone No"
                                        name="cphone">
                                    <div id="messagingIcons2">
                                        <!-- Icons for mobile number 2 will be dynamically inserted here -->
                                    </div>
                                </div>

                            </div>

                            <div class="row mb-5">
                                <div class="col p-2">
                                    <label class="form-label">Address Line 01</label>
                                    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St"
                                        name="caddress1">
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">Address Lins 02</label>
                                    <input type="text" class="form-control" id="inputAddress2"
                                        placeholder="Apartment, studio, or floor" name="caddress2">
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">Province</label>
                                    <input type="text" class="form-control" id="inputCity" placeholder="Province"
                                        name="cprovince">
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" id="inputCity" placeholder="City"
                                        name="ccity">
                                </div>
                                <div class="col p-2">
                                    <label class="form-label">Gramasevaka Division</label>
                                    <input type="text" class="form-control" id="inputZip" placeholder="GS Devision"
                                        name="gsdevision">
                                </div>

                            </div>

                            <button type="button" class="btn btn-secondary" onclick="saveData()">Save</button>
                            <button type="button" class="btn btn-secondary" onclick="prevStep(1)">Previous</button>
                            <button type="button" class="btn btn-primary" onclick="nextStep(3)">Next</button>
                        </div>

                        <!-- Step 3: Family Details -->
                        <div class="step" id="step3">
                            <h4>Family Details</h4>
                            <!--Form Section Starts Here -->
                            <div class="row mb-3">
                                <div class="row">
                                    <div class="col p-2">
                                        <label for="fatherFullName" class="form-label">Father's Name</label>
                                        <input type="text" class="form-control" id="fatherFullName" name="fatherName">
                                        <input type="hidden" name="parentType" value="father">
                                    </div>
                                    <div class="col p-2">
                                        <label for="fatherDOB" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="fatherDOB" name="fatherDOB"
                                            onchange="calculateAgeparents('father')">
                                    </div>
                                    <div class="col p-2">
                                        <label for="fatherAge" class="form-label">Age</label>
                                        <input type="text" class="form-control" id="fatherAge" name="fatherAge"
                                            readonly>
                                    </div>

                                    <div class="col p-2">
                                        <label for="fatherContactNumber" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" id="fatherContactNumber"
                                            name="fatherContactNumber">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col p-2">
                                        <label for="fatherNIC" class="form-label">NIC</label>
                                        <input type="text" class="form-control" id="fatherNIC" name="fatherNIC">
                                    </div>
                                    <div class="col p-2">
                                        <label class="form-label" for="fatherNICfrontcopy">Father's NIC
                                            Front Copy</label>
                                        <input type="file" class="form-control" id="fatherNICfront"
                                            name="fatherNICfrontcopy">
                                    </div>
                                    <div class="col p-2">
                                        <label class="form-label" for="fatherNICbackcopy">Father's NIC
                                            Back Copy</label>
                                        <input type="file" class="form-control" id="fatherNICback"
                                            name="fatherNICbackcopy">
                                    </div>
                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="row">
                                    <div class="col p-2">
                                        <label for="motherFullName" class="form-label">Mother's Name</label>
                                        <input type="text" class="form-control" id="motherFullName" name="MothertName">
                                        <input type="hidden" name="parentType" value="mother">
                                    </div>
                                    <div class="col p-2">
                                        <label for="motherDOB" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="motherDOB" name="motherDOB"
                                            onchange="calculateAgeparents('mother')">
                                    </div>
                                    <div class="col p-2">
                                        <label for="motherAge" class="form-label">Age</label>
                                        <input type="text" class="form-control" id="motherAge" name="motherAge"
                                            readonly>
                                    </div>
                                    <div class="col p-2">
                                        <label for="motherContactNumber" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" id="motherContactNumber"
                                            name="motherContactNumber">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col p-2">
                                        <label for="motherNIC" class="form-label">NIC</label>
                                        <input type="text" class="form-control" id="motherNIC" name="motherNIC">
                                    </div>
                                    <div class="col p-2">
                                        <label class="form-label" for="motherNICfrontcopy">Mother's NIC
                                            Front Copy</label>
                                        <input type="file" class="form-control" id="motherNICfront"
                                            name="motherNICfrontcopy">
                                    </div>
                                    <div class="col p-2">
                                        <label class="form-label" for="motherNICbackcopy">Mother's NIC
                                            Back Copy</label>
                                        <input type="file" class="form-control" id="motherNICback"
                                            name="motherNICbackcopy">
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <h4>Spouce Details</h4>
                            <div class="row mb-3">
                                <div class="row">
                                    <div class="col p-2">
                                        <label for="spouseFullName" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="spouseFullName"
                                            name="spouseFullName">
                                    </div>
                                    <div class="col p-2">
                                        <label for="relationship" class="form-label">Relationship</label>
                                        <select name="relationship" class="form-control" id="relationship">
                                            <option value="">Select</option>
                                            <option value="husband">Husband</option>
                                            <option value="wife">Wife</option>
                                        </select>
                                    </div>
                                    <div class="col p-2">
                                        <label for="spouseDOB" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="spouseDOB" name="spouseDOB"
                                            onchange="calculateAgespouce('spouse')">
                                    </div>
                                    <div class="col p-2">
                                        <label for="spouseAge" class="form-label">Age</label>
                                        <input type="text" class="form-control" id="spouseAge" name="spouseAge"
                                            readonly>
                                    </div>
                                    <div class="col p-2">
                                        <label for="maritalStatus" class="form-label">Status</label>
                                        <select name="maritalStatus" class="form-control" id="maritalStatus" required>
                                            <option value="">Select Status</option>
                                            <option value="active">Active</option>
                                            <option value="divorced">Divorced</option>
                                            <option value="widowed">Widowed</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col p-2">
                                        <label for="spouseContactNumber" class="form-label">Contact Number</label>
                                        <input type="text" class="form-control" id="spouseContactNumber"
                                            name="spouseContactNumber">
                                    </div>
                                    <div class="col p-2">
                                        <label for="spouseNIC" class="form-label">NIC No</label>
                                        <input type="text" class="form-control" id="spouseNIC" name="spouseNIC">
                                    </div>

                                    <div class="col p-2" id="">
                                        <label for="spoucenicfront" class="form-label ">Spouce Nic Front</label>
                                        <input type="file" class="form-control" name="spoucenicfront" id="">
                                    </div>
                                    <div class="col p-2" id="">
                                        <label for="spoucenicback" class="form-label ">Spouce Nic Back</label>
                                        <input type="file" class="form-control" name="spoucenicback" id="">
                                    </div>


                                </div>


                                <hr style="margin-top:20px;margin-bottom:20px;">
                                <h4>Children & Sibiling Details</h4>
                                <div id="repeaterContainer">
                                    <!-- Initial set of fields -->
                                    <div class="row repeater-group">
                                        <div class="row">
                                            <div class="col p-2">
                                                <label class="form-label ">Name</label>
                                                <input class="form-control" type="text" name="childName[]">
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label ">Relationship</label>
                                                <select name="childRelationship[]" class="form-control">
                                                    <option value="son">Son</option>
                                                    <option value="daughter">Daughter</option>
                                                    <option value="brother">Brother</option>
                                                    <option value="sister">Sister</option>
                                                </select>
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label ">Date of Birth</label>
                                                <input class="form-control" type="date" name="childDOB[]"
                                                    onchange="calculateAge2(this)">
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label ">Age</label>
                                                <input class="form-control" type="text" name="childAge[]" readonly>
                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="col p-2">
                                                <label class="form-label ">School Attended</label>
                                                <select name="childSchoolAttended[]" class="form-control"
                                                    onchange="toggleSchoolFields(this)">
                                                    <option value="none">Select Option</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                            <div class="col school-fields" style="display: none;">
                                                <div class="row">
                                                    <div class="col p-2">
                                                        <label class="form-label ">School Name</label>
                                                        <input class="form-control" type="text"
                                                            name="childSchoolName[]">
                                                    </div>
                                                    <div class="col p-2">
                                                        <label class="form-label ">Grade</label>
                                                        <input class="form-control" type="text" name="childGrade[]">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col p-2" id="nationalIdField">
                                                <label class="form-label ">National ID</label>
                                                <input class="form-control" type="text" name="childNIC[]">
                                            </div>
                                            <div class="col p-2" id="">
                                                <label for="sibilingnicfront" class="form-label ">Sibiling NIC
                                                    Front</label>
                                                <input type="file" class="form-control" name="sibilingnicfront[]" id="">
                                            </div>
                                            <div class="col p-2" id="">
                                                <label for="sibilingnicback" class="form-label ">Sibiling NIC
                                                    Back</label>
                                                <input type="file" class="form-control" name="sibilingnicback[]" id="">
                                            </div>
                                            <div class="col p-2">
                                                <label> </label>
                                                <button type="button" onclick="addRepeater()" style="font-size:14px;"
                                                    class="btn btn-primary mt-4" id="addfam">+</button>
                                            </div>
                                        </div>



                                    </div>
                                </div>
                            </div>
                            <hr style="margin-top:20px;margin-bottom:20px;">
                            <div class="wslk_fam">
                                <h4>Guardian Details</h4>
                                <div class="row">
                                    <div class="col p-2">
                                        <label class="form-label ">Guardian's Name</label>
                                        <input type="text" class="form-control" name="guardianName" id="">
                                    </div>
                                    <div class="col p-2">
                                        <label class="form-label ">Contact Number</label>
                                        <input type="text" class="form-control" name="guardianContact" id="">
                                    </div>
                                    <div class="col p-2">
                                        <label class="form-label ">Relationship</label>
                                        <select name="guardianRelationship" class="form-control"
                                            id="exampleFormControlSelect1">
                                            <option selected Value="none">Select Relationship</option>
                                            <option Value="spouce">Spouce</option>
                                            <option Value="son">Son</option>
                                            <option Value="daughter">Daughter</option>
                                            <option Value="mother">Mother</option>
                                            <option Vlaue="father">Father</option>
                                            <option Vlaue="brother">Brother</option>
                                            <option Vlaue="sister">Sister</option>
                                        </select>
                                    </div>
                                    <div class="col p-2">
                                        <label class="form-label ">Date of Birth</label>
                                        <input type="date" class="form-control" name="guardiandob" id="">
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col p-2">
                                        <label class="form-label ">National ID</label>
                                        <input type="text" class="form-control" name="guardianNIC" id="">
                                    </div>
                                    <div class="col p-2">
                                        <label class="form-label ">NIC Front Copy</label>
                                        <input type="file" class="form-control" name="guardiannicfront" id="">
                                    </div>
                                    <div class="col p-2">
                                        <label class="form-label ">NIC Back Copy</label>
                                        <input type="file" class="form-control" name="guardiannicback" id="">
                                    </div>
                                    <div class="col p-2">
                                        <label class="form-label ">Family Background Letter</label>
                                        <input type="file" class="form-control" name="guardianletter" id="">
                                    </div>
                                </div>
                            </div>
                            <!--Form Section Ends Here -->
                            <button type="button" class="btn btn-secondary" onclick="saveData()">Save</button>
                            <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Previous</button>
                            <button type="button" class="btn btn-primary" onclick="nextStep(4)">Next</button>
                        </div>

                        <!-- Step 4: Skills & License Details -->
                        <div class="step" id="step4">
                            <h4>Skills & License</h4>
                            <!--Forms section starts Here -->
                            <div class="row">
                                <div class="row">
                                    <!-- Skills Section -->
                                    <div class="row mt-4">
                                        <h4>Skills and Sub-Skills</h4>
                                        <div id="skillsContainer">
                                            <!-- Main Skill with Sub-Skills will be added here -->
                                        </div>
                                        <button type="button" class="btn btn-primary wslk_button"
                                            onclick="addMainSkill()">Add Main
                                            Skill</button>
                                    </div>
                                </div>

                            </div>
                            <div id="langcounter">
                                <hr style="margin-top:20px;margin-bottom:20px;">
                                <h4>Lanuage Details</h4>
                                <div class="lang-repeat row">
                                    <div class="col">
                                        <label for="">Lanuages</label>
                                        <select class="form-control" name="lanuagesnames[]" id="">
                                            <option value="none">Select Lanuage</option>
                                            <option value="english">English</option>
                                            <option value="arabic">Arabic</option>
                                            <option value="hindi">Hindi/Urudhu</option>
                                            <option value="sinhala">Sinhala</option>
                                            <option value="tamil">Tamil</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="">Read</label>
                                        <select class="form-control" name="lanlangread[]" id="">
                                            <option value="none">Select Skill Level</option>
                                            <option value="fair">Fair</option>
                                            <option value="good">Good</option>
                                            <option value="excellent">Excellent</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="">Write</label>
                                        <select class="form-control" name="langwrite[]" id="">
                                            <option value="none">Select Skill Level</option>
                                            <option value="fair">Fair</option>
                                            <option value="good">Good</option>
                                            <option value="excellent">Excellent</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="">Speak</label>
                                        <select class="form-control" name="langspeak[]" id="">
                                            <option value="none">Select Skill Level</option>
                                            <option value="fair">Fair</option>
                                            <option value="good">Good</option>
                                            <option value="excellent">Excellent</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label> </label>
                                        <button type="button" onclick="addlang()" style="font-size:14px;"
                                            class="btn btn-primary mt-4">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2 mb-5">
                                <h4>Driving License</h4>
                                <div id="licenseContainer">
                                    <div class="row licenseGroup">
                                        <div class="col">
                                            <label>License Type</label>
                                            <input type="text" class="form-control" name="licensetype[]" id="">
                                        </div>
                                        <div class="col">
                                            <label>Country</label>
                                            <input type="text" class="form-control" name="licensecountry[]" id="">
                                        </div>
                                        <div class="col">
                                            <label>Orginal/Copy</label>
                                            <select name="licensecopy[]" class="form-select form-control" required>
                                                <option value="none">Select</option>
                                                <option value="original">Original</option>
                                                <option value="Ccopy">Copy</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Expirey Date</label>
                                            <input type="date" class="form-control" name="licenseexpirey[]" id="">
                                        </div>
                                        <div class="col">
                                            <label>Attach Copy</label>
                                            <input type="file" class="form-control" name="licensefileattach[]" id="">
                                        </div>
                                        <div class="col">
                                            <label> </label>
                                            <button type="button" onclick="addLicenseGroup()" style="font-size:14px;"
                                                class="btn btn-primary">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Forms section End Here -->
                            <button type="button" class="btn btn-secondary" onclick="saveData()">Save</button>
                            <button type="button" class="btn btn-secondary" onclick="prevStep(3)">Previous</button>
                            <button type="button" class="btn btn-primary" onclick="nextStep(5)">Next</button>

                        </div>
                        <!-- Step 4: Education & Professional Details -->
                        <div class="step" id="step5">
                            <h4>Education & Professional Details</h4>
                            <!--Forms section Starts Here -->
                            <h4>Educational Qalification</h4>
                            <!-- Educational Information Fields -->
                            <div class="">
                                <div id="educationContainer">
                                    <!-- Initial set of education fields -->
                                    <div class="education-entry row">
                                        <div class="col">
                                            <label>School Name</label>
                                            <input class="form-control" type="text" name="schoolname[]">
                                        </div>
                                        <div class="col">
                                            <label>OL/AL</label>
                                            <select name="edulevel[]" class="form-select form-control"
                                                onchange="handleEduLevelChange(this)" required>
                                                <option value="al">Advance Level</option>
                                                <option value="ol">Ordinary Level</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="status" class="form-label ">Year</label>
                                            <input type="number" class="form-control" name="eduyear[]" id="">
                                        </div>
                                        <div class="col">
                                            <label for="status" class="form-label ">Attach Certificate</label>
                                            <input type="file" class="form-control" name="certificate[]" id="">
                                        </div>
                                        <div class="col">
                                            <label> </label>
                                            <button type="button" onclick="addEducation()" style="font-size:14px;"
                                                class="btn btn-primary mt-4">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <h4>Proffessional Qualification</h4>
                                <div class="">
                                    <div id="coursesContainer">
                                        <!-- Initial set of course fields -->
                                        <div class="course-entry row">
                                            <div class="col">
                                                <label>Name Of Institute</label>
                                                <input class="form-control" type="text" name="institueName[]">
                                            </div>
                                            <div class="col">
                                                <label>Course Name</label>
                                                <input class="form-control" type="text" name="CourseName[]">
                                            </div>
                                            <div class="col">
                                                <label for="status" class="form-label">Status</label>
                                                <select name="CourseStatus[]" class="form-select" required>
                                                    <option value="Pending">Pending</option>
                                                    <option value="In Progress">In Progress</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="duration" class="form-label">Duration</label>
                                                <input type="text" class="form-control" name="duration[]" id="">
                                            </div>
                                            <div class="col">
                                                <label for="status" class="form-label ">Attach Certificate</label>
                                                <input type="file" class="form-control" name="courcecertificate[]"
                                                    id="">
                                            </div>
                                            <div class="col">
                                                <label> </label>
                                                <button type="button" onclick="addCourse()" style="font-size:14px;"
                                                    class="btn btn-primary mt-4">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-5">
                                <h4>Work Experience</h4>
                                <!-- Dropdown to select if there is work experience -->
                                <div class="row">
                                    <div class="col p-2">
                                        <label class="form-label">Do you have work experience?</label>
                                        <select name="hasWorkExperience" class="form-control"
                                            onchange="toggleExperienceFields(this)">
                                            <option value="none">Select Option</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Work Experience Section -->
                                <div class="row mt-2 experience-fields">
                                    <hr>
                                    <h4>Work Experience Details</h4>
                                    <div id="experienceContainer">
                                        <!-- Initial set of job experience fields -->
                                        <div class="experience-entry row">
                                            <div class="col p-2">
                                                <label class="form-label">Position</label>
                                                <input class="form-control" type="text" name="workposition[]">
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label">Company Name</label>
                                                <input class="form-control" type="text" name="CompanyName[]">
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label">Country</label>
                                                <input class="form-control" type="text" name="JobCountry[]">
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label">Years</label>
                                                <input class="form-control" type="text" name="JobYears[]">
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label">Attach Certificate</label>
                                                <input type="file" class="form-control" name="jobcertificate[]" id="">
                                            </div>
                                            <div class="col p-2">
                                                <label> </label>
                                                <button type="button" onclick="addExperience()" style="font-size:14px;"
                                                    class="btn btn-primary mt-4">+</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Training Details Section -->
                                <div class="row mt-2 training-fields">
                                    <hr>
                                    <h4>Training Details</h4>
                                    <div id="trainingContainer">
                                        <!-- Initial set of training details fields -->
                                        <div class="training-entry row">
                                            <div class="col p-2">
                                                <label class="form-label">Training Date</label>
                                                <input class="form-control" type="date" name="trainingDate">
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label">Duration</label>
                                                <input class="form-control" type="text" name="trainingDuration">
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label">Training Centre</label>
                                                <input class="form-control" type="text" name="trainingCentre">
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label">Remarks</label>
                                                <input class="form-control" type="text" name="trainingRemarks">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Forms section End Here -->
                            <button type="submit" class="btn btn-secondary">Save</button>
                            <button type="button" class="btn btn-secondary" onclick="prevStep(4)">Previous</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>












                <!--Content Ends Here -->
            </div>
        </div>
        <?php include('../includes/footer.php'); ?>
        <!--Form Multistep Form-->
        <script>
        $('#wizard1').steps({
            headerTag: 'h3',
            bodyTag: 'section',
            autoFocus: true,
            titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>'
        });
        </script>
        <!--Form Multistep End Form-->

        <script>
        //date of birth calculation registration form
        document.getElementById('dob').addEventListener('change', calculateAge);

        function calculateAge() {
            const dob = new Date(document.getElementById('dob').value);
            const today = new Date();
            const ageInMilliseconds = today - dob;

            const years = Math.floor(ageInMilliseconds / (365.25 * 24 * 60 * 60 * 1000));
            const remainingMonths = Math.floor((ageInMilliseconds % (365.25 * 24 * 60 * 60 * 1000)) / (30.44 * 24 * 60 *
                60 * 1000));
            const remainingDays = Math.floor((ageInMilliseconds % (30.44 * 24 * 60 * 60 * 1000)) / (24 * 60 * 60 *
                1000));

            document.getElementById('ageDisplay').innerHTML = `Age: ${years}Y, ${remainingMonths}M, ${remainingDays}D`;
        }
        </script>

        <!-- Hight Calculation Javascript Function -->
        <script>
        function convertHeight() {
            var feet = parseFloat(document.getElementById('heightFeet').value) || 0;
            var resultHeight = document.getElementById('resultHeight');

            var heightInCm = (feet * 30.48);

            if (!isNaN(heightInCm)) {
                resultHeight.innerHTML =
                    `Height in cm: ${heightInCm.toFixed(2)} cm`;
                resultHeight.style.display = 'block';
            } else {
                resultHeight.style.display = 'none';
            }
        }
        </script>

        <!--Passport Expiry Date -->
        <script>
        document.getElementById('expiryDate').addEventListener('change', calculateExpiry);

        function calculateExpiry() {
            const expiryDate = new Date(document.getElementById('expiryDate').value);
            const today = new Date();
            const timeDifference = expiryDate - today;

            const daysToExpire = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
            const yearsToExpire = Math.floor(daysToExpire / 365);
            const remainingMonths = Math.floor((daysToExpire % 365) / 30);
            const remainingDays = daysToExpire % 30; // Corrected line

            document.getElementById('expiryDisplay').innerHTML =
                `Expires in: ${yearsToExpire}Y, ${remainingMonths}M, ${remainingDays}D`;
        }
        </script>

        <!-- How did you found us section -->
        <script>
        document.getElementById('findUs').addEventListener('change', function() {
            var subAgentField = document.getElementById('subAgentField');
            if (this.value === 'subAgent') {
                subAgentField.style.display = 'block';
            } else {
                subAgentField.style.display = 'none';
            }
        });
        </script>

        <!-- Mobile Filed Validatio -->
        <script>
        var cleave = new Cleave('#inputPhoneNumber', {
            phone: true,
            phoneRegionCode: 'SL'
        });
        </script>

        <!-- Add Education Qualification -->
        <script>
        let eduEntryCount = 1; // Initialize the education entry count

        function addEducation() {
            const container = document.getElementById('educationContainer');

            // Limit to 2 entries
            if (eduEntryCount >= 2) {
                alert("You can add only 2 education entries.");
                return;
            }

            // Create a new education entry
            const educationEntry = document.createElement('div');
            educationEntry.className = 'education-entry row';

            // Add fields to the education entry
            educationEntry.innerHTML = `
        <div class="col">
            <label>School Name</label>
            <input class="form-control" type="text" name="schoolname[]">
        </div>
        <div class="col">
            <label>OL/AL</label>
            <select name="edulevel[]" class="form-select form-control" onchange="handleEduLevelChange(this)" required>
                <option value="al">Advance Level</option>
                <option value="ol">Ordinary Level</option>
            </select>
        </div>
        <div class="col">
            <label for="status" class="form-label ">Year</label>
            <input type="number" class="form-control" name="eduyear[]" id="">
        </div>
        <div class="col">
            <label for="status" class="form-label ">Attach Certificate</label>
            <input type="file" class="form-control" name="certificate[]" id="">
        </div>
        <div class="col">
            <label> </label>
            <button type="button" onclick="removeEducation(this)" style="font-size:14px;" class="btn btn-danger mt-4 remove-button">-</button>
        </div>
    `;

            // Increment entry count
            eduEntryCount++;

            // Append the education entry to the container
            container.appendChild(educationEntry);
        }

        function removeEducation(button) {
            // Decrement entry count
            eduEntryCount--;

            // Remove the parent education entry when the "Remove" button is clicked
            const container = document.getElementById('educationContainer');
            const educationEntry = button.parentNode.parentNode;
            container.removeChild(educationEntry);
        }

        function handleEduLevelChange(selectElement) {
            const options = selectElement.parentNode.parentNode.parentNode.querySelectorAll(
                'select[name="edulevel[]"]');

            // Ensure each subsequent entry shows the opposite level of the selected entry
            options.forEach(option => {
                if (option !== selectElement) {
                    if (selectElement.value === "al") {
                        option.innerHTML = `
                    <option value="ol">Ordinary Level</option>
                `;
                    } else if (selectElement.value === "ol") {
                        option.innerHTML = `
                    <option value="al">Advance Level</option>
                `;
                    }
                }
            });
        }
        </script>

        <!-- Professional Qualifications-->
        <script>
        function addCourse() {
            const container = document.getElementById('coursesContainer');

            // Create a new course entry
            const courseEntry = document.createElement('div');
            courseEntry.className = 'course-entry row';

            // Add fields to the course entry
            courseEntry.innerHTML = `
                                <hr style="margin-top:20px;margin-bottom:20px;">
                                            <div class="col">
                                                <label>Name Of Institute</label>
                                                <input class="form-control" type="text" name="institueName[]">
                                            </div>
                                            <div class="col">
                                                <label>Course Name</label>
                                                <input class="form-control" type="text" name="CourseName[]">
                                            </div>
                                            <div class="col">
                                                <label for="status" class="form-label">Status</label>
                                                <select name="CourseStatus[]" class="form-select" required>
                                                    <option value="Pending">Pending</option>
                                                    <option value="In Progress">In Progress</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </div>
                                            <div class="col">
                                            <label for="duration" class="form-label">Duration</label>
                                            <input type="text" class="form-control" name="duration[]" id="">
                                        </div>
                                            <div class="col">
                                                <label for="status" class="form-label ">Attach Certificate</label>
                                                <input type="file" class="form-control" name="courcecertificate[]" id="">
                                            </div>
                                            <div class="col">
                                                <label> </label>
                                                <button type="button" onclick="removeCourse(this)" style="font-size:14px;" class="btn btn-danger mt-4 remove-button">-</button>
                                            </div>
                                        `;

            // Append the course entry to the container
            container.appendChild(courseEntry);
        }

        function removeCourse(button) {
            // Remove the parent course entry when the "Remove" button is clicked
            const container = document.getElementById('coursesContainer');
            const courseEntry = button.parentNode.parentNode;
            container.removeChild(courseEntry);
        }
        </script>

        <!--Work Experiance -->
        <script>
        function addExperience() {
            const container = document.getElementById('experienceContainer');

            // Create a new job experience entry
            const experienceEntry = document.createElement('div');
            experienceEntry.className = 'experience-entry row';

            // Add fields to the job experience entry
            experienceEntry.innerHTML = `
                                <hr style="margin-top:20px;margin-bottom:20px;">
                                            <div class="col">
                                                <label>Position</label>
                                                <input class="form-control" type="text" name="workposition[]">
                                            </div>
                                            <div class="col">
                                                <label>Company Name</label>
                                                <input class="form-control" type="text" name="CompanyName[]">
                                            </div>
                                            <div class="col">
                                                <label>Country</label>
                                                <input class="form-control" type="text" name="JobCountry[]">
                                            </div>
                                            <div class="col">
                                                <label>Years</label>
                                                <input class="form-control" type="text" name="JobYears[]">
                                            </div>
                                            <div class="col">
                                                <label for="status" class="form-label ">Attach Certificate</label>
                                                <input type="file" class="form-control" name="jobcertificate[]" id="">
                                            </div>
                                            <div class="col">
                                                <label> </label>
                                                <button type="button" onclick="removeExperience(this)" style="font-size:14px;" class="btn btn-danger mt-4 remove-button">-</button>
                                            </div>
                                        `;

            // Append the job experience entry to the container
            container.appendChild(experienceEntry);
        }

        function removeExperience(button) {
            // Remove the parent job experience entry when the "Remove" button is clicked
            const container = document.getElementById('experienceContainer');
            const experienceEntry = button.parentNode.parentNode;
            container.removeChild(experienceEntry);
        }
        </script>

        <!-- Driving License Details -->
        <script>
        function addLicenseGroup() {
            const container = document.getElementById('licenseContainer');

            // Create a new job experience entry
            const experienceEntry = document.createElement('div');
            experienceEntry.className = 'row licenseGroup';

            // Add fields to the job experience entry
            experienceEntry.innerHTML = `
                                                <div class="col">
                                        <label>License Type</label>
                                        <input type="text" class="form-control" name="licensetype[]" id="">
                                        </div>
                                        <div class="col">
                                        <label>Country</label>
                                        <input type="text" class="form-control" name="licensecountry[]" id="">
                                        </div>
                                        <div class="col">
                                        <label>Orginal/Copy</label>
                                        <select name="licensecopy[]" class="form-select form-control" required>
                                                            <option value="none">Select</option>
                                                            <option value="original">Original</option>
                                                            <option value="Ccopy">Copy</option>
                                                        </select>
                                        </div>
                                        <div class="col">
                                        <label>Expirey Date</label>
                                        <input type="text" class="form-control" name="licenseexpirey[]" id="">
                                        </div>
                                        <div class="col">
                                        <label>Attach Copy</label>
                                        <input type="file" class="form-control" name="licensefileattach[]" id="">
                                        </div>
                                                    <div class="col">
                                                        <label> </label>
                                                        <button type="button" onclick="removeLicenseGroup(this)" style="font-size:14px;" class="btn btn-danger mt-4 remove-button">-</button>
                                                    </div>
                                                `;

            // Append the job experience entry to the container
            container.appendChild(experienceEntry);
        }

        function removeLicenseGroup(button) {
            // Remove the parent job experience entry when the "Remove" button is clicked
            const container = document.getElementById('licenseContainer');
            const experienceEntry = button.parentNode.parentNode;
            container.removeChild(experienceEntry);
        }
        </script>

        <!-- Languages Add more Script -->
        <script>
        function addlang() {
            const container = document.getElementById('langcounter');
            const maxLanguages = 5; // Maximum number of languages allowed

            // Check the number of current language entries before adding a new one
            if (container.children.length >= maxLanguages) {
                alert('You have added all languages.');
                return; // Exit the function to prevent adding more than the allowed number
            }

            // Create a new language entry
            const languageEntry = document.createElement('div');
            languageEntry.className = 'lang-repeat row';

            // Add fields to the language entry
            languageEntry.innerHTML = `
        <div class="col">
            <label for="">Languages</label>
            <select class="form-control" name="lanuagesnames[]" id="">
                <option value="none">Select Language</option>
                <option value="english">English</option>
                <option value="arabic">Arabic</option>
                <option value="hindi">Hindi/Urdu</option>
                <option value="sinhala">Sinhala</option>
                <option value="tamil">Tamil</option>
            </select>
        </div>
        <div class="col">
            <label for="">Read</label>
            <select class="form-control" name="lanlangread[]" id="">
                <option value="none">Select Skill Level</option>
                <option value="fair">Fair</option>
                <option value="good">Good</option>
                <option value="excellent">Excellent</option>
            </select>
        </div>
        <div class="col">
            <label for="">Write</label>
            <select class="form-control" name="langwrite[]" id="">
                <option value="none">Select Skill Level</option>
                <option value="fair">Fair</option>
                <option value="good">Good</option>
                <option value="excellent">Excellent</option>
            </select>
        </div>
        <div class="col">
            <label for="">Speak</label>
            <select class="form-control" name="langspeak[]" id="">
                <option value="none">Select Skill Level</option>
                <option value="fair">Fair</option>
                <option value="good">Good</option>
                <option value="excellent">Excellent</option>
            </select>
        </div>
        <div class="col">
            <label> </label>
            <button type="button" onclick="removelang(this)" style="font-size:14px;" class="btn btn-danger mt-4 remove-button">-</button>
        </div>
    `;

            // Append the new language entry to the container
            container.appendChild(languageEntry);
        }

        function removelang(button) {
            // Remove the parent language entry when the "Remove" button is clicked
            const container = document.getElementById('langcounter');
            const languageEntry = button.parentNode.parentNode;
            container.removeChild(languageEntry);
        }
        </script>

        <!-- add family details -->
        <script>
        function addRepeater() {
            const container = document.getElementById('repeaterContainer');

            // Create a new repeater field group
            const repeaterGroup = document.createElement('div');
            repeaterGroup.className = 'row repeater-group';

            // Add fields to the repeater group
            repeaterGroup.innerHTML = `
                <div class="row">
                                            <div class="col p-2">
                                                <label class="form-label ">Name</label>
                                                <input class="form-control" type="text" name="childName[]">
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label ">Relationship</label>
                                                <select name="childRelationship[]" class="form-control">
                                                    <option value="son">Son</option>
                                                    <option value="daughter">Daughter</option>
                                                    <option value="brother">Brother</option>
                                                    <option value="sister">Sister</option>
                                                </select>
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label ">Date of Birth</label>
                                                <input class="form-control" type="date" name="childDOB[]"
                                                    onchange="calculateAge2(this)">
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label ">Age</label>
                                                <input class="form-control" type="text" name="childAge[]" readonly>
                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="col p-2">
                                                <label class="form-label ">School Attended</label>
                                                <select name="childSchoolAttended[]" class="form-control"
                                                    onchange="toggleSchoolFields(this)">
                                                    <option value="none">Select Option</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                            <div class="col school-fields" style="display: none;">
                                                <div class="row">
                                                    <div class="col p-2">
                                                        <label class="form-label ">School Name</label>
                                                        <input class="form-control" type="text"
                                                            name="childSchoolName[]">
                                                    </div>
                                                    <div class="col p-2">
                                                        <label class="form-label ">Grade</label>
                                                        <input class="form-control" type="text" name="childGrade[]">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col p-2" id="nationalIdField">
                                                <label class="form-label ">National ID</label>
                                                <input class="form-control" type="text" name="childNIC[]">
                                            </div>
                                            <div class="col p-2" id="">
                                                <label for="sibilingnicfront" class="form-label ">Sibiling NIC
                                                    Front</label>
                                                <input type="file" class="form-control" name="sibilingnicfront[]" id="">
                                            </div>
                                            <div class="col p-2" id="">
                                                <label for="sibilingnicback" class="form-label ">Sibiling NIC
                                                    Back</label>
                                                <input type="file" class="form-control" name="sibilingnicback[]" id="">
                                            </div>
                <div class="col">
                    <label> </label>
                    <button type="button" onclick="removeRepeater(this)" style="font-size:14px;" class="btn btn-danger mt-4">-</button>
                </div>
            `;

            // Append the repeater group to the container
            container.appendChild(repeaterGroup);
        }

        function removeRepeater(button) {
            // Remove the parent repeater group when the "Remove" button is clicked
            const container = document.getElementById('repeaterContainer');
            const repeaterGroup = button.parentNode.parentNode;
            container.removeChild(repeaterGroup);
        }
        </script>

        <!--Capture Images  -->
        <script>
        document.addEventListener('DOMContentLoaded', () => {
            const profileImageInput = document.getElementById('profileImageInput');
            const profileImage = document.getElementById('profileImage');
            const openCameraButton = document.getElementById('openCameraButton');
            const cameraPreview = document.getElementById('cameraPreview');
            let stream;

            // Function to handle file input change and preview
            profileImageInput.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profileImage.src = e.target.result;
                    }
                    reader.readAsDataURL(file);
                }
            });

            // Function to open camera and take a photo
            openCameraButton.addEventListener('click', async () => {
                if (navigator.mediaDevices && navigator.mediaDevices
                    .getUserMedia) {
                    try {
                        stream = await navigator.mediaDevices
                            .getUserMedia({
                                video: true
                            });
                        cameraPreview.srcObject = stream;
                        cameraPreview.style.display = 'block';
                        cameraPreview.play();

                        if (!document.getElementById(
                                'takePhotoButton')) {
                            const takePhotoButton = document
                                .createElement('button');
                            takePhotoButton.type = 'button';
                            takePhotoButton.id = 'takePhotoButton';
                            takePhotoButton.innerText = 'Capture Photo';
                            takePhotoButton.addEventListener('click',
                                capturePhoto);
                            openCameraButton.parentElement.appendChild(
                                takePhotoButton);
                        }
                    } catch (error) {
                        console.error('Error accessing the camera: ',
                            error);
                    }
                } else {
                    alert('Camera not supported on this device');
                }
            });

            // Function to capture the photo from the video stream
            const capturePhoto = () => {
                const canvas = document.createElement('canvas');
                canvas.width = cameraPreview.videoWidth;
                canvas.height = cameraPreview.videoHeight;
                const context = canvas.getContext('2d');
                context.drawImage(cameraPreview, 0, 0, canvas.width, canvas
                    .height);
                profileImage.src = canvas.toDataURL('image/png');

                // Stop the video stream
                stream.getTracks().forEach(track => track.stop());
                cameraPreview.style.display = 'none';

                const takePhotoButton = document.getElementById(
                    'takePhotoButton');
                if (takePhotoButton) {
                    takePhotoButton.remove();
                }
            };
        });
        </script>


        <!-- Skills selection --->
        <script>
        const subSkillOptions = {
            'programming': ['JavaScript', 'Python', 'SQL'],
            'design': ['Graphic Design', 'UI/UX', 'Photoshop'],
            'marketing': ['SEO', 'Content Writing', 'Social Media'],
            'management': ['Project Management', 'Team Leadership', 'Agile']
        };

        function addMainSkill() {
            const container = document.getElementById('skillsContainer');
            const mainSkillEntry = document.createElement('div');
            mainSkillEntry.className = 'skill-entry row';

            mainSkillEntry.innerHTML = `
                <div class="col-md-4">
                    <label>Main Skill</label>
                    <select class="form-control main-skill-select" onchange="loadSubSkills(this)">
                        <option value="none">Select Main Skill</option>
                        <option value="programming">Programming</option>
                        <option value="design">Design</option>
                        <option value="marketing">Marketing</option>
                        <option value="management">Management</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Sub Skills</label>
                    <div class="sub-skill-tags"></div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger" onclick="removeSkillEntry(this)">Remove</button>
                </div>
            `;

            container.appendChild(mainSkillEntry);
        }

        function loadSubSkills(select) {
            const selectedSkill = select.value;
            const subSkillTags = select.parentElement.nextElementSibling.querySelector('.sub-skill-tags');
            subSkillTags.innerHTML = ''; // Clear existing sub-skills

            if (subSkillOptions[selectedSkill]) {
                subSkillOptions[selectedSkill].forEach(subSkill => {
                    const tag = document.createElement('span');
                    tag.className = 'badge badge-secondary';
                    tag.textContent = subSkill;

                    // Toggle selection on click
                    tag.onclick = function() {
                        tag.classList.toggle('badge-selected');
                    };

                    subSkillTags.appendChild(tag);
                });
            }
        }

        function removeSkillEntry(button) {
            const skillEntry = button.parentElement.parentElement;
            skillEntry.remove();
        }

        // On form submit, prepare the hidden inputs
        document.querySelector('form').addEventListener('submit', function() {
            const hiddenContainer = document.getElementById('hiddenSkillsContainer');
            hiddenContainer.innerHTML = ''; // Clear previous inputs

            const skillEntries = document.querySelectorAll('.skill-entry');
            skillEntries.forEach(function(entry, index) {
                const mainSkill = entry.querySelector('.main-skill-select').value;
                const subSkills = Array.from(entry.querySelectorAll('.sub-skill-tags .badge-selected'))
                    .map(tag => tag.textContent); // Get text of selected badges

                // Create hidden inputs for main skill
                const mainSkillInput = document.createElement('input');
                mainSkillInput.type = 'hidden';
                mainSkillInput.name = `skills[${index}][main]`;
                mainSkillInput.value = mainSkill;
                hiddenContainer.appendChild(mainSkillInput);

                // Create hidden inputs for each sub-skill
                subSkills.forEach(function(subSkill) {
                    const subSkillInput = document.createElement('input');
                    subSkillInput.type = 'hidden';
                    subSkillInput.name = `skills[${index}][sub][]`;
                    subSkillInput.value = subSkill;
                    hiddenContainer.appendChild(subSkillInput);
                });
            });
        });
        </script>

        <!-- toggle school -->
        <script>
        // Function to show or hide school fields based on "School Attended" selection
        function toggleSchoolFields(selectElement) {
            const schoolFields = selectElement.closest('.row').querySelector('.school-fields');
            if (selectElement.value === 'yes') {
                schoolFields.style.display = 'block';
            } else {
                schoolFields.style.display = 'none';
            }
        }

        // Example function to calculate age based on DOB (You need to implement it based on your requirements)
        function calculateAge2(dobInput) {
            const dob = new Date(dobInput.value);
            const today = new Date();
            const age = today.getFullYear() - dob.getFullYear();
            dobInput.closest('.row').querySelector('input[name="childAge[]"]').value = age;
        }
        </script>
        <script>
        // Function to toggle visibility of experience and training fields
        function toggleExperienceFields(selectElement) {
            const experienceFields = document.querySelector('.experience-fields');
            const trainingFields = document.querySelector('.training-fields');

            if (selectElement.value === 'yes') {
                experienceFields.style.display = 'block';
                trainingFields.style.display = 'none';
            } else if (selectElement.value === 'no') {
                experienceFields.style.display = 'none';
                trainingFields.style.display = 'block';
            } else {
                experienceFields.style.display = 'none';
                trainingFields.style.display = 'none';
            }
        }
        </script>
        <!-- Multistep Form -->
        <script>
        function showStep(stepNumber) {
            // Hide all steps
            document.querySelectorAll('.step').forEach(function(step) {
                step.classList.remove('active');
            });

            // Remove active class from all navigation buttons
            document.querySelectorAll('.step-navigation .nav-link').forEach(function(btn) {
                btn.classList.remove('active');
            });

            // Show the current step and set active class on corresponding navigation button
            document.getElementById('step' + stepNumber).classList.add('active');
            document.querySelectorAll('.step-navigation .nav-link')[stepNumber - 1].classList.add('active');
        }

        function nextStep(stepNumber) {
            showStep(stepNumber);
        }

        function prevStep(stepNumber) {
            showStep(stepNumber);
        }

        function saveData() {
            alert('Data saved!');
            // Here, you can add code to save form data via AJAX or local storage
        }

        // Handle form submission
        document.getElementById('multiStepForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission
            alert('Form submitted successfully!');
            // Add your form submission logic here
        });
        </script>

</body>

</html>
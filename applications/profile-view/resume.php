<?php include('../../includes/header.php');

if(isset($_GET['client_id'])) {

    $client_id = $_GET['client_id'];
    $sql = "SELECT * FROM applications WHERE applicationID=$client_id";
    $res = mysqli_query($conn, $sql);
    if ($row = mysqli_fetch_assoc($res)) {


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
        $applicantGender=$row["applicantGender"];
// Calculate age
        $birthdate = new DateTime($client_birthday);
        $today = new DateTime('today');
        $age = $birthdate->diff($today);

        $profileImage = '../../uploads/profile_images/' . $client_photo;
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
    }
    $sqlContact = "
    SELECT c.`applicant_email`, c.`applicant_landphone`, c.`applicant_phone`, c.`applicant_phone2`, 
           c.`applicant_add1`, c.`applicant_add2`, c.`applicant_province`, c.`applicant_city`, 
           c.`applicant_gsdevision`, p.`name` AS `province_name`, ci.`name` AS `cityname`, gs.`name` AS `gs_name`
    FROM `contact_information` c
    LEFT JOIN `provinces` p ON c.`applicant_province` = p.`id`
    LEFT JOIN `cities` ci ON c.`applicant_city` = ci.`id`
    LEFT JOIN `gs_divisions` gs ON c.`applicant_gsdevision` = gs.`id`
    WHERE c.`applicant_id` = ? AND c.softdeletestatus = 1";
    $stmt7 = $conn->prepare($sqlContact);
    $stmt7->bind_param("i", $client_id);
    $stmt7->execute();
    $result7 = $stmt7->get_result();
    $contact = $result7->fetch_assoc();

    $email = $contact["applicant_email"];
    $phone_number = $contact["applicant_phone"];
    $applicant_add1 = $contact["applicant_add1"];
    $applicant_add2 = $contact["applicant_add2"];
    $applicant_city = $contact["applicant_city"];
    $applicant_province = $contact["applicant_province"];

$sqlLan = "SELECT * FROM language_details WHERE LangClientId=$client_id";
$resLan = mysqli_query($conn, $sqlLan);
//$rowLan = mysqli_fetch_assoc($resLan);
    $sqleducation = "SELECT ed.educationId, ed.schoolName, ed.edutype, ed.educationYear, 
                            ad.attachFilename, ad.attachemnt
                     FROM education_details ed
                     LEFT JOIN attachemnts_data ad ON ed.educationId = ad.attachmentsourceId 
                     AND ad.attachemnet_ClientID = ed.educationClientId 
                     AND ad.attachmentType = 'Education-Certificate'
                     WHERE ed.educationClientId = ? 
                     AND ed.softdeletestatus = 1";

    $stmt8 = $conn->prepare($sqleducation); // Use prepared statements to avoid SQL injection
    $stmt8->bind_param("i", $client_id); // Bind the client ID as an integer
    $stmt8->execute();
    $result8 = $stmt8->get_result();


    $sqlwork = "SELECT w.`workId`, w.`workPosition`, w.`workCompany`, w.`workCountry`, w.`workStart`, w.`workEnd`, w.`createdAt`, 
                       ad.`attachFilename`, ad.`attachemnt`
                FROM `worke` w
                LEFT JOIN `attachemnts_data` ad ON w.`workId` = ad.`attachmentsourceId` AND ad.`attachmentType` = 'WorkExperience'
                WHERE w.`softdeletestatus`=1 AND w.`workClinetID` = ?";
    $stmt2 = $conn->prepare($sqlwork); // Use prepared statements to avoid SQL injection
    $stmt2->bind_param("i", $client_id); // Bind the client ID as an integer
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    $sqlqualification = "SELECT pq.`Qualification_ID`, pq.`institueName`, pq.`courseName`, pq.`Qualification_Duration`, pq.`Qualification_Status`, ad.`attachFilename`, ad.`attachemnt` 
                         FROM `professional_qualifications` pq
                         LEFT JOIN `attachemnts_data` ad ON pq.`Qualification_ID` = ad.`attachmentsourceId` 
                         AND ad.`attachmentType` = 'qualification'
                         WHERE pq.`softdeletestatus`=1 AND pq.`QulificationClientID` = ?";
    $stmt1 = $conn->prepare($sqlqualification); // Use prepared statements to avoid SQL injection
    $stmt1->bind_param("i", $client_id); // Bind the client ID as an integer
    $stmt1->execute();
    $result1 = $stmt1->get_result();
}
?>
<body class="">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha256-2XFplPlrFClt0bIdPgpz8H7ojnk10H69xRqd9+uTShA=" crossorigin="anonymous" />
<style>
    /* My Resume */
    .profile {
        margin-bottom: 25px;
    }
    .profile .jobster-user-info {
        display: inline-block;
        width: 100%;
    }
    .profile .jobster-user-info .profile-avatar {
        position: relative;
        height: 115px;
        width: 115px;
        border-radius: 100%;
        display: inline-block;
    }
    .profile .jobster-user-info .profile-avatar img {
        border-radius: 100%;
    }
    .profile .jobster-user-info .profile-avatar i {
        font-size: 16px;
        color: #21c87a;
        position: absolute;
        background: #ffffff;
        border-radius: 100%;
        cursor: pointer;
        height: 30px;
        width: 30px;
        line-height: 30px;
        text-align: center;
        bottom: 20px;
        right: -5px;
    }

    .about-candidate {
        padding: 25px 0px;
    }
    .about-candidate .candidate-info {
        margin-bottom: 20px;
    }

    .resume-experience {
        padding-left: 10px;
        padding-top: 60px;
        padding-bottom: 60px;
        position: relative;
        padding-right: 50px;
        background: #f6f6f6;
    }
    .resume-experience:before {
        position: absolute;
        left: -40%;
        right: 0;
        width: 100%;
        height: 100%;
        background: #f6f6f6;
        content: "";
        z-index: -1;
        top: 0;
    }
    .resume-experience .jobster-candidate-timeline .jobster-timeline-item .jobster-timeline-cricle {
        border-color: #f6f6f6;
    }

    .user-dashboard-info-box .select2-container--default .select2-selection--single .select2-selection__rendered {
        font-weight: bold;
        color: #626262;
    }

    @media (max-width: 1199px) {
        .secondary-menu ul li a {
            padding: 10px 15px;
        }
    }

    @media (max-width: 991px) {
        .resume-experience {
            padding-left: 15px;
            padding-top: 30px;
            padding-bottom: 30px;
            padding-right: 15px;
        }
        .resume-experience:before {
            content: none;
        }
        .secondary-menu ul li {
            display: inline-block;
        }
    }

    @media (max-width: 575px) {
        .secondary-menu ul li a {
            padding: 4px 8px;
        }
    }

    /*****************************
        Progress Bar
    *****************************/
    .progress {
        position: relative;
        overflow: inherit;
        height: 3px;
        margin: 40px 0px 15px;
        width: 100%;
        display: inline-block;
    }
    .progress .progress-bar {
        height: 3px;
        background: #21c87a;
    }
    .progress .progress-bar-title {
        position: absolute;
        left: 0;
        top: -20px;
        color: #212529;
        font-size: 14px;
        font-weight: 600;
    }
    .progress .progress-bar-number {
        position: absolute;
        right: 0;
        color: #646f79;
        top: -20px;
    }


    /* Jobster Candidate */
    .jobster-candidate-timeline {
        position: relative;
    }
    .jobster-candidate-timeline:before {
        content: "";
        position: absolute;
        left: 20px;
        width: 2px;
        top: 5px;
        bottom: 5px;
        height: calc(100% - 5px);
        background-color: #eeeeee;
    }

    .jobster-candidate-timeline .jobster-timeline-item {
        display: table;
        position: relative;
        margin-bottom: 20px;
        width: 100%;
    }

    .jobster-candidate-timeline .jobster-timeline-item .jobster-timeline-cricle {
        border-radius: 50%;
        border: 12px solid white;
        z-index: 1;
        top: 5px;
        left: 9px;
        position: absolute;
    }
    .jobster-candidate-timeline .jobster-timeline-item .jobster-timeline-cricle:before {
        content: "";
        position: absolute;
        left: 12px;
        width: 20px;
        top: -1px;
        bottom: 5px;
        height: 2px;
        background-color: #eeeeee;
    }
    .jobster-candidate-timeline .jobster-timeline-item .jobster-timeline-cricle > i {
        font-size: 15px;
        top: -8px;
        left: -7px;
        position: absolute;
        color: #21c87a;
    }

    .jobster-candidate-timeline .jobster-timeline-item .jobster-timeline-info {
        display: table-cell;
        vertical-align: top;
        padding: 5px 0 0 70px;
    }
    .jobster-candidate-timeline .jobster-timeline-item .jobster-timeline-info h6 {
        color: #21c87a;
        margin: 5px 0 0px;
    }
    .jobster-candidate-timeline .jobster-timeline-item .jobster-timeline-info span {
        color: #212529;
        font-size: 13px;
        font-weight: 500;
    }

    .jobster-candidate-timeline span.jobster-timeline-time {
        color: #646f79 !important;
    }

    .jobster-candidate-timeline .jobster-timeline-icon {
        border: 2px solid #eeeeee;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        line-height: 42px;
        text-align: center;
        background: #ffffff;
        position: relative;
        margin-bottom: 20px;
    }
    .jobster-candidate-timeline .jobster-timeline-icon i {
        font-size: 16px;
        color: #212529;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 16px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="resume-base bg-primary user-dashboard-info-box p-4">
                        <div class="profile">
                            <div class="jobster-user-info">
                                <div class="profile-avatar">
                                    <img class="img-fluid " src="<?php echo $imgSrc; ?>" alt="">
                                </div>
                                <div class="profile-avatar-info mt-3">
                                    <h5 class="text-white"><?php echo $clientTitle." ".$client_fname." ".$client_mname." ".$client_lname; ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="about-candidate border-top">
                            <div class="candidate-info">
                                <h6 class="text-white">Name:</h6>
                                <p class="text-white"><?php echo $clientTitle." ".$client_fname." ".$client_mname." ".$client_lname; ?></p>
                            </div>
                            <div class="candidate-info">
                                <h6 class="text-white">Email:</h6>
                                <p class="text-white"><?php echo $email ?></p>
                            </div>
                            <div class="candidate-info">
                                <h6 class="text-white">Phone:</h6>
                                <p class="text-white"><?php echo $phone_number?></p>
                            </div>
                            <div class="candidate-info">
                                <h6 class="text-white">Date Of Birth:</h6>
                                <p class="text-white"><?php echo $client_birthday ?></p>
                            </div>
                            <div class="candidate-info">
                                <h6 class="text-white">Address:</h6>
                                <p class="text-white"><?php echo $applicant_add1." , ".$applicant_add2 ?></p>
                            </div>
                            <div class="candidate-info">
                                <h6 class="text-white">Gender:</h6>
                                <p class="text-white"><?php echo $applicantGender?></p>
                            </div>
                        </div>
                        <div class="mt-0">
                            <h5 class="text-white">Language Skill:</h5>
                        <?php while($rowLan = mysqli_fetch_assoc($resLan)) { ?>

                                <?php if($rowLan['LangSpeak']=="excellent"){ ?>
                                <div class="progress bg-dark">
                                    <div class="progress-bar bg-white" role="progressbar" style="width:100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar-title text-white"><?php echo $rowLan['LangName']?></div>
                                        <span class="progress-bar-number text-white">100%</span>
                                    </div>
                                </div>
                                     <?php }elseif ($rowLan['LangSpeak']=="good"){ ?>
                                <div class="progress bg-dark">
                                    <div class="progress-bar bg-white" role="progressbar" style="width:80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar-title text-white"><?php echo $rowLan['LangName']?></div>
                                        <span class="progress-bar-number text-white">80%</span>
                                    </div>
                                </div>
                                    <?php }elseif ($rowLan['LangSpeak']=="fair"){ ?>
                                <div class="progress bg-dark">
                                    <div class="progress-bar bg-white" role="progressbar" style="width:20%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar-title text-white"><?php echo $rowLan['LangName']?></div>
                                        <span class="progress-bar-number text-white">20%</span>
                                    </div>
                                </div>
                                    <?php }elseif ($rowLan['LangSpeak']=="none"){ ?>
                                    <span class="progress-bar-number text-white">0%</span> <div class="progress bg-dark">
                                    <div class="progress-bar bg-white" role="progressbar" style="width:0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar-title text-white"><?php echo $rowLan['LangName']?></div>
                                        <span class="progress-bar-number text-white">0%</span>
                                    </div>
                                </div>
                                    <?php } ?>

                            <?php } ?>


                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="resume-experience">
                        <div class="timeline-box">
                            <h5 class="resume-experience-title">Education:</h5>
                            <div class="jobster-candidate-timeline">
                                <?php while($rowEdu = mysqli_fetch_assoc($result8)) { ?>
                                <div class="jobster-timeline-item">
                                    <div class="jobster-timeline-cricle">
                                        <i class="far fa-circle"></i>
                                    </div>
                                    <div class="jobster-timeline-info">
                                        <div class="dashboard-timeline-info">
                                            <span class="jobster-timeline-time"><?php echo $rowEdu['educationYear'] ?></span>
                                            <?php if($rowEdu['edutype']=="ol"){ ?>
                                            <h6 class="mb-2">General Certificate of Education (Ordinary Level) </h6>
                                            <?php }elseif($rowEdu['edutype']=="al"){ ?>
                                            <h6 class="mb-2"> General Certificate of Education (Advanced Level)  </h6>
                                            <?php }?>
                                            <span>- <?php echo $rowEdu['schoolName'] ?></span>
                                            <?php if($rowEdu['edutype']=="ol"){ ?>
                                                <p class="mt-2">After grade 11, students take national exams for the General Certificate of Education (Ordinary Level) . The General Certificate of Education (Ordinary Level) is often abbreviated as GCE O/L.</p>
                                            <?php }elseif($rowEdu['edutype']=="al"){ ?>
                                                <p class="mt-2">After grade 13, students take national exams for the General Certificate of Education (Advanced Level) . The General Certificate of Education (Advanced Level) is often abbreviated as GCE A/L</p>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                               <?php } ?>
                            </div>
                        </div>
                        <div class="timeline-box mt-4">
                            <h5 class="resume-experience-title">Work &amp; Experience:</h5>
                            <div class="jobster-candidate-timeline">
                                <?php while($rowWork = mysqli_fetch_assoc($result2)) { ?>

                                <div class="jobster-timeline-item">
                                    <div class="jobster-timeline-cricle">
                                        <i class="far fa-circle"></i>
                                    </div>
                                    <div class="jobster-timeline-info">
                                        <div class="dashboard-timeline-info">
                                            <span class="jobster-timeline-time"><?php echo $rowWork["workStart"]." to ". $rowWork["workEnd"]   ?></span>
                                            <h6 class="mb-2"><?php echo $rowWork["workPosition"] ?></h6>
                                            <span>- <?php echo $rowWork["workCompany"] ?></span>
                                            <p class="mt-2">One of the main areas that I work on with my clients is shedding these non-supportive beliefs and replacing them with beliefs that will help them to accomplish their desires.</p>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="timeline-box mt-4">
                            <h5 class="resume-experience-title">Professional Qualifications:</h5>
                            <div class="jobster-candidate-timeline">
                                <?php while($rowPro = mysqli_fetch_assoc($result1)) { ?>
                                <div class="jobster-timeline-item">
                                    <div class="jobster-timeline-cricle">
                                        <i class="far fa-circle"></i>
                                    </div>
                                    <div class="jobster-timeline-info">
                                        <div class="dashboard-timeline-info">
                                            <span class="jobster-timeline-time"><?php echo $rowPro["Qualification_Status"]?></span>
                                            <h6 class="mb-2"><?php echo $rowPro["courseName"]?></h6>
                                            <span>- <?php echo $rowPro["institueName"]?></span>
                                            <p class="mt-2">One of the main areas that I work on with my clients is shedding these non-supportive beliefs and replacing them with beliefs that will help them to accomplish their desires.</p>
                                        </div>
                                    </div>
                                </div>
                               <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

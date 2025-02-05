<?php

// Check if 'client_id' is set in the URL
if (isset($_GET['client_id'])) {
    $client_id = $_GET['client_id'];

    // Query to fetch applicant's personal information from the `applications` table
    $sqlApplicant = "SELECT `profile_image`,`applicationID` ,`applicantTitle`, `applicatFname`, `applicantMname`, `applicantLname`, 
                            `applicantDob`, `applicantPassno`, `applicantNICno`, `applicantPassdate`, `applicantNationality`, 
                            `applicanthight`, `applicantWeight`, `applicantGender`, `appReligion`, `appRase`, 
                            `maritalestatus`, `how_foun_us`, `subagentId`, `applicantStatus` 
                     FROM `applications` 
                     WHERE `softdeletStatus` = 1 AND `applicationID` = ?";

    $stmt6 = $conn->prepare($sqlApplicant); // Use prepared statements to avoid SQL injection
    $stmt6->bind_param("i", $client_id); // Bind the client ID as an integer
    $stmt6->execute();
    $result6 = $stmt6->get_result(); // Get the result set

    if ($result6->num_rows > 0) {
        $applicant = $result6->fetch_assoc(); // Fetch the applicant's data

        // If subagentId is present, fetch the sub-agent details
        $subagentId = $applicant['subagentId'];
        if ($subagentId) {
            $sqlAgent = "SELECT `fagentTitle`, `fagentFname`, `fagentLname`, `fagentProfile` FROM `foreign_agent_details` WHERE `fagentId` = ?";
            $stmt5 = $conn->prepare($sqlAgent);
            $stmt5->bind_param("i", $subagentId);
            $stmt5->execute();
            $result5 = $stmt5->get_result();
            $agent = $result5->fetch_assoc(); // Fetch the agent's data
        }

        // Fetch contact information from the `contact_information` table
        /* $sqlContact = "SELECT `applicant_email`, `applicant_landphone`, `applicant_phone`,`applicant_phone2`,`applicant_add1`,`applicant_add2`,`applicant_province`,`applicant_city`,`applicant_gsdevision` FROM `contact_information` LEFT JOIN `provinces` ON contact_information.applicant_province = provinces.id WHERE `applicant_id` = ? AND softdeletestatus=1";*/

        $sqlContact = "
    SELECT c.`applicant_email`,c.`applicant_landphone`, c.`applicant_phone`, c.`applicant_phone2`, 
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
        $contact = $result7->fetch_assoc(); // Fetch the contact details

        // Fetch driving license information from the `driving_license` table
        /* $sqlLicense = "SELECT d.`License_Type`, d. `document_Type`, d. `License_Country`, d. `License_Expiry`, c.`CountryName` FROM `driving_license_deatils` d LEFT JOIN   `list_of_countries` c ON d.`License_Country`= c.`countryId` WHERE d.`LicneseClinetId` = ? AND d.softdeletestatus=1";*/
        $sqlLicense = "SELECT
    d.`LicenseId`,
    d.`LicneseClinetId`,    
    d.`License_Type`, 
    d.`document_Type`, 
    d.`License_Country`, 
    d.`License_Expiry`, 
    c.`CountryName`, 
    a.`attachemnetId`,
    a.`attachemnt`,
    a.`attachFilename`
FROM 
    `driving_license_deatils` d
LEFT JOIN 
    `list_of_countries` c ON d.`License_Country` = c.`countryId`
LEFT JOIN 
    `attachemnts_data` a ON d.`LicenseId` = a.`attachmentsourceId`
                          AND a.`attachmentType` = 'Driving_License'
                          AND a.`attachemnetId` = (
                              SELECT MAX(attachemnetId) 
                              FROM `attachemnts_data`
                              WHERE `attachmentsourceId` = d.`LicenseId`
                                AND `attachmentType` = 'Driving_License'
                          )
WHERE 
    d.`LicneseClinetId` = ? 
    AND d.`softdeletestatus` = 1;";
        $stmt8 = $conn->prepare($sqlLicense);
        $stmt8->bind_param("i", $client_id);
        $stmt8->execute();
        $result8 = $stmt8->get_result();
        $licenseNew = $result8->fetch_assoc();

        // Fetch language information from the `languages` table
        $sqlLang = "SELECT `LangId`, `LangName`, `LangRead`, `LangWrite`, `LangSpeak` FROM `language_details` WHERE `LangClientId` = ? AND softdeletestatus=1";
        $stmt9 = $conn->prepare($sqlLang);
        $stmt9->bind_param("i", $client_id);
        $stmt9->execute();
        $result9 = $stmt9->get_result();
        $language_new=$result9->fetch_assoc();

        // Now display the data
        ?>
<div class="container mt-5">
    <div class="row">
        <!-- Display Applicant's Personal Information -->
        <div class="col-md-12">
            <h4>Personal Information</h4>
            <table class="table table-bordered" id="personalInfoTable">
                <tr style="background-color: #f2f2f2;">
                    <th>Full Name</th>
                    <td colspan="5">
                        <?php echo $applicant['applicantTitle'] . " " . $applicant['applicatFname'] . " " . $applicant['applicantMname'] . " " . $applicant['applicantLname']; ?>
                    </td>
                </tr>
                <tr style="background-color: #f2f2f2;">
                    <th>Date of Birth</th>
                    <td><?php echo $applicant['applicantDob']; ?></td>
                    <th>Passport No.</th>
                    <td><?php echo $applicant['applicantPassno']; ?></td>
                    <th>NIC No.</th>
                    <td><?php echo $applicant['applicantNICno']; ?></td>
                </tr>
                <tr style="background-color: #f2f2f2;">
                    <th>Passport Issue Date</th>
                    <td><?php echo $applicant['applicantPassdate']; ?></td>
                    <th>Nationality</th>
                    <td><?php echo $applicant['applicantNationality']; ?></td>
                    <th>Height</th>
                    <td><?php echo $applicant['applicanthight']; ?> cm</td>
                </tr>
                <tr style="background-color: #f2f2f2;">
                    <th>Weight</th>
                    <td><?php echo $applicant['applicantWeight']; ?> kg</td>
                    <th>Gender</th>
                    <td><?php echo $applicant['applicantGender']; ?></td>
                    <th>Religion</th>
                    <td><?php echo $applicant['appReligion']; ?></td>
                </tr>
                <tr style="background-color: #f2f2f2;">
                    <th>Race</th>
                    <td><?php echo $applicant['appRase']; ?></td>
                    <th>Marital Status</th>
                    <td><?php echo $applicant['maritalestatus']; ?></td>
                    <th>How Found Us</th>
                    <td><?php echo $applicant['how_foun_us']; ?></td>
                </tr>
                <tr style="background-color: #f2f2f2;">
                    <th>Status</th>
                    <td colspan="5"><?php echo $applicant['applicantStatus']; ?></td>
                </tr>
                <tr style="background-color: #f2f2f2;">
                    <td colspan="6" style="text-align: right;">
                        <!-- Edit Button for Personal Information -->
                        <a href="#personalinfo" data-bs-toggle="modal" class="btn btn-warning btn-sm">Edit Personal
                            Information</a>
                    </td>
                </tr>
            </table>
        </div>

        <!-- Display Applicant's Contact Information -->
        <div class="col-md-12">
            <h4>Contact Information</h4>
            <table class="table table-bordered" id="contactInfoTable">
                <tr style="background-color: #f2f2f2;">
<!--                    <td>--><?php //echo  ?><!--</td>-->
                    <th>Email</th>
                    <td><?php echo $contact['applicant_email']; ?></td>
                    <th>Land Phone</th>
                    <td><?php echo   $contact['applicant_landphone']; ?></td>
                    <th>Mobile Phone</th>
                    <td><?php echo  $contact['applicant_phone']; ?></td>
                    <th>Alternate Phone</th>
                    <td><?php echo  $contact['applicant_phone2']; ?></td>                </tr>
                <tr style="background-color: #f2f2f2;">
                    <th>Address</th>
                    <td colspan="3"><?php echo $contact['applicant_add1'] . ", " . $contact['applicant_add2']; ?></td>
                    <th>Province</th>
                    <td><?php echo $contact['province_name']; ?></td>
                    <th>City</th>
                    <td><?php echo $contact['cityname']; ?></td>
                </tr>
                <tr style="background-color: #f2f2f2;">
                    <th>GS Division</th>
                    <td colspan="7"><?php echo $contact['gs_name']; ?></td>
                </tr>
                <tr style="background-color: #f2f2f2;">
                    <td colspan="8" style="text-align: right;">
                        <!-- Edit Button for Contact Information -->
                        <a href="#contactinfo" data-bs-toggle="modal" class="btn btn-warning btn-sm">Edit
                            Contact Information</a>
                    </td>
                </tr>
            </table>
        </div>
        <hr>
        <!-- Display Applicant's Driving License Information -->
        <div class="col-md-12">
            <h4>
                Driving License Information
<!--                <a href="#drivinglicenseAddinfo" class="btn btn-warning btn-sm">+ Add New 1</a>-->
<!--                <a href="#drivinglicenseinfo" class="btn btn-primary btn-sm" style="float: right;">-->
<!--                    + Add New2-->
<!--                </a>-->
                <a type="button"  class="btn btn-primary btn-sm" style="float: right;" data-bs-toggle="modal" data-bs-target="#drivinglicenseAddinfonew">
                    + Add New
                </a>
            </h4>
            <table class="table table-bordered" id="licenseInfoTable">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th>License Type</th>
                        <th>Document Type</th>
                        <th>Country</th>
                        <th>Expiry Date</th>
                        <th>Attachment</th>
                        <th>Actions</th> <!-- New column for actions -->
                    </tr>
                </thead>
                <tbody>
                <?php while ($license = $result8->fetch_assoc()): ?>
<tr data-client-id="<?php echo isset($license['LicneseClinetId']) ? htmlspecialchars($license['LicneseClinetId']) : '';  ?>"
    data-license-id="<?php echo isset($license['LicenseId']) ? htmlspecialchars($license['LicenseId']) : ''; ?>"
    data-country-id="<?php echo isset($license['License_Country']) ? htmlspecialchars($license['License_Country']) : ''; ?>"
    data-license-copy="<?php echo isset($license['document_Type']) ? strtolower($license['document_Type']) : ''; ?>">

    <td><?php echo isset($license['License_Type']) ? htmlspecialchars($license['License_Type']) : 'N/A'; ?></td>
    <td><?php echo isset($license['document_Type']) ? ucfirst(htmlspecialchars($license['document_Type'])) : 'N/A'; ?></td>
    <td><?php echo isset($license['CountryName']) ? htmlspecialchars($license['CountryName']) : 'Not specified'; ?></td>
    <td>
        <?php 
            $expiryDate = isset($license['License_Expiry']) ? $license['License_Expiry'] : 'N/A';
            echo ($expiryDate !== 'N/A') ? htmlspecialchars(date("Y-m-d", strtotime($expiryDate))) : 'N/A';
        ?>
    </td>
    <td><a href="<?php echo isset($license['attachemnt']) ? htmlspecialchars($license['attachemnt']) : '#'; ?>"><?php echo isset($license['attachFilename']) ? ucfirst(htmlspecialchars($license['attachFilename'])) : 'N/A'; ?></a></td>
    <td>

        <a href="#drivinglicenseinfo" class="btn btn-warning btn-sm">Edit</a>
        <form id="registrationForm" method="post"  action="Functions/delete_license_precheck.php"style="display:inline;">
<!--        <form method="POST" action="Funtions/delete_license_precheck.php" style="display:inline;">-->
            <input type="hidden" name="clientId" value="<?php echo $license['LicenseId']; ?>">
            <input type="hidden" name="licneseClinetId" value="<?php echo $license['LicneseClinetId']; ?>">
            <button type="submit" class="btn btn-danger btn-sm"
                    onclick="return confirm('Are you sure you want to delete this license?');">
                Delete
            </button>
        </form>
<!--        <a href="#" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this license?');">Delete</a>-->
    </td>
</tr>
<?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <hr>
        <!-- Display Applicant's Language Information -->
        <div class="col-md-12">
            <h4>
                Language Information

                <a type="button"  class="btn btn-primary btn-sm" style="float: right;" data-bs-toggle="modal" data-bs-target="#langueinfonew">
                    + Add New
                </a>
            </h4>
            <table class="table table-bordered" id="languageInfoTable">
                <thead>
                    <tr style="background-color: #f2f2f2;">
                        <th>Language</th>
                        <th>Read</th>
                        <th>Write</th>
                        <th>Speak</th>
                        <th>Actions</th> <!-- New column for actions -->
                    </tr>
                </thead>
                <tbody>
                    <?php while ($language = $result9->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $language['LangName']; ?></td>
                        <td><?php echo $language['LangRead']; ?></td>
                        <td><?php echo $language['LangWrite']; ?></td>
                        <td><?php echo $language['LangSpeak']; ?></td>
                        <td>
                            <!-- Edit and Delete buttons -->

                            <a type="button"  class="btn btn-primary btn-sm" style="background-color: yellow;" data-bs-toggle="modal" data-bs-target="#langugeUpdate">
                               Edit
                            </a>
<!--                            <a href="#languge_updateNew" class="btn btn-warning btn-sm">Edit22</a>-->
                            <form id="registrationForm" method="post"  action="Functions/delete_langue_precheck.php"style="display:inline;">
                                <!--        <form method="POST" action="Funtions/delete_license_precheck.php" style="display:inline;">-->
                                <input type="hidden" name="license_id" id="lanId" value="<?php echo $language_new['LangId']; ?>">
                                <input type="hidden" name="client_id" id="langClientId" value="<?php echo $client_id; ?>">                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this language?');">
                                    Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
        <div class="modal fade" id="drivinglicenseAddinfonew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel3">Edit Driving License Details</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="registrationForm" method="post"  action="Functions/driving_license_precheck.php"">
                            <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id ?>">
<!--                            <input type="hidden" name="client_id" id="licenseClientId"> <!-- Add this if you need client ID -->-->

                            <div class="row">
                                <div class="col">
                                    <label for="licenseType" class="form-label">License Type</label>
                                    <input type="text" class="form-control" id="licenseType" name="license_type" required>
                                </div>
                                <div class="col">
                                    <label for="documentType" class="form-label">Original/Copy</label>
                                    <select id="documentType" name="document_type" class="form-select form-control" required>
                                        <option value="none">Select</option>
                                        <option value="original">Original</option>
                                        <option value="copy">Copy</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="countryupate" class="form-label">Country</label>
                                    <select id="countryupate" name="country" class="form-select form-control" required>
                                        <option value="none">Select Country</option>
                                        <option value="1">United States</option>
                                        <option value="2">Canada</option>
                                        <option value="49">Germany</option>
                                        <option value="33">France</option>
                                        <option value="94">Sri Lanka</option>
                                        <option value="91">India</option>
                                        <!-- Options will be populated dynamically by JavaScript -->
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="expiryDate" class="form-label">Expiry Date</label>
                                    <input type="date" class="form-control" id="expiryDate" name="expiry_date">
                                </div>
                                <div class="col">
                                    <label for="attachment" class="form-label">Attachment</label>
                                    <input type="file" class="form-control" id="attachment" name="attachment[]">
                                    <small class="form-text text-muted">Leave blank to keep the existing attachment.</small>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="langueinfonew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel3">Edit Driving License Details</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="registrationForm" method="post"  action="Functions/lanague_precheck.php"">
                        <input type="hidden" name="client_id" id="client_id" value="<?php echo $client_id ?>">

                        <div class="row">
                            <div id="langcounter" class="mb-5">
                                <h4>Lanuage Details</h4>
                                <div class="lang-repeat row">
                                    <div class="col">
                                        <label for="">Lanuages</label>
                                        <select class="form-control" name="lanuagesnames" id="lanuagesnames">
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
                                        <select class="form-control" name="lanlangread" id="lanlangread">
                                            <option value="none">Select Skill Level</option>
                                            <option value="fair">Fair</option>
                                            <option value="good">Good</option>
                                            <option value="excellent">Excellent</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="">Write</label>
                                        <select class="form-control" name="langwrite" id="langwrite">
                                            <option value="none">Select Skill Level</option>
                                            <option value="fair">Fair</option>
                                            <option value="good">Good</option>
                                            <option value="excellent">Excellent</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="">Speak</label>
                                        <select class="form-control" name="langspeak" id="langspeak">
                                            <option value="none">Select Skill Level</option>
                                            <option value="fair">Fair</option>
                                            <option value="good">Good</option>
                                            <option value="excellent">Excellent</option>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="langugeUpdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel31"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content tx-14">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel3">Edit Driving License Details</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="registrationForm" method="post"  action="Functions/lanague_update_precheck.php">

                        <input type="hidden" name="license_id" id="lanId" value="<?php echo $language_new['LangId']; ?>">
                        <input type="hidden" name="client_id" id="langClientId" value="<?php echo $client_id; ?>">
                        <div class="row">
                            <div id="langcounter" class="mb-5">
                                <h4>Lanuage Details</h4>
                                <div class="lang-repeat row">
                                    <div class="col">
                                        <label for="">Lanuages</label>
                                        <select class="form-control" name="lanuagesnames" id="lanuagesnames">
                                            <?php if($language_new['LangName']== "english") {?>
                                                <option value="english" selected>English</option>
                                                <option value="arabic">Arabic</option>
                                                <option value="hindi">Hindi/Urudhu</option>
                                                <option value="sinhala">Sinhala</option>
                                                <option value="tamil">Tamil</option>
                                            <?php }elseif ($language_new['LangName']== "arabic") {?>
                                                <option value="english">English</option>
                                                <option value="arabic" selected>Arabic</option>
                                                <option value="hindi">Hindi/Urudhu</option>
                                                <option value="sinhala">Sinhala</option>
                                                <option value="tamil">Tamil</option>
                                            <?php }elseif ($language_new['LangName']== "hindi") {?>
                                                <option value="english">English</option>
                                                <option value="arabic" >Arabic</option>
                                                <option value="hindi"selected>Hindi/Urudhu</option>
                                                <option value="sinhala">Sinhala</option>
                                                <option value="tamil">Tamil</option>
                                            <?php }elseif ($language_new['LangName']== "sinhala") {?>
                                                <option value="english">English</option>
                                                <option value="arabic" >Arabic</option>
                                                <option value="hindi">Hindi/Urudhu</option>
                                                <option value="sinhala"selected>Sinhala</option>
                                                <option value="tamil">Tamil</option>
                                            <?php }elseif ($language_new['LangName']== "tamil") {?>
                                                <option value="english">English</option>
                                                <option value="arabic" >Arabic</option>
                                                <option value="hindi">Hindi/Urudhu</option>
                                                <option value="sinhala">Sinhala</option>
                                                <option value="tamil"selected>Tamil</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="">Read</label>
                                        <select class="form-control" name="lanlangread" id="lanlangread">
                                            <?php if($language_new['LangRead']== "fair") {?>
                                                <option value="fair" selected>Fair</option>
                                                <option value="good">Good</option>
                                                <option value="excellent">Excellent</option>
                                            <?php }elseif ($language_new['LangRead']== "good") {?>
                                                <option value="fair" >Fair</option>
                                                <option value="good"selected>Good</option>
                                                <option value="excellent">Excellent</option>
                                            <?php }elseif ($language_new['LangRead']== "excellent") {?>
                                                <option value="fair" >Fair</option>
                                                <option value="good">Good</option>
                                                <option value="excellent"selected>Excellent</option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="">Write</label>
                                        <select class="form-control" name="langwrite" id="langwrite">
                                            <?php if($language_new['LangWrite']== "fair") {?>
                                                <option value="fair" selected>Fair</option>
                                                <option value="good">Good</option>
                                                <option value="excellent">Excellent</option>
                                            <?php }elseif ($language_new['LangWrite']== "good") {?>
                                                <option value="fair" >Fair</option>
                                                <option value="good"selected>Good</option>
                                                <option value="excellent">Excellent</option>
                                            <?php }elseif ($language_new['LangWrite']== "excellent") {?>
                                                <option value="fair" >Fair</option>
                                                <option value="good">Good</option>
                                                <option value="excellent"selected>Excellent</option>
                                            <?php }?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="">Speak</label>
                                        <select class="form-control" name="langspeak" id="langspeak">
                                            <?php if($language_new['LangSpeak']== "fair") {?>
                                                <option value="fair" selected>Fair</option>
                                                <option value="good">Good</option>
                                                <option value="excellent">Excellent</option>
                                            <?php }elseif ($language_new['LangSpeak']== "good") {?>
                                                <option value="fair" >Fair</option>
                                                <option value="good"selected>Good</option>
                                                <option value="excellent">Excellent</option>
                                            <?php }elseif ($language_new['LangSpeak']== "excellent") {?>
                                                <option value="fair" >Fair</option>
                                                <option value="good">Good</option>
                                                <option value="excellent"selected>Excellent</option>
                                            <?php }?>
                                        </select>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div
        <?php
    } else {
        echo "<p>No applicant data found.</p>";
    }

    // Close statements and connection
    $stmt6->close();
    if (isset($stmt5)) {
        $stmt5->close();
    }
    $stmt7->close();
    $stmt8->close();
    $stmt9->close();
    
}



//include('popups/language-update.php');
include('popups/personal-information-update.php');
include('popups/contact-informaton-update.php');
include('popups/driving-license-update.php');

?>


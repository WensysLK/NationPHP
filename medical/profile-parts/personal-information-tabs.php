<?php

// Check if 'client_id' is set in the URL
if (isset($_GET['client_id'])) {
    $client_id = $_GET['client_id'];
    // Query to fetch applicant's personal information from the `applications` table
    $sqlApplicant = "SELECT `profile_image`, `applicantTitle`, `applicatFname`, `applicantMname`, `applicantLname`, 
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
        $contact = $result7->fetch_assoc(); // Fetch the contact details

        // Fetch driving license information from the `driving_license` table
        $sqlLicense = "SELECT d.`License_Type`, d. `document_Type`, d. `License_Country`, d. `License_Expiry`, c.`CountryName` FROM `driving_license_deatils` d LEFT JOIN   `list_of_countries` c ON d.`License_Country`= c.`countryId` WHERE d.`LicneseClinetId` = ? AND d.softdeletestatus=1";
        $stmt8 = $conn->prepare($sqlLicense);
        $stmt8->bind_param("i", $client_id);
        $stmt8->execute();
        $result8 = $stmt8->get_result();

        // Fetch language information from the `languages` table
        $sqlLang = "SELECT `LangName`, `LangRead`, `LangWrite`, `LangSpeak` FROM `language_details` WHERE `LangClientId` = ? AND softdeletestatus=1";
        $stmt9 = $conn->prepare($sqlLang);
        $stmt9->bind_param("i", $client_id);
        $stmt9->execute();
        $result9 = $stmt9->get_result();

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
                            <td colspan="5"><?php echo $applicant['applicantTitle'] . " " . $applicant['applicatFname'] . " " . $applicant['applicantMname'] . " " . $applicant['applicantLname']; ?></td>
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
                        <?php if (!empty($agent)): ?>
                        <tr style="background-color: #f2f2f2;">
                            <th>Sub-Agent</th>
                            <td><?php echo $agent['fagentTitle'] . " " . $agent['fagentFname'] . " " . $agent['fagentLname']; ?></td>
                            <th>Sub-Agent Photo</th>
                            <td colspan="3">
                                <?php if (!empty($agent['fagentPhoto'])): ?>
                                    <img src="<?php echo $agent['fagentPhoto']; ?>" alt="Sub-Agent Photo" class="img-thumbnail" width="100">
                                <?php else: ?>
                                    No photo available
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr style="background-color: #f2f2f2;">
                            <th>Status</th>
                            <td colspan="5"><?php echo $applicant['applicantStatus']; ?></td>
                        </tr>
                    </table>
                </div>

                <!-- Display Applicant's Contact Information -->
                 <hr>
                <div class="col-md-12">
                    <h4>Contact Information</h4>
                    <table class="table table-bordered" id="contactInfoTable">
                        <tr style="background-color: #f2f2f2;">
                            <th>Email</th>
                            <td><?php echo isset($contact['applicant_email']) ? $contact['applicant_email'] : 'N/A'; ?></td>
                            <th>Land Phone</th>
                            <td><?php echo isset($contact['applicant_landphone']) ? $contact['applicant_landphone'] : 'N/A'; ?></td>
                            <th>Mobile Phone</th>
                            <td><?php echo isset($contact['applicant_phone']) ? $contact['applicant_phone'] : 'N/A'; ?></td>
                            <th>Alternate Phone</th>
                            <td><?php echo isset($contact['applicant_phone2']) ? $contact['applicant_phone2'] : 'N/A'; ?></td>
                        </tr>
                        <tr style="background-color: #f2f2f2;">
                            <th>Address</th>
                            <td colspan="3"><?php echo (isset($contact['applicant_add1']) ? $contact['applicant_add1'] : '') . ", " . 
     (isset($contact['applicant_add2']) ? $contact['applicant_add2'] : ''); ?></td>
                            <th>Province</th>
                            <td><?php echo isset($contact['province_name']) ? $contact['province_name'] : 'N/A'; ?></td>
                            <th>City</th>
                            <td><?php echo isset($contact['cityname']) ? $contact['cityname'] : 'N/A'; ?></td>
                        </tr>
                        <tr style="background-color: #f2f2f2;">
                            <th>GS Division</th>
                            <td colspan="7"><?php echo isset($contact['gs_name']) ? $contact['gs_name'] : 'N/A'; ?></td>
                        </tr>
                    </table>
                </div>
                <hr>                  

            </div>
        </div>
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
?>

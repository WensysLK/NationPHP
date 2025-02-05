<?php

if (isset($_SESSION['last_applicant_id'])) {
    $applicantId1 = $_SESSION['last_applicant_id'];
    $applicantFname = $_SESSION['applicantFname']; // Ensure this is set somewhere earlier
     $applicantLname = $_SESSION['applicantLname'];
}


// Assuming these session variables have been set elsewhere in the application
/*$applicantId1 = $_SESSION['last_applicant_id'] = 120;
$applicantName = $_SESSION['client_name'] = "Terrance";*/

if (isset($_POST['save'])) {

   
   // Retrieve and sanitize language data
    $languageNames = $_POST['lanuagesnames'];
    $readSkill = $_POST['lanlangread'];
    $writeSkill = $_POST['langwrite'];
    $speakSkill = $_POST['langspeak'];

    // Ensure at least one language is selected and it is not 'none'
    if (empty($languageNames) || $languageNames[0] === 'none') {
        header("Location: ../view_all_applications.php");
        
    }

    // Prepare SQL for inserting language details
    $sqllanguage = "INSERT INTO `language_details`
    (`LangClientId`, `LangName`, `LangRead`, `LangWrite`, `LangSpeak`) 
    VALUES (?,?,?,?,?)";

   

    $stmtlanguage = $conn->prepare($sqllanguage);

    if ($stmtlanguage === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Loop through each language and insert into the database
    foreach ($languageNames as $index => $language) {
        // Skip if the language name is empty or invalid
        if (empty($language) || $language === 'none') {
            continue;
        }

        $read = $readSkill[$index];
        $write = $writeSkill[$index];
        $speak = $speakSkill[$index];

        // Bind parameters and execute the insert query
        $stmtlanguage->bind_param("issss", $applicantId1, $language, $read, $write, $speak);

        if (!$stmtlanguage->execute()) {
            echo "Error inserting language details: " . $stmtlanguage->error;
        }
    }

    // Close the prepared statement
    $stmtlanguage->close();

    // Redirect after all languages have been inserted
   
}
?>
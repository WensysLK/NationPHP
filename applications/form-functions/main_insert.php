<?php
// Start session if you are using session data to pass between steps
// Database connection
include('../../includes/header.php');


// Begin transaction (this will ensure all inserts succeed, or none of them do)
mysqli_begin_transaction($conn);
try {
  // Get the logged-in user ID from the session (assume it's stored in session)
  if (!isset($_SESSION['session_id'])) {
    throw new Exception('Error: No user is logged in.');
}
$session_user_id = $_SESSION['session_id'];
    // Insert Personal Information
    include('form-part-function/personal_info_insert.php');  // This should set $last_person_id

    // Check if $last_person_id is set
    if (!isset($last_person_id) || !$last_person_id) {
        throw new Exception('Error: No personal ID generated.');
    }

    // Debugging: Check if the ID is retrieved correctly
    echo "Main script: Last inserted personal_info ID: " . $last_person_id . "<br>";

    // Store person ID in session for use in other inserts
    $_SESSION['last_person_id'] = $last_person_id;

   // Now proceed to insert contact information
 include('form-part-function/profile_image_insert.php');

  // Now proceed to insert contact information
   include('form-part-function/contact_info_insert.php');
    
     // Insert Parent Information
    include('form-part-function/parents_info_insert.php');

  // Insert Spouse Information
    include('form-part-function/spouce_info_insert.php');

   // Insert Guardian Information
    include('form-part-function/guardian_info_insert.php');

    // Insert Sibling Information
    include('form-part-function/sibling_info_insert.php');

   //Insert Driving License Information
   include('form-part-function/skills_info_insert.php');

    // Insert Driving License Information
    include('form-part-function/driving_license_info_insert.php');

   //Insert Driving License Information
    include('form-part-function/language_info_insert.php');

    //Insert Education Information Information
    include('form-part-function/education_info_insert.php');

    //Insert Professional Information Information
    include('form-part-function/professional_info_insert.php');

    //Insert Workexperiance Information Information
    include('form-part-function/work_training_info_insert.php');

    // If all parts are successfully executed, commit the transaction
    mysqli_commit($conn);

    echo "All data inserted successfully!";
    header('Location: ../view_all_applications.php');
//    header("Location: /view_all_applications.php");
    //exit();
} catch (Exception $e) {
    // If there is an error, rollback the transaction
    mysqli_rollback($conn);
    echo "Error inserting data: " . $e->getMessage();
}

// Close the database connection
mysqli_close($conn);
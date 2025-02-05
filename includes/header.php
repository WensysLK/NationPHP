
<?php session_start(); 

require_once('db_config.php');
// Check if the user is logged in
if (!isset($_SESSION['session_name']) || !isset($_SESSION['session_id'])||!isset($_SESSION['session_role_name'])) {
    // If not, redirect to the login page
    header("Location: ../index.php");
    exit();
}
//Base URL Setup

$username = $_SESSION['session_name'];
$userId = $_SESSION['session_id'];
$userrolename = $_SESSION['session_role_name'];

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="DashForge">
    <meta name="twitter:description" content="Responsive Bootstrap 5 Dashboard Template">
    <meta name="twitter:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/dashforge">
    <meta property="og:title" content="DashForge">
    <meta property="og:description" content="Responsive Bootstrap 5 Dashboard Template">

    <meta property="og:image" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/dashforge/img/dashforge-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 5 Dashboard Template">
    <meta name="author" content="ThemePixels">


    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $baseUrl; ?>/includes/assets/img/favicon.png">

    <title>The Nations Recruitment Agency</title>

    <!-- vendor css -->
    <link href="<?php echo $baseUrl; ?>/includes/lib/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>/includes/lib/typicons.font/src/font/typicons.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>/includes/lib/prismjs/themes/prism-vs.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>/includes/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>/includes/lib/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>/includes/custom/custom_style.css" rel="stylesheet">      

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/includes/assets/css/dashforge.css">
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/includes/assets/css/dashforge.auth.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

  </head>
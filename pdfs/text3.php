<?php
require('fpdf/fpdf.php');

// Database connection (replace with your actual DB credentials)
$host = 'localhost';
$db = 'resume_db';
$user = 'username';
$pass = 'password';

$conn = new mysqli($host, $user, $pass, $db);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch Personal Details
$personalDetailsQuery = "SELECT full_name, dob, address, nationality, phone, email, image_path FROM personal_details WHERE id = 1";
$resultPersonal = $conn->query($personalDetailsQuery);
$personal = $resultPersonal->fetch_assoc();

// Fetch Educational Details
$educationQuery = "SELECT degree, institution, start_year, end_year FROM education WHERE user_id = 1";
$resultEducation = $conn->query($educationQuery);

// Fetch Professional Qualifications
$professionalQuery = "SELECT qualification, year FROM professional_qualifications WHERE user_id = 1";
$resultProfessional = $conn->query($professionalQuery);

// Fetch Work Experience
$workExperienceQuery = "SELECT position, company, start_date, end_date, responsibilities FROM work_experience WHERE user_id = 1";
$resultWorkExperience = $conn->query($workExperienceQuery);

// Create a new PDF instance
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Adding Profile Image (left-aligned)
$pdf->Image($personal['image_path'], 10, 10, 40);  // Adjust the path and size as needed

// Adding Personal Details on the Right of the Image
$pdf->SetXY(60, 10); // Move cursor to the right of the image
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Resume', 0, 1, 'L'); // Title

$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Personal Details', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);

// Display Personal Details
$pdf->Cell(0, 10, 'Name: ' . $personal['full_name'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Date of Birth: ' . $personal['dob'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Address: ' . $personal['address'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Nationality: ' . $personal['nationality'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Phone: ' . $personal['phone'], 0, 1, 'L');
$pdf->Cell(0, 10, 'Email: ' . $personal['email'], 0, 1, 'L');
$pdf->Ln(15); // Add space after this section

// Educational Qualifications Section
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Educational Qualifications', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);

while ($education = $resultEducation->fetch_assoc()) {
    $pdf->Cell(0, 10, $education['degree'] . ' - ' . $education['institution'], 0, 1, 'L');
    $pdf->Cell(0, 10, $education['start_year'] . ' - ' . $education['end_year'], 0, 1, 'L');
    $pdf->Ln(5);
}
$pdf->Ln(10); // Add space after this section

// Professional Qualifications Section
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Professional Qualifications', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);

while ($professional = $resultProfessional->fetch_assoc()) {
    $pdf->Cell(0, 10, $professional['qualification'] . ' - ' . $professional['year'], 0, 1, 'L');
}
$pdf->Ln(15); // Add space after this section

// Work Experience Section
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Work Experience', 0, 1, 'L');
$pdf->SetFont('Arial', '', 12);

while ($work = $resultWorkExperience->fetch_assoc()) {
    $pdf->Cell(0, 10, $work['position'] . ' at ' . $work['company'], 0, 1, 'L');
    $pdf->Cell(0, 10, 'From: ' . $work['start_date'] . ' to ' . $work['end_date'], 0, 1, 'L');
    $pdf->MultiCell(0, 10, 'Responsibilities: ' . $work['responsibilities']);
    $pdf->Ln(10);
}

// Output the PDF
$pdf->Output('I', 'Resume.pdf');

// Close the database connection
$conn->close();
?>

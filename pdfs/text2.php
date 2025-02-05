<?php
require('../fpdf/fpdf.php');

// Create a new instance of FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Personal Details Section
$pdf->Cell(40, 10, 'Resume', 0, 1, 'C');
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 12);

// Add Personal Details
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(40, 10, 'Personal Details', 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Name: John Doe');
$pdf->Ln(7);
$pdf->Cell(40, 10, 'Date of Birth: January 1, 1990');
$pdf->Ln(7);
$pdf->Cell(40, 10, 'Address: 123 Main St, City, Country');
$pdf->Ln(7);
$pdf->Cell(40, 10, 'Nationality: Sri Lankan');
$pdf->Ln(15);

// Contact Details Section
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(40, 10, 'Contact Details', 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Phone: +1 234 567 890');
$pdf->Ln(7);
$pdf->Cell(40, 10, 'Email: johndoe@example.com');
$pdf->Ln(15);

// Educational Qualifications Section
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(40, 10, 'Educational Qualifications', 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'B.Sc. in Computer Science - University of XYZ, 2012-2016');
$pdf->Ln(7);
$pdf->Cell(40, 10, 'High School Diploma - ABC School, 2009-2012');
$pdf->Ln(15);

// Professional Qualifications Section
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(40, 10, 'Professional Qualifications', 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Certified Software Developer, 2018');
$pdf->Ln(7);
$pdf->Cell(40, 10, 'Project Management Certification, 2020');
$pdf->Ln(15);

// Work Experience Section
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(40, 10, 'Work Experience', 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Software Engineer - ABC Tech, 2018-2023');
$pdf->Ln(7);
$pdf->MultiCell(0, 10, 'Responsibilities: Lead the development of web applications, managed a team of 5 developers, improved system performance by 20%.');
$pdf->Ln(7);
$pdf->Cell(40, 10, 'Intern - XYZ Solutions, 2016-2018');
$pdf->Ln(7);
$pdf->MultiCell(0, 10, 'Responsibilities: Assisted in backend development, handled database optimizations, created reports for senior management.');
$pdf->Ln(15);

// Output the PDF
$pdf->Output('I', 'Resume.pdf');

<?php
require('../fpdf/fpdf.php');

// Create a new instance of the FPDF class
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Add the title or header (To section)
$pdf->Cell(190, 10, 'To', 0, 1, 'L');

// Set smaller font for the recipient address
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(190, 10, 'The Recruiting Manager,', 0, 1, 'L');
$pdf->Cell(190, 10, 'Kollywood Furniture', 0, 1, 'L');
$pdf->Cell(190, 10, 'Alpha Mall Road,', 0, 1, 'L');
$pdf->Cell(190, 10, 'Chennai', 0, 1, 'L');

// Add date
$pdf->Cell(190, 10, '10th July 2019', 0, 1, 'L');

// Add spacing before the body text
$pdf->Ln(10);

// Add the salutation
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(190, 10, 'Dear Sir/Mam,', 0, 1, 'L');

// Add the body content
$body_text = "I am writing this letter to show my interest in the post of Digital Marketing Executive in your company. I saw your advertisement in Times Now Newspaper on 9th July 2019 about the job vacancy in your digital marketing department. 
\nI am interested in joining the DM department of your prestigious company. I am graduated in Computer Science and have six months experience of Internships in the same field.
\nCurrently, I am working in XYZ company. I am looking for better job opportunities and believe your platform is suitable and interesting. Your company has a great global reputation, and I would love to be a part of such a prestigious organization.
\nPlease consider my resume and other certificates with this letter. Please contact me if you need further information. I am free for any further information and can be reached at yourname@email.com & [phone number].
\nLooking forward to hearing from you.";

$pdf->MultiCell(0, 10, $body_text);

// Add closing text
$pdf->Ln(10);
$pdf->Cell(190, 10, 'Thanking you,', 0, 1, 'L');
$pdf->Cell(190, 10, 'Yours Sincerely,', 0, 1, 'L');
$pdf->Cell(190, 10, 'Mosin Bhalla', 0, 1, 'L');

// Output the PDF to browser
$pdf->Output();
?>

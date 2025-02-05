<?php
require('fpdf.php');

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // School name and logo
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'UDAY NARAYAN SIKSHAN SANSTHAN', 0, 1, 'C');
        
        // Contact and affiliation info
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, 'Affiliated to: CBSE Board / Affiliation No: 213148228', 0, 1, 'C');
        $this->Cell(0, 10, 'Academic Session: 2019 - 2020', 0, 1, 'C');

        // Line break
        $this->Ln(10);
    }

    // Footer
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    // Student info
    function StudentDetails($name, $father_name, $mother_name, $address, $dob, $class)
    {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 10, "Name of Student: $name", 0, 1);
        $this->Cell(0, 10, "Father's Name: $father_name", 0, 1);
        $this->Cell(0, 10, "Mother's Name: $mother_name", 0, 1);
        $this->Cell(0, 10, "Address: $address", 0, 1);
        $this->Cell(0, 10, "Date of Birth: $dob", 0, 1);
        $this->Cell(0, 10, "Class: $class", 0, 1);
        $this->Ln(10); // Add some space
    }

    // Table for subjects and marks
    function MarksTable($header, $data)
    {
        $this->SetFont('Arial', 'B', 10);
        // Header
        foreach ($header as $col) {
            $this->Cell(38, 7, $col, 1);
        }
        $this->Ln();

        // Data
        $this->SetFont('Arial', '', 10);
        foreach ($data as $row) {
            foreach ($row as $col) {
                $this->Cell(38, 7, $col, 1);
            }
            $this->Ln();
        }
    }

    // Remarks and signature
    function RemarksAndSignature($remarks, $teacher_sign, $principal_sign)
    {
        $this->Ln(10); // Space before remarks
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, "Remarks: $remarks", 0, 1);
        $this->Ln(10);

        $this->Cell(0, 10, "Class Teacher Signature: $teacher_sign", 0, 1, 'L');
        $this->Cell(0, 10, "Principal Signature: $principal_sign", 0, 1, 'R');
    }
}

$pdf = new PDF();
$pdf->AddPage();

// Student Details
$pdf->StudentDetails(
    'Dhruv Kumar', 
    'Ramesh Kumar', 
    'Meena Kumari', 
    'HNO: Sector 30, Uttar Pradesh', 
    '14/04/2005', 
    '6'
);

// Table Headers
$header = array('Subject', 'FA-1', 'FA-2', 'SA-1', 'FA-3', 'FA-4');

// Example Data
$data = array(
    array('Hindi', '75', '80', '85', '78', '80'),
    array('English', '85', '87', '90', '88', '86'),
    array('Maths', '90', '85', '92', '89', '91'),
    array('Science', '80', '82', '88', '83', '85'),
    array('Social Science', '78', '80', '82', '79', '81')
);

// Output the table
$pdf->MarksTable($header, $data);

// Add Remarks and Signature section
$pdf->RemarksAndSignature('Promoted to Class 7', 'Mr. Teacher', 'Dr. Principal');

// Output the PDF
$pdf->Output();
?>

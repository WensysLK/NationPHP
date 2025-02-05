<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use Dompdf\Dompdf;
$client_id = $_GET['client_id'];
$websiteContent = file_get_contents('https://nations.wensys.lk//applications/profile-view/resume.php?client_id='.$client_id);

$dompdf = new Dompdf();
$dompdf->loadHtml($websiteContent);
$dompdf->setPaper('A4', 'portrait');

$dompdf->render();
$dompdf->stream();
?>
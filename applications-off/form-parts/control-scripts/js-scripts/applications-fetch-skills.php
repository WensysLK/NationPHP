<?php
include('../../../../includes/db_config.php');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch main skills
$sqlMainSkills = "SELECT mainSkillId, MainskillName FROM mainskills";
$resultMainSkills = $conn->query($sqlMainSkills);

$mainSkills = [];
if ($resultMainSkills->num_rows > 0) {
    while ($row = $resultMainSkills->fetch_assoc()) {
        $mainSkills[$row['mainSkillId']] = $row['MainskillName'];
    }
}

// Fetch sub-skills by joining with main skills
$sqlSubSkills = "SELECT ss.mainSkillId, ss.subSkillsId, ss.SubSkillsName 
                 FROM subskills ss 
                 JOIN mainskills ms ON ss.mainSkillId = ms.mainSkillId";
$resultSubSkills = $conn->query($sqlSubSkills);

$subSkills = [];
if ($resultSubSkills->num_rows > 0) {
    while ($row = $resultSubSkills->fetch_assoc()) {
        $subSkills[$row['mainSkillId']][] = $row['SubSkillsName'];
    }
}

// Output JSON
header('Content-Type: application/json');
echo json_encode(['mainSkills' => $mainSkills, 'subSkills' => $subSkills]);

$conn->close();
?>


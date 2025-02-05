<?php 

include('../../includes/db_config.php');

$applicantId = $_SESSION['last_applicant_id'] = 120; // Example applicant ID

// Debug: Output applicant ID
echo "Applicant ID: " . $applicantId . "<br>";

// Fetch existing licenses for this applicant, including attachment info
$sql = "SELECT dl.*, a.attachemnt, a.attachmentType 
        FROM driving_license_deatils dl 
        LEFT JOIN attachemnts_data a ON dl.LicenseId = a.attachmentsourceId	 
        WHERE dl.LicneseClinetId = ? AND a.attachmentType = 'Driving_License'";

// Debug: Output SQL query to check if correct
echo "SQL Query: " . $sql . "<br>";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
}

$stmt->bind_param("i", $applicantId);
$stmt->execute();

$result = $stmt->get_result();
$licenses = $result->fetch_all(MYSQLI_ASSOC);

// Debug: Output number of records fetched
echo "Number of records fetched: " . count($licenses) . "<br>";

// Debug: Check if data is being fetched
if (count($licenses) == 0) {
    echo "No licenses found for this applicant.";
} else {
    foreach ($licenses as $license) {
        echo "License ID: " . $license['LicenseId'] . "<br>";
        echo "Attachment: " . $license['attachemnt'] . "<br>";
        echo "Attachment Type: " . $license['attachmentType'] . "<br>";
    }
}

// Fetch country list
$sqlCountries = "SELECT countryID, countryName FROM list_of_countries ORDER BY countryName ASC";
$resultCountries = $conn->query($sqlCountries);

$countries = [];
if ($resultCountries->num_rows > 0) {
    while ($row = $resultCountries->fetch_assoc()) {
        $countries[] = $row;
    }
}

  ?>
<div class="container">
    <h4>Driving License Details</h4>

    <!-- Existing licenses table for editing/deleting -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>License Type</th>
                <th>Country</th>
                <th>Copy</th>
                <th>Expiry Date</th>
                <th>File</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="licenseTableBody">
            <?php foreach ($licenses as $license): ?>
            <tr id="row-<?php echo $license['id']; ?>" >
                <td>
                    <input type="text" class="form-control" name="edit_licensetype[<?php echo $license['id']; ?>]"
                        value="<?php echo htmlspecialchars($license['License_Type']); ?>">
                </td>
                <td>
                    <select class="form-control" name="edit_licensecountry[<?php echo $license['id']; ?>]">
                        <option value="">Select Country</option>
                        <?php foreach ($countries as $country): ?>
                        <option value="<?php echo htmlspecialchars($country['countryName']); ?>"
                            <?php if($country['countryName'] == $license['License_Country']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($country['countryName']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <select class="form-control" name="edit_licensecopy[<?php echo $license['id']; ?>]">
                        <option value="original" <?php if($license['document_Type'] == 'original') echo 'selected'; ?>>
                            Original</option>
                        <option value="copy" <?php if($license['document_Type'] == 'copy') echo 'selected'; ?>>Copy
                        </option>
                    </select>
                </td>
                <td>
                    <input type="date" class="form-control"
                        name="edit_licenseexpiry[<?php echo $license['id']; ?>]"
                        value="<?php echo $license['License_Expiry']; ?>">
                </td>
                <td>
                    <?php if (!empty($license['license_file'])): ?>
                    <a href="<?php echo htmlspecialchars($license['license_file']); ?>" target="_blank">View</a>
                    <?php endif; ?>
                    <input type="file" class="form-control" name="edit_licensefile[<?php echo $license['id']; ?>]">
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm"
                        onclick="deleteLicense(<?php echo $license['id']; ?>)">Delete</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Add new license fields -->
    <h5>Add New License</h5>
    <div class="row mb-3">
        <div class="col">
            <label>License Type</label>
            <input type="text" class="form-control" id="newLicenseType">
        </div>
        <div class="col">
            <label>Country</label>
            <select class="form-control" id="newLicenseCountry">
                <option value="">Select Country</option>
                <?php foreach ($countries as $country): ?>
                <option value="<?php echo htmlspecialchars($country['countryName']); ?>">
                    <?php echo htmlspecialchars($country['countryName']); ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col">
            <label>Original/Copy</label>
            <select id="newLicenseCopy" class="form-select form-control">
                <option value="none">Select</option>
                <option value="original">Original</option>
                <option value="copy">Copy</option>
            </select>
        </div>
        <div class="col">
            <label>Expiry Date</label>
            <input type="date" class="form-control" id="newLicenseExpiry">
        </div>
        <div class="col">
            <label>Attach Copy</label>
            <input type="file" class="form-control" id="newLicenseFile">
        </div>
        <div class="col">
            <label> </label>
            <button type="button" class="btn btn-primary mt-4" onclick="addNewLicense()">Add</button>
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-success mt-3" name="save_licenses">Save All Changes</button>
</div>

<script>
    let newLicenses = [];

    // Function to Add New License to Table
    function addNewLicense() {
        const type = document.getElementById('newLicenseType').value;
        const country = document.getElementById('newLicenseCountry').value;
        const copy = document.getElementById('newLicenseCopy').value;
        const expiry = document.getElementById('newLicenseExpiry').value;
        const fileInput = document.getElementById('newLicenseFile');
        const file = fileInput.files[0];

        if (!type || !country || !copy || !expiry) {
            alert('Please fill in all fields.');
            return;
        }

        const licenseId = newLicenses.length + 1; // Incremental ID for client-side handling

        // Create a new row in the table for the new license
        const row = `
        <tr id="new-row-${licenseId}">
            <td><input type="text" class="form-control" name="new_licensetype[]" value="${type}"></td>
            <td>
                <select class="form-control" name="new_licensecountry[]">
                    <option value="${country}" selected>${country}</option>
                </select>
            </td>
            <td>
                <select class="form-control" name="new_licensecopy[]">
                    <option value="${copy}" selected>${copy.charAt(0).toUpperCase() + copy.slice(1)}</option>
                </select>
            </td>
            <td><input type="date" class="form-control" name="new_licenseexpiry[]" value="${expiry}"></td>
            <td><input type="file" class="form-control" name="new_licensefile[]"></td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="deleteNewLicense(${licenseId})">Delete</button></td>
        </tr>
        `;

        // Append the row to the table
        document.getElementById('licenseTableBody').insertAdjacentHTML('beforeend', row);

        // Store the new license details in the array (for reference, if needed)
        newLicenses.push({
            type: type,
            country: country,
            copy: copy,
            expiry: expiry,
            file: file
        });

        // Clear the input fields
        document.getElementById('newLicenseType').value = '';
        document.getElementById('newLicenseCountry').value = '';
        document.getElementById('newLicenseCopy').value = '';
        document.getElementById('newLicenseExpiry').value = '';
        document.getElementById('newLicenseFile').value = '';
    }

    // Function to delete newly added license row
    function deleteNewLicense(id) {
        document.getElementById(`new-row-${id}`).remove();
    }
</script>


<?php include('../../includes/footer.php'); ?>
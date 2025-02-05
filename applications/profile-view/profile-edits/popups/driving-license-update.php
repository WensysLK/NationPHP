<!-- Edit License Modal -->
<div class="modal fade" id="drivinglicenseinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel3">Edit Driving License Details</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="registrationForm" method="post" action="Functions/driving_license_update_precheck.php">

                    <input type="hidden" name="license_id" id="licenseId"value="<?php echo $licenseNew['LicenseId']; ?>">
                    <input type="hidden" name="client_id" id="licenseClientId"value="<?php echo $licenseNew['LicneseClinetId']; ?>"> <!-- Add this if you need client ID -->
                   
                    <div class="row">
                        <div class="col">
                            <label for="licenseType" class="form-label">License Type</label>
                            <input type="text" class="form-control" id="licenseType" name="license_type" value="<?php echo $licenseNew['License_Type']; ?>" required>
                        </div>
                        <div class="col">
                            <label for="documentType" class="form-label">Original/Copy</label>
                            <select id="documentType" name="document_type" class="form-select form-control" value="<?php echo $licenseNew['document_Type']; ?>" required>
                               <?php if($licenseNew['document_Type']== "original") {?>
                                <option value="original" selected>Original</option>
                                <option value="copy">Copy</option>
                                <?php }elseif ($licenseNew['document_Type']== "copy"){ ?>
                                <option value="original" >Original</option>
                                <option value="copy" selected>Copy</option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="countryupate" class="form-label">Country</label>
                            <select id="countryupate" name="country" class="form-select form-control" required>
                                <?php if($licenseNew['License_Country']== "1") {?>
                                    <option value="1" selected>United States</option>
                                    <option value="2">Canada</option>
                                    <option value="3">Germany</option>
                                    <option value="4">France</option>
                                    <option value="5">Sri Lanka</option>
                                    <option value="6">India</option>
                                <?php }elseif ($licenseNew['License_Country']== "2"){ ?>
                                    <option value="1" >United States</option>
                                    <option value="2"selected>Canada</option>
                                    <option value="3">Germany</option>
                                    <option value="4">France</option>
                                    <option value="5">Sri Lanka</option>
                                    <option value="6">India</option>
                                <?php }elseif ($licenseNew['License_Country']== "3"){  ?>
                                <option value="1" >United States</option>
                                <option value="2">Canada</option>
                                <option value="3"selected>Germany</option>
                                <option value="4">France</option>
                                <option value="5">Sri Lanka</option>
                                <option value="6">India</option>
                                <?php }elseif ($licenseNew['License_Country']== "4"){  ?>
                                <option value="1" >United States</option>
                                <option value="2">Canada</option>
                                <option value="3">Germany</option>
                                <option value="4"selected>France</option>
                                <option value="5">Sri Lanka</option>
                                <option value="6">India</option>
                                <?php }elseif ($licenseNew['License_Country']== "5"){  ?>
                                <option value="1" >United States</option>
                                <option value="2">Canada</option>
                                <option value="3">Germany</option>
                                <option value="4">France</option>
                                <option value="5"selected>Sri Lanka</option>
                                <option value="6">India</option>
                                <?php }elseif ($licenseNew['License_Country']== "6"){  ?>
                                <option value="1" >United States</option>
                                <option value="2">Canada</option>
                                <option value="3">Germany</option>
                                <option value="4">France</option>
                                <option value="5">Sri Lanka</option>
                                <option value="6"selected>India</option>
                                  <?php }?>
                                <!-- Options will be populated dynamically by JavaScript -->
                            </select>
                        </div>
                        <div class="col">
                            <label for="expiryDate" class="form-label">Expiry Date</label>
                            <input type="date" class="form-control" id="expiryDate" name="expiry_date"value="<?php echo $licenseNew['License_Expiry']; ?>">
                        </div>
                        <div class="col">
                            <label for="attachment" class="form-label">Attachment</label>
                            <input type="file" class="form-control" id="attachment" name="attachment">
                            <small class="form-text text-muted">Leave blank to keep the existing attachment.</small>
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>

document.addEventListener("DOMContentLoaded", function () {
    const countrySelect = document.getElementById("countryupate"); // Ensure this ID matches the dropdown in the modal
    const modal = document.getElementById("drivinglicenseinfo");

    // Function to fetch countries from the PHP API and populate the dropdown
    function fetchAndPopulateCountries(selectElement, selectedCountryId = null) {
        fetch('http://localhost/nationscrm/applications/api-requests/fetch_countries.php') // Adjust the path to your PHP file
            .then(response => response.json())
            .then(data => {
                // Clear existing options
                selectElement.innerHTML = '<option value="">Select Country</option>';

                // Populate the dropdown with countries from the API
                data.countries.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.id;
                    option.textContent = country.name;

                    // Set the option as selected if it matches the selectedCountryId
                    if (selectedCountryId && country.id == selectedCountryId) {
                        option.selected = true;
                    }

                    selectElement.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching countries:', error));
    }

    document.querySelectorAll(".btn-warning").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            // Locate the row containing data to edit
            const row = this.closest("tr");
            const licenseClientId = row.getAttribute("data-client-id");
            const licenseId = row.getAttribute("data-license-id");
            const licenseType = row.children[0].textContent.trim();
            const documentType = row.children[1].textContent.trim().toLowerCase();
            const selectedCountryId = row.getAttribute("data-country-id");
            const expiryDate = row.children[3].textContent.trim();

            // Debugging output
            console.log("License Client ID:", licenseClientId);
            console.log("License ID:", licenseId);
            console.log("License Type:", licenseType);
            console.log("Document Type:", documentType);
            console.log("Country ID:", selectedCountryId);
            console.log("Expiry Date:", expiryDate);

            // Populate modal fields with values from the selected row
            document.getElementById("licenseClientId").value = licenseClientId;
            document.getElementById("licenseId").value = licenseId;
            document.getElementById("licenseType").value = licenseType;
            document.getElementById("documentType").value = documentType;
            
            // Set the expiry date if it matches the YYYY-MM-DD format
            if (/^\d{4}-\d{2}-\d{2}$/.test(expiryDate)) {
                document.getElementById("expiryDate").value = expiryDate;
            } else {
                console.error("Expiry date format is incorrect:", expiryDate);
            }

            // Populate the countries and set the current country
            fetchAndPopulateCountries(document.getElementById("countryupate"), selectedCountryId);

            // Show the modal
            new bootstrap.Modal(document.getElementById("drivinglicenseinfo")).show();
        });
    });

    modal.addEventListener("hidden.bs.modal", function() {
        document.body.classList.remove("modal-open");
        let backdrop = document.querySelector(".modal-backdrop");
        if (backdrop) {
            backdrop.remove();
        }
    });
});

</script>
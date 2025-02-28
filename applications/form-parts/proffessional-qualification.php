<div class="row mt-2">
    <h4>Proffessional Qualification</h4>
    <div class="">
        <div id="coursesContainer">
            <!-- Initial set of course fields -->
            <div class="course-entry row">
                <div class="col">
                    <label >Name Of Institute</label>
                    <input class="form-control" type="text" name="institueName[]">
                </div>
                <div class="col">
                    <label >Course Name</label>
                    <input class="form-control" type="text" name="CourseName[]">
                </div>
                <div class="col">
                    <label for="status"  >Status</label>
                    <select name="CourseStatus[]" class="form-select form-control" >
                        <option value="Pending">Pending</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
                <div class="col">
                    <label >Country</label>
                    <select name="licensecountry[]" class="form-select form-control countrySelectP">
                        <option value="none" selected >Select Country</option>
                    </select>
                </div>
                <div class="col">
                    <label for="duration" >Duration</label>
                    <input type="text" class="form-control" name="duration[]" id="">
                </div>
                <div class="col">
                    <label for="status"  >Attach Certificate</label>
                    <input type="file" class="form-control" name="courcecertificate[]" id="">
                </div>

                <div class="col">
                    <label > </label>
                    <button type="button" onclick="addCourse()" style="font-size:14px;"
                        class="btn btn-primary mt-4">+</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Fetch countries from your PHP API and populate the dropdown
    function fetchCountries(selectElement) {
        fetch('./api-requests/fetch_countries.php') // Adjust the path to your fetch_countries.php file
            .then(response => response.json())
            .then(data => {
                // Clear previous options
                selectElement.innerHTML = '<option value="">Select Country</option>';

                // Populate the dropdown with country names and ids
                data.countries.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.id;  // Use country ID as the value
                    option.text = country.name; // Display country name
                    selectElement.add(option);
                });
            })
            .catch(error => console.error('Error fetching countries:', error));
    }

    // Function to add a new license group
    function addLicenseGroup() {
        const container = document.getElementById('licenseContainer');

        // Create a new license group element
        const licenseEntry = document.createElement('div');
        licenseEntry.className = 'row licenseGroup mt-2';

        // Add the required fields to the new license group
        licenseEntry.innerHTML = `
        <div class="col">
            <label>License Type</label>
            <input type="text" class="form-control" name="licensetype[]" id="">
        </div>
        <div class="col">
            <label>Country</label>
            <select name="licensecountry[]" class="form-select form-control countrySelect">
                <option value="">Select Country</option>
            </select>
        </div>
        <div class="col">
            <label>Original/Copy</label>
            <select name="licensecopy[]" class="form-select form-control">
                <option value="none">Select</option>
                <option value="original">Original</option>
                <option value="copy">Copy</option>
            </select>
        </div>
        <div class="col">
            <label>Expiry Date</label>
            <input type="date" class="form-control" name="licenseexpirey[]" id="">
        </div>
        <div class="col">
            <label>Attach Copy</label>
            <input type="file" class="form-control" name="licensefileattach[]" id="">
        </div>
        <div class="col">
            <label></label>
            <button type="button" onclick="removeLicenseGroup(this)" style="font-size:14px;" class="btn btn-danger mt-4">-</button>
        </div>
    `;

        // Append the new entry to the container
        container.appendChild(licenseEntry);

        // Fetch and populate countries for the newly added license group
        const countrySelect = licenseEntry.querySelector('.countrySelect');
        fetchCountries(countrySelect);  // Populate the new country's dropdown
    }

    // Function to remove a license group
    function removeLicenseGroup(button) {
        const licenseEntry = button.closest('.licenseGroup');
        licenseEntry.remove();
    }

    // Fetch countries on page load for the first license group
    document.addEventListener('DOMContentLoaded', function () {
        const firstCountrySelect = document.querySelector('.countrySelect');
        fetchCountries(firstCountrySelect);
        const firstCountrySelectP = document.querySelector('.countrySelectP');
        fetchCountries(firstCountrySelectP);// Populate the first license group

    });
</script>
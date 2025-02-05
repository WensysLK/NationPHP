
<div class="row">
    <div class="col p-2">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="cemail">
    </div>
    <div class="col p-2">
        <label class="form-label">Land Phone</label>
        <div class="input-group">
            <select name="land_area_code" class="form-select" id="landAreaCode">
                <option value="">Select Area Code</option>
            </select>
            <input type="text" class="form-control" placeholder="Land Phone No" name="clphone">
        </div>
    </div>
    <div class="col p-2">
        <label class="form-label">Mobile No (1)</label>
        <div class="input-group">
            <select name="mobile_area_code1" class="form-select" id="mobileAreaCode1">
                <option value="">Select Area Code</option>
            </select>
            <input type="text" class="form-control" id="mobileNumber1" placeholder="Phone No" name="cphone2">
        </div>
        <div id="messagingIcons1">
            <!-- Icons for mobile number 1 will be dynamically inserted here -->
        </div>
    </div>
    <div class="col p-2">
        <label class="form-label">Mobile No (2)</label>
        <div class="input-group">
            <select name="mobile_area_code2" class="form-select" id="mobileAreaCode2">
                <option value="">Select Area Code</option>
            </select>
            <input type="text" class="form-control" id="mobileNumber2" placeholder="Phone No" name="cphone">
        </div>
        <div id="messagingIcons2">
            <!-- Icons for mobile number 2 will be dynamically inserted here -->
        </div>
    </div>
</div>


<div class="row mb-5">
    <div class="col p-2">
        <label class="form-label">Address Line 01</label>
        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="caddress1">
    </div>
    <div class="col p-2">
        <label class="form-label">Address Line 02</label>
        <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" name="caddress2">
    </div>
    <div class="col p-2">
        <label class="form-label">Province</label>
        <select class="form-control" id="province" name="cprovince">
            <option value="">Select Province</option>
        </select>
    </div>
    <div class="col p-2">
        <label class="form-label">City</label>
        <select class="form-control" id="city" name="ccity">
            <option value="">Select City</option>
        </select>
    </div>
    <div class="col p-2">
        <label class="form-label">Gramasevaka Division</label>
        <select class="form-control" id="gsdevision" name="gsdevision">
            <option value="">Select GS Division</option>
        </select>
    </div>
</div>

<script>
// Ensure the script runs after the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Fetch provinces from the server
    fetch('./api-requests/fetch_provinces.php')
        .then(response => response.json())
        .then(data => {
            const provinceSelect = document.getElementById('province');
            data.provinces.forEach(province => {
                const option = document.createElement('option');
                option.value = province.id;  // Province ID from the database
                option.text = province.name;
                provinceSelect.add(option);
            });
        })
        .catch(error => console.error('Error fetching provinces:', error));
});

// Fetch cities when a province is selected
document.getElementById('province').addEventListener('change', function() {
    const provinceId = this.value;
    const citySelect = document.getElementById('city');
    citySelect.innerHTML = '<option value="">Select City</option>';  // Clear previous options

    if (provinceId) {
        fetch(`./api-requests/fetch_cities.php?province_id=${provinceId}`)
            .then(response => response.json())
            .then(data => {
                data.cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.id;  // City ID from the database
                    option.text = city.name;
                    citySelect.add(option);
                });
            })
            .catch(error => console.error('Error fetching cities:', error));
    }
});

// Fetch GS divisions when a city is selected
document.getElementById('city').addEventListener('change', function() {
    const cityId = this.value;
    const gsDivisionSelect = document.getElementById('gsdevision');
    gsDivisionSelect.innerHTML = '<option value="">Select GS Division</option>';  // Clear previous options

    if (cityId) {
        fetch(`./api-requests/fetch_gs_divisions.php?city_id=${cityId}`)
            .then(response => response.json())
            .then(data => {
                data.gs_divisions.forEach(gsDivision => {
                    const option = document.createElement('option');
                    option.value = gsDivision.id;  // GS Division ID from the database
                    option.text = gsDivision.name;
                    gsDivisionSelect.add(option);
                });
            })
            .catch(error => console.error('Error fetching GS divisions:', error));
    }
});
</script>
<script>
// Fetch area codes from the API and populate the dropdowns
function fetchAreaCodes() {
    fetch('./api-requests/fetch_area_codes.php')  // Adjust the path to your PHP file
        .then(response => response.json())
        .then(data => {
            const areaCodeDropdowns = [
                document.getElementById('landAreaCode'),
                document.getElementById('mobileAreaCode1'),
                document.getElementById('mobileAreaCode2')
            ];

            // Populate each area code dropdown
            areaCodeDropdowns.forEach(dropdown => {
                // Clear existing options
                dropdown.innerHTML = '<option value="">Select Area Code</option>';
                
                // Add area code options
                data.area_codes.forEach(areaCode => {
                    const option = document.createElement('option');
                    option.value = areaCode.area_code;
                    option.text = `+${areaCode.area_code} (${areaCode.country})`;
                    dropdown.add(option);
                });
            });
        })
        .catch(error => console.error('Error fetching area codes:', error));
}

// Call fetchAreaCodes when the DOM is loaded
document.addEventListener('DOMContentLoaded', fetchAreaCodes);
</script>

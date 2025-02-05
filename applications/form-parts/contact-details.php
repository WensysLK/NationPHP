
<div class="row">
    <div class="col p-2">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="cemail">
    </div>
    <div class="col p-2">
        <label class="form-label">Land Phone</label>
        <input type="text" class="form-control" placeholder="+94770000000" name="clphone">
    </div>
    <div class="col p-2">
        <label class="form-label">Mobile No (1)</label>
        <input type="text" class="form-control" id="mobileNumber1" placeholder="+94770000000" name="cphone2">
        <div id="messagingIcons1">
            <!-- Icons for mobile number 1 will be dynamically inserted here -->
        </div>
    </div>
    <div class="col p-2">
        <label class="form-label">Mobile No (2)</label>
        <input type="text" class="form-control" id="mobileNumber2" placeholder="+94770000000" name="cphone">
        <div id="messagingIcons2">
            <!-- Icons for mobile number 2 will be dynamically inserted here -->
        </div>
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


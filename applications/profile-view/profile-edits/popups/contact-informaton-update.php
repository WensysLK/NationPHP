<!-- Customer Precheck -->
<div class="modal fade" id="contactinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel3">Modal Title</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registrationForm" method="post" action="Functions/user_contact-details_edit_precheck.php">

                    <input type="hidden" value="<?php echo $applicant['applicationID']; ?>" name="clientID">


                    <div class="row">
                        <div class="col p-2">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email" value="<?php echo $contact['applicant_email']; ?>" name="cemail">
                        </div>
                        <div class="col p-2">
                            <label class="form-label">Land Phone</label>
                            <div class="input-group">
<!--                                <select name="land_area_code" class="form-select" value="--><?php //echo $contact['applicant_landphone']; ?><!--" id="landAreaCode">-->
<!--                                    <option value="">Select Area Code</option>-->
<!--                                </select>-->
                                <input type="text" class="form-control" placeholder="Land Phone No" name="clphone" value="<?php echo $contact['applicant_landphone']; ?>">
                            </div>
                        </div>
                        <div class="col p-2">
                            <label class="form-label">Mobile No (1)</label>
                            <div class="input-group">
<!--                                <select name="mobile_area_code1" class="form-select" id="mobileAreaCode1">-->
<!--                                    <option value="">Select Area Code</option>-->
<!--                                </select>-->
                                <input type="text" class="form-control" id="mobileNumber1" value="<?php echo $contact['applicant_phone']; ?>" placeholder="Phone No"
                                    name="cphone2">
                            </div>
                            <div id="messagingIcons1">
                                <!-- Icons for mobile number 1 will be dynamically inserted here -->
                            </div>
                        </div>
                        <div class="col p-2">
                            <label class="form-label">Mobile No (2)</label>
                            <div class="input-group">
<!--                                <select name="mobile_area_code2" class="form-select" id="mobileAreaCode2">-->
<!--                                    <option value="">Select Area Code</option>-->
<!--                                </select>-->
                                <input type="text" class="form-control" id="mobileNumber2" value="<?php echo $contact['applicant_phone']; ?>" placeholder="Phone No"
                                    name="cphone3">
                            </div>
                            <div id="messagingIcons2">
                                <!-- Icons for mobile number 2 will be dynamically inserted here -->
                            </div>
                        </div>
                    </div>


                    <div class="row mb-5">
                        <div class="col p-2">
                            <label class="form-label">Address Line 01</label>
                            <input type="text" class="form-control" id="inputAddress" value="<?php echo $contact['applicant_add1']; ?>" placeholder="1234 Main St"
                                name="caddress1">
                        </div>
                        <div class="col p-2">
                            <label class="form-label">Address Line 02</label>
                            <input type="text" class="form-control" id="inputAddress2"
                                placeholder="Apartment, studio, or floor" value="<?php echo $contact['applicant_add2']; ?>" name="caddress2">
                        </div>
                        <div class="col p-2">
                            <label class="form-label">Province</label>
<!--                            <input type="text" class="form-control" id="provinceup"-->
<!--                                   placeholder="Province" value="--><?php //echo $contact['province_name']; ?><!--" name="cprovince">-->

                                                        <select class="form-control" id="provinceup" value="<?php echo $contact['province_name']; ?>" name="cprovince">
                                <option value="">Select Province</option>
                            </select>
                            
                        </div>
                        <div class="col p-2">
                            <label class="form-label">City</label>
<!--                            <input type="text" class="form-control" id="cityup"-->
<!--                                   placeholder="City" value="--><?php //echo $contact['cityname']; ?><!--" name="ccity">-->

                            <select class="form-control" id="cityup" name="ccity">
        <!-- Pre-populate the currently selected city from the database -->
        <option value="<?php echo $contact['city_id']; ?>" selected><?php echo $contact['cityname']; ?></option>
      
    </select>
                        </div>
                        <div class="col p-2">
                            <label class="form-label">Gramasevaka Division</label>
<!--                            <input type="text" class="form-control" id="gsdevisionup"-->
<!--                                   placeholder="City" value="--><?php //echo $contact['gs_name']; ?><!--" name="gsdevision">-->
                            <select class="form-control" id="gsdevisionup" value="<?php echo $contact['gs_name']; ?>" name="gsdevision">
                                <option value="">Select GS Division</option>
                            </select>
                        </div>
                    </div>

                    <div id="clientName"></div>

                    <hr>
                    <button type="submit" class="btn btn-primary" name="saveContineue">Update</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary tx-13" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
    // Ensure the script runs after the DOM is fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Fetch provinces from the server
        fetch('api-requests-edit/fetch_provinces.php')
            .then(response => response.json())
            .then(data => {
                const provinceSelect = document.getElementById('provinceup');
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
            fetch(`api-requests-edit/fetch_cities.php?province_id=${provinceId}`)
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
            fetch(`api-requests-edit/fetch_gs_divisions.php?city_id=${cityId}`)
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
(function() {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const provinceSelect = document.getElementById('provinceup');
    const selectedProvince = "<?php echo $contact['province_name']; ?>"; // Province from the database

    // Fetch provinces using the API request
    fetch('api-requests-edit/fetch_provinces.php')  // Replace with your actual API URL
        .then(response => response.json())
        .then(data => {
            // Populate the province dropdown
            data.provinces.forEach(province => {
                const option = document.createElement('option');
                option.value = province.id;  // Province ID
                option.text = province.name;  // Province name

                // Check if this is the selected province from the database
                if (province.name === selectedProvince) {
                    option.selected = true;
                }

                provinceSelect.add(option);
            });
        })
        .catch(error => console.error('Error fetching provinces:', error));
});

// Fetch cities when a province is selected
document.getElementById('provinceup').addEventListener('change', function() {
    const provinceId = this.value;
    const citySelect = document.getElementById('cityup');
    citySelect.innerHTML = '<option value="">Select City</option>';  // Clear previous options

    if (provinceId) {
        fetch(`api-requests-edit/fetch_cities.php?province_id=${provinceId}`)
            .then(response => response.json())
            .then(data => {
                const selectedCity = "<?php echo $contact['cityname']; ?>";  // City name from the database

                data.cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.id;  // City ID from the database
                    option.text = city.name;

                    // Check if this city is the one stored in the database and select it
                    if (city.name === selectedCity) {
                        option.selected = true;
                    }

                    citySelect.add(option);
                });
            })
            .catch(error => console.error('Error fetching cities:', error));
    }
});

// Fetch GS divisions when a city is selected
document.getElementById('cityup').addEventListener('change', function() {
    const cityId = this.value;
    const gsDivisionSelect = document.getElementById('gsdevisionup');
    gsDivisionSelect.innerHTML = '<option value="">Select GS Division</option>';  // Clear previous options

    if (cityId) {
        fetch(`api-requests-edit/fetch_gs_divisions.php?city_id=${cityId}`)
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
    fetch('/nationscrm/applications/api-requests/fetch_area_codes.php')  // Adjust the path to your PHP file
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
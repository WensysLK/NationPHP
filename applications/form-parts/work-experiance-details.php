<div class="mb-5">
    <?php 
    //include('../includes/db_config.php');
    // Fetch countries from the database
    $sql = "SELECT countryID, countryName FROM list_of_countries ORDER BY countryName ASC";
    $result = $conn->query($sql);

    $countries = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $countries[] = $row;
        }
    }
    ?>
    <h4>Work Experience</h4>
    <!-- Dropdown to select if there is work experience -->
    <div class="row">
        <div class="col p-2">
            <label class="form-label">Do you have work experience?</label>
            <select name="hasWorkExperience" class="form-control" onchange="toggleExperienceFields(this)">
                <option value="none" selected >Select Option</option>
                <option value="yes">Yes</option>
                <option value="no" >No</option>
            </select>
        </div>
    </div>

    <!-- Work Experience Section -->
    <div class="row mt-2 experience-fields" style="display: none;">
        <hr>
        <h4>Work Experience Details</h4>
        <div id="experienceContainer">
            <!-- Initial set of job experience fields -->
            <div class="experience-entry row">
                <div class="col p-2">
                    <label class="form-label">Position</label>
                    <input class="form-control" type="text" name="workposition[]">
                </div>
                <div class="col p-2">
                    <label class="form-label">Company Name</label>
                    <input class="form-control" type="text" name="CompanyName[]">
                </div>

                <div class="col p-2">
                    <label class="form-label">Country</label>
                    <select class="form-control" name="JobCountry[]">
                        <option value="">Select Country</option>
                        <?php foreach ($countries as $country): ?>
                        <option value="<?php echo htmlspecialchars($country['countryName']); ?>">
                            <?php echo htmlspecialchars($country['countryName']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col p-2">
                    <label class="form-label">Job Started</label>
                    <input class="form-control" id="yearStart" type="date" name="yearstart[]">
                </div>
                <div class="col p-2">
                    <label class="form-label">Job Ended</label>
                    <input class="form-control" type="date" id="yearEnd" name="yearEnd[]" onchange="getYears()">
                </div>
                <div class="col p-2">
                    <label class="form-label">Years</label>
                    <input class="form-control" type="text" id="year" name="years[]">
                </div>
                <div class="col p-2">
                    <label class="form-label">Attach Certificate</label>
                    <input type="file" class="form-control" name="jobcertificate[]">
                </div>
                <div class="col p-2">
                    <label> </label>
                    <button type="button" onclick="addExperience()" style="font-size:14px;"
                        class="btn btn-primary mt-4">+</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Training Section: Will only appear if work experience is 'No' -->
    <div class="row mt-2 training-fields" style="display: none;">
        <hr>
        <h4>Training Details</h4>
        <div class="col p-2">
            <label class="form-label">Have you completed training?</label>
            <select name="hasTraining" class="form-control" onchange="toggleTrainingFields(this)">
                <option value="none" >Select Option</option>
                <option value="yes">Yes</option>
                <option value="no" selected >No</option>
            </select>
        </div>

        <!-- Training Details Section -->
        <div class="row mt-2 training-details" style="display: none;">
            <div class="col p-2">
                <label class="form-label">Training Date</label>
                <input class="form-control" type="date" name="trainingDate">
            </div>
            <div class="col p-2">
                <label class="form-label">Duration</label>
                <input class="form-control" type="text" name="trainingDuration">
            </div>
            <div class="col p-2">
                <label class="form-label">Training Center</label>
                <select name="trainingCentre" id="trainingCenterDropdown" class="form-control">
                    <option value="">Select Training Center</option>
                </select>
            </div>
            <div class="col p-2">
                <label class="form-label">Training Program</label>
                <select name="trainingProgram" id="trainingProgramDropdown" class="form-control">
                    <option value="">Select Training Program</option>
                </select>
            </div>
            <div class="col p-2">
                <label class="form-label">Certificate</label>
                <input class="form-control" type="file" name="trainingcertificate">
            </div>
            <div class="col p-2">
                <label class="form-label">Remarks</label>
                <input class="form-control" type="text" name="trainingRemarks">
            </div>
        </div>
    </div>
</div>

<script>
// Function to show/hide work experience and training fields
function toggleExperienceFields(select) {
    const experienceFields = document.querySelector('.experience-fields');
    const trainingFields = document.querySelector('.training-fields');

    if (select.value === 'yes') {
        experienceFields.style.display = 'block';
        trainingFields.style.display = 'none'; // Hide training fields
    } else if (select.value === 'no') {
        experienceFields.style.display = 'none'; // Hide experience fields
        trainingFields.style.display = 'block'; // Show training dropdown
    } else {
        experienceFields.style.display = 'none';
        trainingFields.style.display = 'none';
    }
}

// Function to show/hide training details based on training completion
function toggleTrainingFields(select) {
    const trainingDetails = document.querySelector('.training-details');

    if (select.value === 'yes') {
        trainingDetails.style.display = 'block'; // Show training details
    } else {
        trainingDetails.style.display = 'none'; // Hide training details
    }
}

// Function to add a new work experience entry
function addExperience1() {

    const experienceContainer = document.getElementById('experienceContainer');
    const newEntry = document.createElement('div');
    newEntry.className = 'experience-entry row mt-2';

    newEntry.innerHTML = `
            <div class="col p-2">
                <label class="form-label">Position</label>
                <input class="form-control" type="text" name="workposition[]">
            </div>
            <div class="col p-2">
                <label class="form-label">Company Name</label>
                <input class="form-control" type="text" name="CompanyName[]">
            </div>
            <div class="col p-2">
                <label class="form-label">Country</label>
                <select class="form-control" name="JobCountry[]">
                    <option value="">Select Country</option>
                    <?php foreach ($countries as $country): ?>
                    <option value="<?php echo htmlspecialchars($country['countryName']); ?>">
                        <?php echo htmlspecialchars($country['countryName']); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col p-2">
                <label class="form-label">Job Started</label>
                <input class="form-control" type="date" name="yearstart[]">
            </div>
            <div class="col p-2">
                <label class="form-label">Job Ended</label>
                <input class="form-control" type="date" name="yearEnd[]">
            </div>
             <div class="col p-2">
                    <label class="form-label">Years</label>
                    <input class="form-control" type="text" id="yearNew" name="years[]">
                </div>
            <div class="col p-2">
                <label class="form-label">Attach Certificate</label>
                <input type="file" class="form-control" name="jobcertificate[]">
            </div>
            <div class="col p-2">
                <label> </label>
                <button type="button" onclick="removeExperience(this)" class="btn btn-danger mt-4">-</button>
            </div>
        `;

    experienceContainer.appendChild(newEntry);
}

// Function to remove a work experience entry
function removeExperience(button) {
    const experienceEntry = button.closest('.experience-entry');
    experienceEntry.remove();
}

function diff_years(dt2, dt1)
{
    // Calculate the difference in milliseconds between the two dates

}
function getYears (){
    let yearStart = document.getElementById("yearStart").value;
    let yearEnd = document.getElementById("yearEnd").value;
    const date1 = new Date(yearStart);
    const date2 = new Date(yearEnd);
    var diff = (date2.getTime() - date1.getTime()) / 1000;
    // Convert the difference from milliseconds to days
    diff /= (60 * 60 * 24);
    const diffTime = Math.abs(Math.round(diff / 365.25));
    var expiryDisplay = document.getElementById('year');
    if (!isNaN(diffTime)) {
        document.getElementById("year").value = diffTime;
    }
}

function getYearsNew(){


    var l = $('.newYearstart').length;
//Initialize default array
    var result = [];
    for (i = 0; i < l; i++) {
        //Push each element to the array
        result.push($('.newYearstart').eq(i).val());
    }
//print the array or use it for your further logic
    let length = result.length;
    let x = length-1;


    var ln = $('.newYearEnd').length;
//Initialize default array
    var resultEnd = [];
    for (i = 0; i < l; i++) {
        //Push each element to the array
        resultEnd.push($('.newYearEnd').eq(i).val());
    }
//print the array or use it for your further logic
    let lengthEnd = resultEnd.length;
    let y = lengthEnd-1;

    var lny = $('.yearname').length;
//Initialize default array
    var resultYear = [];
    for (i = 0; i < l; i++) {
        //Push each element to the array
        resultYear.push($('.yearname').eq(i).val());
    }
//print the array or use it for your further logic
    let lengthYearname = resultYear.length;
    let z = lengthYearname-1;

    console.log(resultYear[z]);


    let yearStart = result[x];
    let yearEnd = resultEnd[y];

    const date1 = new Date(yearStart);
    const date2 = new Date(yearEnd);



    var diff = (date2.getTime() - date1.getTime()) / 1000;
    // Convert the difference from milliseconds to days
    diff /= (60 * 60 * 24);
    const diffTime = Math.abs(Math.round(diff / 365.25));
    var expiryDisplay = document.getElementById('yearNew');
    if (!isNaN(diffTime)) {
        document.getElementById(resultYear[z]).value = diffTime;
    }
}
</script>

<script>
// Fetch training centers and programs from your PHP API and populate the dropdowns
function fetchTrainingData() {
    fetch('./api-requests/fetch_training_data.php') // Adjust the path to your PHP file
        .then(response => response.json())
        .then(data => {
            const centerDropdown = document.getElementById('trainingCenterDropdown');
            const programDropdown = document.getElementById('trainingProgramDropdown');

            // Populate training centers
            centerDropdown.innerHTML = '<option value="">Select Training Center</option>';
            data.centers.forEach(center => {
                const option = document.createElement('option');
                option.value = center.centerID;
                option.text = center.centerName;
                centerDropdown.add(option);
            });

            // Populate training programs
            programDropdown.innerHTML = '<option value="">Select Training Program</option>';
            data.programs.forEach(program => {
                const option = document.createElement('option');
                option.value = program.programID;
                option.text = program.programName;
                programDropdown.add(option);
            });

        })
        .catch(error => console.error('Error fetching training data:', error));
}

// Call fetchTrainingData when the DOM is loaded
document.addEventListener('DOMContentLoaded', fetchTrainingData);
</script>
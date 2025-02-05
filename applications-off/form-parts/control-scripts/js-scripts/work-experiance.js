function addExperience() {
    const container = document.getElementById('experienceContainer');

    // Create a new job experience entry
    const experienceEntry = document.createElement('div');
    experienceEntry.className = 'experience-entry row';

    // Add fields to the job experience entry
    experienceEntry.innerHTML = `
                        <hr style="margin-top:20px;margin-bottom:20px;">
                                    <div class="col">
                                        <label>Position</label>
                                        <input class="form-control" type="text" name="workposition[]">
                                    </div>
                                    <div class="col">
                                        <label>Company Name</label>
                                        <input class="form-control" type="text" name="CompanyName[]">
                                    </div>
                                    <div class="col p-2">
                                        <label class="form-label">Country</label>
                                        <select class="form-control" name="JobCountry[]">
                                            <option value="">Select Country</option>
                                        </select>
                                    </div>
                                    <div class="col p-2">
                                        <label class="form-label">Job Started</label>
                                        <input class="form-control" type="date" name="yearstart[]">
                                    </div>
                                        <div class="col p-2">
                                        <label class="form-label">Job Started</label>
                                        <input class="form-control" type="date" name="yearEnd[]">
                                        </div>
                                    <div class="col">
                                        <label for="status" class="form-label ">Attach Certificate</label>
                                        <input type="file" class="form-control" name="jobcertificate[]" id="">
                                    </div>
                                    <div class="col">
                                        <label> </label>
                                        <button type="button" onclick="removeExperience(this)" style="font-size:14px;" class="btn btn-danger mt-4 remove-button">-</button>
                                    </div>
                                `;

    // Append the job experience entry to the container
    container.appendChild(experienceEntry);

    const countrySelect = experienceEntry.querySelector('select[name="JobCountry[]"]');
    countries.forEach(country => {
        const option = document.createElement('option');
        option.value = country.countryName;
        option.textContent = country.countryName;
        countrySelect.appendChild(option);
    });
}

function removeExperience(button) {
    // Remove the parent job experience entry when the "Remove" button is clicked
    const container = document.getElementById('experienceContainer');
    const experienceEntry = button.parentNode.parentNode;
    container.removeChild(experienceEntry);
}




// Function to toggle visibility of experience and training fields
function toggleExperienceFields(selectElement) {
    const experienceFields = document.querySelector('.experience-fields');
    const trainingFields = document.querySelector('.training-fields');

    if (selectElement.value === 'yes') {
        experienceFields.style.display = 'block';
    } else if (selectElement.value === 'no') {
        experienceFields.style.display = 'none';
    } else {
        experienceFields.style.display = 'none';
    }
}

/*
function toggleExperienceFields(selectElement) {
    const experienceFields = document.querySelector('.experience-fields');
    const trainingFields = document.querySelector('.training-fields');

    if (selectElement.value === 'yes') {
        experienceFields.style.display = 'block';
        trainingFields.style.display = 'none';
    } else if (selectElement.value === 'no') {
        experienceFields.style.display = 'none';
        trainingFields.style.display = 'block';
    } else {
        experienceFields.style.display = 'none';
        trainingFields.style.display = 'none';
    }
} */

// Declare eduEntryCount only once
let eduEntryCount = 1; // Initialize the education entry count

function addEducation() {
    const container = document.getElementById('educationContainer');

    // Limit to 2 entries
    if (eduEntryCount >= 2) {
        alert("You can add only 2 education entries.");
        return;
    }

    // Create a new education entry
    const educationEntry = document.createElement('div');
    educationEntry.className = 'education-entry row';

    // Add fields to the education entry
    educationEntry.innerHTML = `
        <div class="col">
            <label>School Name</label>
            <input class="form-control" type="text" name="schoolname[]">
        </div>
        <div class="col">
            <label>OL/AL</label>
            <select name="edulevel[]" class="form-select form-control" onchange="handleEduLevelChange(this)" required>
                <option value="al">Advance Level</option>
                <option value="ol">Ordinary Level</option>
            </select>
        </div>
        <div class="col">
            <label for="status" class="form-label ">Year</label>
            <input type="number" class="form-control" name="eduyear[]" id="">
        </div>
        <div class="col">
            <label for="status" class="form-label ">Attach Certificate</label>
            <input type="file" class="form-control" name="certificate[]" id="">
        </div>
        <div class="col">
            <label> </label>
            <button type="button" onclick="removeEducation(this)" style="font-size:14px;" class="btn btn-danger mt-4 remove-button">-</button>
        </div>
    `;

    // Increment entry count
    eduEntryCount++;

    // Append the education entry to the container
    container.appendChild(educationEntry);
}

function removeEducation(button) {
    // Decrement entry count
    eduEntryCount--;

    // Remove the parent education entry when the "Remove" button is clicked
    const container = document.getElementById('educationContainer');
    const educationEntry = button.parentNode.parentNode;
    container.removeChild(educationEntry);
}

function handleEduLevelChange(selectElement) {
    const options = selectElement.parentNode.parentNode.parentNode.querySelectorAll(
        'select[name="edulevel[]"]');

    // Ensure each subsequent entry shows the opposite level of the selected entry
    options.forEach(option => {
        if (option !== selectElement) {
            if (selectElement.value === "al") {
                option.innerHTML = `
                    <option value="ol">Ordinary Level</option>
                `;
            } else if (selectElement.value === "ol") {
                option.innerHTML = `
                    <option value="al">Advance Level</option>
                `;
            }
        }
    });
}
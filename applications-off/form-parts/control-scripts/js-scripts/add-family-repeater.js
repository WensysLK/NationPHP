
    function addRepeater() {
        const container = document.getElementById('repeaterContainer');

        // Create a new repeater field group
        const repeaterGroup = document.createElement('div');
        repeaterGroup.className = 'row repeater-group mt-3';  // Added mt-3 for spacing

        // Add fields to the repeater group
        repeaterGroup.innerHTML = `
            <div class="row">
                <div class="col p-2">
                    <label class="form-label">Name</label>
                    <input class="form-control" type="text" name="childName[]">
                </div>
                <div class="col p-2">
                    <label class="form-label">Relationship</label>
                    <select name="childRelationship[]" class="form-control">
                        <option value="son">Son</option>
                        <option value="daughter">Daughter</option>
                        <option value="brother">Brother</option>
                        <option value="sister">Sister</option>
                    </select>
                </div>
                <div class="col p-2">
                    <label class="form-label">Date of Birth</label>
                    <input class="form-control" type="date" name="childDOB[]" onchange="calculateAge2(this)">
                </div>
                <div class="col p-2">
                    <label class="form-label">Age</label>
                    <input class="form-control" type="text" name="childAge[]" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col p-2">
                    <label class="form-label">School Attended</label>
                    <select name="childSchoolAttended[]" class="form-control" onchange="toggleSchoolFields(this)">
                        <option value="none">Select Option</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>
                <div class="col school-fields" style="display: none;">
                    <div class="row">
                        <div class="col p-2">
                            <label class="form-label">School Name</label>
                            <input class="form-control" type="text" name="childSchoolName[]">
                        </div>
                        <div class="col p-2">
                            <label class="form-label">Grade</label>
                            <input class="form-control" type="text" name="childGrade[]">
                        </div>
                    </div>
                </div>
                <div class="col p-2">
                    <label class="form-label">National ID</label>
                    <input class="form-control" type="text" name="childNIC[]">
                </div>
                <div class="col p-2">
                    <label for="sibilingnicfront" class="form-label">Sibling NIC Front</label>
                    <input type="file" class="form-control" name="sibilingnicfront[]">
                </div>
                <div class="col p-2">
                    <label for="sibilingnicback" class="form-label">Sibling NIC Back</label>
                    <input type="file" class="form-control" name="sibilingnicback[]">
                </div>
                <div class="col p-2">
                    <label> </label>
                    <button type="button" onclick="removeRepeater(this)" style="font-size:14px;" class="btn btn-danger mt-4">-</button>
                </div>
            </div>
        `;

        // Append the repeater group to the container
        container.appendChild(repeaterGroup);
    }

    function removeRepeater(button) {
        // Remove the parent repeater group when the "Remove" button is clicked
        const repeaterGroup = button.closest('.repeater-group');
        if (repeaterGroup) {
            repeaterGroup.remove();  // Remove the entire repeater group
        }
    }


    //school toggle
    // Function to show or hide school fields based on "School Attended" selection
    function toggleSchoolFields(selectElement) {
        const schoolFields = selectElement.closest('.row').querySelector('.school-fields');
        if (selectElement.value === 'yes') {
            schoolFields.style.display = 'block';
        } else {
            schoolFields.style.display = 'none';
        }
    }

    // Example function to calculate age based on DOB (You need to implement it based on your requirements)
    function calculateAge2(dobInput) {
        const dob = new Date(dobInput.value);
        const today = new Date();
        const age = today.getFullYear() - dob.getFullYear();
        dobInput.closest('.row').querySelector('input[name="childAge[]"]').value = age;
    }


    //Birthday calculation
    // Example function to calculate age based on DOB (You need to implement it based on your requirements)
    function calculateAge2(dobInput) {
        const dob = new Date(dobInput.value);
        const today = new Date();
        const age = today.getFullYear() - dob.getFullYear();
        dobInput.closest('.row').querySelector('input[name="childAge[]"]').value = age;
    }
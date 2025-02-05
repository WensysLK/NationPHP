// Declare skillOptionsUrl only once
const skillOptionsUrl = 'form-parts/control-scripts/js-scripts/applications-fetch-skills.php';

// Fetch skill data when the document is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('Document loaded'); // Verify that this runs
    fetch(skillOptionsUrl)
        .then(response => response.json())
        .then(data => {
            console.log('Fetched data:', data); // Debug data here
            window.mainSkills = data.mainSkills; // Store main skills
            window.subSkillOptions = data.subSkills; // Store sub-skills
            populateMainSkills(); // Populate main skills dropdowns
        })
        .catch(error => console.error('Error fetching skill data:', error));
});

// Populate the main skills dropdown with fetched data
function populateMainSkills() {
    const skillSelects = document.querySelectorAll('.main-skill-select');

    // Get already selected main skills
    const selectedSkills = Array.from(document.querySelectorAll('.main-skill-select'))
        .map(select => select.value)
        .filter(value => value !== 'none');

    skillSelects.forEach(select => {
        // Store the current selection to restore it later
        const currentSelection = select.value;

        select.innerHTML = '<option value="none">Select Main Skill</option>';
        for (const [id, name] of Object.entries(window.mainSkills)) {
            if (!selectedSkills.includes(id) || id === currentSelection) {
                const option = document.createElement('option');
                option.value = id;
                option.textContent = name;
                select.appendChild(option);
            }
        }

        // Restore the previous selection
        select.value = currentSelection;
    });
}

// Add a new main skill entry
function addMainSkill() {
    const container = document.getElementById('skillsContainer');
    const mainSkillEntry = document.createElement('div');
    mainSkillEntry.className = 'skill-entry row';

    mainSkillEntry.innerHTML = `
        <div class="col-md-4">
            <label>Main Skill</label>
            <select class="form-control main-skill-select" onchange="loadSubSkills(this)">
                <option value="none">Select Main Skill</option>
            </select>
        </div>
        <div class="col-md-6">
            <label>Sub Skills</label>
            <div class="sub-skill-tags"></div>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="button" class="btn btn-danger" onclick="removeSkillEntry(this)">Remove</button>
        </div>
    `;

    container.appendChild(mainSkillEntry);

    // Populate the new select element with main skills, excluding already selected ones
    populateMainSkills();
}

// Load sub-skills based on the selected main skill
function loadSubSkills(select) {
    const selectedSkill = select.value;
    const subSkillTags = select.parentElement.nextElementSibling.querySelector('.sub-skill-tags');
    subSkillTags.innerHTML = ''; // Clear existing sub-skills

    if (window.subSkillOptions && window.subSkillOptions[selectedSkill]) {
        window.subSkillOptions[selectedSkill].forEach(subSkill => {
            const tag = document.createElement('span');
            tag.className = 'badge badge-secondary';
            tag.textContent = subSkill;

            tag.onclick = function() {
                tag.classList.toggle('badge-selected');
            };

            subSkillTags.appendChild(tag);
        });
    }
}

// Remove a skill entry
function removeSkillEntry(button) {
    const skillEntry = button.parentElement.parentElement;
    skillEntry.remove();
    // Refresh dropdowns after removing an entry
    populateMainSkills();
}

// On form submit, prepare the hidden inputs for main skills and sub-skills
document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form from submitting to see output
    const hiddenContainer = document.getElementById('hiddenSkillsContainer');
    hiddenContainer.innerHTML = ''; // Clear previous inputs

    const skillEntries = document.querySelectorAll('.skill-entry');
    skillEntries.forEach(function(entry, index) {
        const mainSkill = entry.querySelector('.main-skill-select').value;
        const subSkills = Array.from(entry.querySelectorAll('.sub-skill-tags .badge-selected'))
            .map(tag => tag.textContent); // Get text of selected badges

        // Create hidden inputs for main skill
        const mainSkillInput = document.createElement('input');
        mainSkillInput.type = 'hidden';
        mainSkillInput.name = `skills[${index}][main]`;
        mainSkillInput.value = mainSkill;
        hiddenContainer.appendChild(mainSkillInput);

        // Create hidden inputs for each sub-skill
        subSkills.forEach(function(subSkill) {
            const subSkillInput = document.createElement('input');
            subSkillInput.type = 'hidden';
            subSkillInput.name = `skills[${index}][sub][]`;
            subSkillInput.value = subSkill;
            hiddenContainer.appendChild(subSkillInput);
        });
    });

    // Uncomment the line below if you want to actually submit the form
    // event.target.submit();
});
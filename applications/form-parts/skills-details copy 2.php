<!--Forms section starts Here -->
<div class="row">
    <div class="row">
        <!-- Skills Section -->
        <div class="row mt-4">
            <h4>Skills and Sub-Skills</h4>
            <div id="skillsContainer">
                <!-- Main Skill with Sub-Skills will be added here -->
            </div>
            <button type="button" class="btn btn-primary wslk_button" onclick="addMainSkill()">Add Main
                Skill</button>
        </div>
    </div>
<!-- Hidden container for dynamically generated inputs -->
    <div id="hiddenSkillsContainer" style="display:none;"></div>
</div>


<script>
   document.getElementById('multiStepForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const hiddenContainer = document.getElementById('hiddenSkillsContainer');
    hiddenContainer.innerHTML = '';

    const skillEntries = document.querySelectorAll('.skill-entry');
    skillEntries.forEach(function(entry, index) {
        const mainSkill = entry.querySelector('.main-skill-select').value;
        const subSkills = Array.from(entry.querySelectorAll('.sub-skill-tags .badge-selected'))
            .map(tag => tag.dataset.id); // Ensure this retrieves the ID

        console.log('Main Skill:', mainSkill);
        console.log('Sub Skills:', subSkills);

        const mainSkillInput = document.createElement('input');
        mainSkillInput.type = 'hidden';
        mainSkillInput.name = `skills[${index}][main]`;
        mainSkillInput.value = mainSkill;
        hiddenContainer.appendChild(mainSkillInput);

        subSkills.forEach(function(subSkill) {
            const subSkillInput = document.createElement('input');
            subSkillInput.type = 'hidden';
            subSkillInput.name = `skills[${index}][sub][]`;
            subSkillInput.value = subSkill;
            hiddenContainer.appendChild(subSkillInput);
        });
    });

    this.submit();
});
</script>
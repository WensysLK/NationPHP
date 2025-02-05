<div id="langcounter" class="mb-5">
    <h4>Lanuage Details</h4>
    <div class="lang-repeat row">
        <div class="col">
            <label for="">Lanuages</label>
            <select class="form-control" name="lanuagesnames[]" id="">
                <option value="none">Select Lanuage</option>
                <option value="english">English</option>
                <option value="arabic">Arabic</option>
                <option value="hindi">Hindi/Urudhu</option>
                <option value="sinhala">Sinhala</option>
                <option value="tamil">Tamil</option>
            </select>
        </div>
        <div class="col">
            <label for="">Read</label>
            <select class="form-control" name="lanlangread[]" id="">
                <option value="none">Select Skill Level</option>
                <option value="fair">Fair</option>
                <option value="good">Good</option>
                <option value="excellent">Excellent</option>
            </select>
        </div>
        <div class="col">
            <label for="">Write</label>
            <select class="form-control" name="langwrite[]" id="">
                <option value="none">Select Skill Level</option>
                <option value="fair">Fair</option>
                <option value="good">Good</option>
                <option value="excellent">Excellent</option>
            </select>
        </div>
        <div class="col">
            <label for="">Speak</label>
            <select class="form-control" name="langspeak[]" id="">
                <option value="none">Select Skill Level</option>
                <option value="fair">Fair</option>
                <option value="good">Good</option>
                <option value="excellent">Excellent</option>
            </select>
        </div>
        <div class="col">
            <label> </label>
            <button type="button" onclick="addlang()" style="font-size:14px;" class="btn btn-primary mt-4">+</button>
        </div>
    </div>
</div>

<script>
    function addlang() {
    const container = document.getElementById('langcounter');
    const maxLanguages = 5; // Maximum number of languages allowed

    // Check the number of current language entries before adding a new one
    if (container.children.length >= maxLanguages) {
        alert('You have added all languages.');
        return; // Exit the function to prevent adding more than the allowed number
    }

    // Create a new language entry
    const languageEntry = document.createElement('div');
    languageEntry.className = 'lang-repeat row';

    // Add fields to the language entry
    languageEntry.innerHTML = `
<div class="col">
    <label for="">Languages</label>
    <select class="form-control" name="lanuagesnames[]" id="">
        <option value="none">Select Language</option>
        <option value="english">English</option>
        <option value="arabic">Arabic</option>
        <option value="hindi">Hindi/Urdu</option>
        <option value="sinhala">Sinhala</option>
        <option value="tamil">Tamil</option>
    </select>
</div>
<div class="col">
    <label for="">Read</label>
    <select class="form-control" name="lanlangread[]" id="">
        <option value="none">Select Skill Level</option>
        <option value="fair">Fair</option>
        <option value="good">Good</option>
        <option value="excellent">Excellent</option>
    </select>
</div>
<div class="col">
    <label for="">Write</label>
    <select class="form-control" name="langwrite[]" id="">
        <option value="none">Select Skill Level</option>
        <option value="fair">Fair</option>
        <option value="good">Good</option>
        <option value="excellent">Excellent</option>
    </select>
</div>
<div class="col">
    <label for="">Speak</label>
    <select class="form-control" name="langspeak[]" id="">
        <option value="none">Select Skill Level</option>
        <option value="fair">Fair</option>
        <option value="good">Good</option>
        <option value="excellent">Excellent</option>
    </select>
</div>
<div class="col">
    <label> </label>
    <button type="button" onclick="removelang(this)" style="font-size:14px;" class="btn btn-danger mt-4 remove-button">-</button>
</div>
`;

    // Append the new language entry to the container
    container.appendChild(languageEntry);
}

function removelang(button) {
    // Remove the parent language entry when the "Remove" button is clicked
    const container = document.getElementById('langcounter');
    const languageEntry = button.parentNode.parentNode;
    container.removeChild(languageEntry);
}
</script>
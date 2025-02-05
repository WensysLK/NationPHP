<h4>Educational Qalification</h4>
<!-- Educational Information Fields -->
<div class="">
    <div id="educationContainer">
        <!-- Initial set of education fields -->
        <div class="education-entry row">
            <div class="col">
                <label>School Name</label>
                <input class="form-control" type="text" name="schoolname[]">
            </div>
            <div class="col">
                <label>OL/AL</label>
                <select name="edulevel[]" class="form-select form-control" onchange="handleEduLevelChange(this)"
                    required>
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
                <button type="button" onclick="addEducation()" style="font-size:14px;"
                    class="btn btn-primary mt-4">+</button>
            </div>
        </div>
    </div>
</div>
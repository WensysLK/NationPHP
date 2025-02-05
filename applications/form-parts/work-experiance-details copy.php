<div class="mb-5">
    <?php 

include('../includes/db_config.php');
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
                <option value="none">Select Option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
    </div>

    <!-- Work Experience Section -->
    <div class="row mt-2 experience-fields">
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
                    <input class="form-control" type="date" name="yearstart[]">
                </div>
                <div class="col p-2">
                    <label class="form-label">Job Started</label>
                    <input class="form-control" type="date" name="yearEnd[]">
                </div>
                <div class="col p-2">
                    <label class="form-label">Attach Certificate</label>
                    <input type="file" class="form-control" name="jobcertificate[]" id="">
                </div>
                <div class="col p-2">
                    <label> </label>
                    <button type="button" onclick="addExperience()" style="font-size:14px;"
                        class="btn btn-primary mt-4">+</button>
                </div>
            </div>
        </div>
    </div>


</div>
<script>const countries = <?php echo json_encode($countries); ?>;</script>



<!-------- Backup Codes -------
    
     <div class="row mt-2 training-fields">
                                    <hr>
                                    <h4>Training Details</h4>
                                    <div id="trainingContainer">
                                     
                                        <div class="training-entry row">
                                            <div class="col p-2">
                                                <label class="form-label">Training Date</label>
                                                <input class="form-control" type="date" name="trainingDate">
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label">Duration</label>
                                                <input class="form-control" type="text" name="trainingDuration">
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label">Training Centre</label>
                                                <input class="form-control" type="text" name="trainingCentre">
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label">Remarks</label>
                                                <input class="form-control" type="text" name="trainingRemarks">
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
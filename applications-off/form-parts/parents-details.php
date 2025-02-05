    <!-----------------------------------Father Details--------------------------------------->
    <div class="row">
        <div class="col p-2">
            <label for="fatherFullName" class="form-label">Father's Name</label>
            <input type="text" class="form-control" id="fatherFullName" name="fatherName">
            <input type="hidden" name="parentType" value="father">
        </div>
        <div class="col p-2">
            <label for="fatherDOB" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="fatherDOB" name="fatherDOB"
                onchange="calculateAgeparents('father')">
        </div>
        <div class="col p-2">
            <label for="fatherAge" class="form-label">Age</label>
            <input type="text" class="form-control" id="fatherAge" name="fatherAge" readonly>
        </div>

        <div class="col p-2">
            <label for="fatherContactNumber" class="form-label">Contact Number</label>
            <input type="text" class="form-control" id="fatherContactNumber" name="fatherContactNumber">
        </div>

    </div>
    <div class="row">
        <div class="col p-2">
            <label for="fatherNIC" class="form-label">NIC</label>
            <input type="text" class="form-control" id="fatherNIC" name="fatherNIC">
        </div>
        <div class="col p-2">
            <label class="form-label" for="fatherNICfrontcopy">Father's NIC
                Front Copy</label>
            <input type="file" class="form-control" id="fatherNICfront" name="fatherNICfrontcopy">
        </div>
        <div class="col p-2">
            <label class="form-label" for="fatherNICbackcopy">Father's NIC
                Back Copy</label>
            <input type="file" class="form-control" id="fatherNICback" name="fatherNICbackcopy">
        </div>
    </div>
    <!-----------------------------------Mother Details--------------------------------------->
    <div class="row">
        <div class="col p-2">
            <label for="motherFullName" class="form-label">Mother's Name</label>
            <input type="text" class="form-control" id="motherFullName" name="MothertName">
            <input type="hidden" name="parentType" value="mother">
        </div>
        <div class="col p-2">
            <label for="motherDOB" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" id="motherDOB" name="motherDOB"
                onchange="calculateAgeparents('mother')">
        </div>
        <div class="col p-2">
            <label for="motherAge" class="form-label">Age</label>
            <input type="text" class="form-control" id="motherAge" name="motherAge" readonly>
        </div>
        <div class="col p-2">
            <label for="motherContactNumber" class="form-label">Contact Number</label>
            <input type="text" class="form-control" id="motherContactNumber" name="motherContactNumber">
        </div>
    </div>
    <div class="row">
        <div class="col p-2">
            <label for="motherNIC" class="form-label">NIC</label>
            <input type="text" class="form-control" id="motherNIC" name="motherNIC">
        </div>
        <div class="col p-2">
            <label class="form-label" for="motherNICfrontcopy">Mother's NIC
                Front Copy</label>
            <input type="file" class="form-control" id="motherNICfront" name="motherNICfrontcopy">
        </div>
        <div class="col p-2">
            <label class="form-label" for="motherNICbackcopy">Mother's NIC
                Back Copy</label>
            <input type="file" class="form-control" id="motherNICback" name="motherNICbackcopy">
        </div>
    </div>
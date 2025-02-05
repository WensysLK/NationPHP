<h4>Spouce Details</h4>

<div class="row">
    <div class="col p-2">
        <label for="spouseFullName" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="spouseFullName" name="spouseFullName">
    </div>
    <div class="col p-2">
        <label for="relationship" class="form-label">Relationship</label>
        <select name="relationship" class="form-control" id="relationship">
            <option value="">Select</option>
            <option value="husband">Husband</option>
            <option value="wife">Wife</option>
        </select>
    </div>
    <div class="col p-2">
        <label for="spouseDOB" class="form-label">Date of Birth</label>
        <input type="date" class="form-control" id="spouseDOB" name="spouseDOB" onchange="calculateAgespouce('spouse')">
    </div>
    <div class="col p-2">
        <label for="spouseAge" class="form-label">Age</label>
        <input type="text" class="form-control" id="spouseAge" name="spouseAge" readonly>
    </div>
    <div class="col p-2">
        <label for="maritalStatus" class="form-label">Status</label>
        <select name="maritalStatus" class="form-control" id="maritalStatus">
            <option value="">Select Status</option>
            <option value="active">Active</option>
            <option value="divorced">Divorced</option>
            <option value="widowed">Widowed</option>
        </select>
    </div>
</div>

<div class="row">
    <div class="col p-2">
        <label for="spouseContactNumber" class="form-label">Contact Number</label>
        <input type="text" class="form-control" id="spouseContactNumber" name="spouseContactNumber">
    </div>
    <div class="col p-2">
        <label for="spouseNIC" class="form-label">NIC No</label>
        <input type="text" class="form-control" id="spouseNIC" name="spouseNIC">
    </div>

    <div class="col p-2" id="">
        <label for="spoucenicfront" class="form-label ">Spouce Nic Front</label>
        <input type="file" class="form-control" name="spoucenicfront" id="">
    </div>
    <div class="col p-2" id="">
        <label for="spoucenicback" class="form-label ">Spouce Nic Back</label>
        <input type="file" class="form-control" name="spoucenicback" id="">
    </div>
</div>
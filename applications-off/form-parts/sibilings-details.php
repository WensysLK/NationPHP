<h4>Children & Sibiling Details</h4>
                                <div id="repeaterContainer">
                                    <!-- Initial set of fields -->
                                    <div class="row repeater-group">
                                        <div class="row">
                                            <div class="col p-2">
                                                <label class="form-label ">Name</label>
                                                <input class="form-control" type="text" name="childName[]">
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label ">Relationship</label>
                                                <select name="childRelationship[]" class="form-control">
                                                    <option value="son">Son</option>
                                                    <option value="daughter">Daughter</option>
                                                    <option value="brother">Brother</option>
                                                    <option value="sister">Sister</option>
                                                </select>
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label ">Date of Birth</label>
                                                <input class="form-control" type="date" name="childDOB[]"
                                                    onchange="calculateAge2(this)">
                                            </div>
                                            <div class="col p-2">
                                                <label class="form-label ">Age</label>
                                                <input class="form-control" type="text" name="childAge[]" readonly>
                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="col p-2">
                                                <label class="form-label ">School Attended</label>
                                                <select name="childSchoolAttended[]" class="form-control"
                                                    onchange="toggleSchoolFields(this)">
                                                    <option value="none">Select Option</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                            <div class="col school-fields" style="display: none;">
                                                <div class="row">
                                                    <div class="col p-2">
                                                        <label class="form-label ">School Name</label>
                                                        <input class="form-control" type="text"
                                                            name="childSchoolName[]">
                                                    </div>
                                                    <div class="col p-2">
                                                        <label class="form-label ">Grade</label>
                                                        <input class="form-control" type="text" name="childGrade[]">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col p-2" id="nationalIdField">
                                                <label class="form-label ">National ID</label>
                                                <input class="form-control" type="text" name="childNIC[]">
                                            </div>
                                            <div class="col p-2" id="">
                                                <label for="sibilingnicfront" class="form-label ">Sibiling NIC
                                                    Front</label>
                                                <input type="file" class="form-control" name="sibilingnicfront[]" id="">
                                            </div>
                                            <div class="col p-2" id="">
                                                <label for="sibilingnicback" class="form-label ">Sibiling NIC
                                                    Back</label>
                                                <input type="file" class="form-control" name="sibilingnicback[]" id="">
                                            </div>
                                            <div class="col p-2">
                                                <label> </label>
                                                <button type="button" onclick="addRepeater()" style="font-size:14px;"
                                                    class="btn btn-primary mt-4" id="addfam">+</button>
                                            </div>
                                        </div>



                                    </div>
                                </div>



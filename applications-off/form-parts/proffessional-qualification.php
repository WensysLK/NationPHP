<div class="row mt-2">
    <h4>Proffessional Qualification</h4>
    <div class="">
        <div id="coursesContainer">
            <!-- Initial set of course fields -->
            <div class="course-entry row">
                <div class="col">
                    <label>Name Of Institute</label>
                    <input class="form-control" type="text" name="institueName[]">
                </div>
                <div class="col">
                    <label>Course Name</label>
                    <input class="form-control" type="text" name="CourseName[]">
                </div>
                <div class="col">
                    <label for="status" class="form-label">Status</label>
                    <select name="CourseStatus[]" class="form-select" required>
                        <option value="Pending">Pending</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
                <div class="col">
                    <label for="duration" class="form-label">Duration</label>
                    <input type="text" class="form-control" name="duration[]" id="">
                </div>
                <div class="col">
                    <label for="status" class="form-label ">Attach Certificate</label>
                    <input type="file" class="form-control" name="courcecertificate[]" id="">
                </div>
                <div class="col">
                    <label> </label>
                    <button type="button" onclick="addCourse()" style="font-size:14px;"
                        class="btn btn-primary mt-4">+</button>
                </div>
            </div>
        </div>
    </div>
</div>
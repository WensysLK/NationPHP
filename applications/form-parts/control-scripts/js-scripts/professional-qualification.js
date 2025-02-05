function addCourse() {
    const container = document.getElementById('coursesContainer');

    // Create a new course entry
    const courseEntry = document.createElement('div');
    courseEntry.className = 'course-entry row';

    // Add fields to the course entry
    courseEntry.innerHTML = `
                        <hr style="margin-top:20px;margin-bottom:20px;">
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
                                        <button type="button" onclick="removeCourse(this)" style="font-size:14px;" class="btn btn-danger mt-4 remove-button">-</button>
                                    </div>
                                `;

    // Append the course entry to the container
    container.appendChild(courseEntry);
}

function removeCourse(button) {
    // Remove the parent course entry when the "Remove" button is clicked
    const container = document.getElementById('coursesContainer');
    const courseEntry = button.parentNode.parentNode;
    container.removeChild(courseEntry);
}
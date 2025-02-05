<!-- Add New Sub-Agent Modal -->
<div class="modal fade" id="mainmodlesubagent" tabindex="-1" aria-labelledby="subAgentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subAgentModalLabel">Add New Sub-Agent</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="subAgentForm" method="post" action="javascript:void(0);">
                    <!-- Hidden Field for Registration Status -->
                    <input type="hidden" id="regStatus" name="regStatus" value="pending">

<!--                    <div class="mb-3">-->
<!--                        <lable class="form-label">Profile Photo</lable>-->
<!--                        <input type="file" class="form-control" name="profile_photo" id="profile_photo">-->
<!--                    </div>-->
                    <!-- Title -->
                    <div class="mb-3">
                        <label for="subAgentTitle" class="form-label">Title</label>
                        <select id="subAgentTitle" class="form-control" name="title">
                            <option value="">Select a title</option>
                            <option value="Mr.">Mr.</option>
                            <option value="Ms.">Ms.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Dr.">Dr.</option>
                        </select>
                    </div>

                    <!-- First Name -->
                    <div class="mb-3">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" >
                    </div>

                    <!-- Last Name -->
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" >
                    </div>

                    <!-- Phone Number -->
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" >
                    </div>

                    <!-- NIC Number -->
                    <div class="mb-3">
                        <label for="nicNumber" class="form-label">NIC Number</label>
                        <input type="text" class="form-control" id="nicNumber" name="nicNumber" >
                    </div>

                    <!-- Save Button -->
                    <button type="button" class="btn btn-primary" id="saveSubAgentBtn">Save</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<script>
document.getElementById('saveSubAgentBtn').addEventListener('click', function(event) {
    event.preventDefault();
    const fileInput = document.getElementById("profile_photo");
    const selectedFiles = fileInput.files;
    alert(selectedFiles);
    const subAgentData = {
        title: document.getElementById('subAgentTitle').value,
        firstName: document.getElementById('firstName').value,
        lastName: document.getElementById('lastName').value,
        phoneNumber: document.getElementById('phoneNumber').value,
        nicNumber: document.getElementById('nicNumber').value,
        regStatus: document.getElementById('regStatus').value,
    };

    fetch('http://localhost/nationscrm/applications/form-parts/popup/saveSubAgent.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(subAgentData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Sub-agent added successfully!');
            document.getElementById('subAgentForm').reset();
            const modalElement = document.getElementById('mainmodlesubagent');
            const modal = new bootstrap.Modal(modalElement);
            modal.hide();
        } else {
            console.error('Server Error:', data.error);
            alert('Failed to add sub-agent: ' + data.error);
        }
    })
    .catch(error => {
        console.error('Fetch Error:', error);
        alert('An error occurred while saving the sub-agent.');
    });
});


</script>
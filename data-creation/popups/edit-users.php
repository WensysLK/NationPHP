<?php

$sqlMedicalCenters = "SELECT UserRoleID, UserRoleName FROM userrole WHERE softdeletestatus = 1"; // Assuming there's a `status` column to filter active centers
$resultMedicalCenters = mysqli_query($conn, $sqlMedicalCenters);


?>
<div class="modal fade" id="userEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">


                <h6 class="modal-title" id="exampleModalLabel6">Edit Users</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="functions/user_update.php" method="POST">
                    <div class="row">
                        <input type="hidden" class="form-control" name="userId" id="userId">
                        <div class="col">
                            <label for="medicalCentername" class="form-label">User Name</label>
                            <input type="text" class="form-control" name="userName" id="users_name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="contractType" class="mt-2">User Role</label>
                            <select  id="usersRole" class="form-control" name="userRole">
                        <option value="none" selected>Select User Role</option>
                        <?php
                        // Populate dropdown with medical center details
                        if (mysqli_num_rows($resultMedicalCenters) > 0) {
                            while ($row = mysqli_fetch_assoc($resultMedicalCenters)) {
                                echo "<option value='" . $row['UserRoleID'] . "'>" . $row['UserRoleName'] . "</option>";
                            }
                        } else {
                            echo "<option value='none'>No User Role Available</option>";
                        }
                        ?>
                    </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="Email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="userEmail" id="userEmail">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="password" class="form-label"> Password </label>
                            <input type="text" class="form-control" name="userPassword" id="userPassword" >
                        </div>

                    </div>

                    <button type="submit" class="btn btn-primary mt-2" name="submit">Update</button>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tx-13" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php include('../includes/header.php'); ?>

<body>
    <?php include('../includes/navigation-admin.php'); ?>
    <div class="content content-fixed bd-b">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mg-b-5">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">All Users</a></li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0">View All</h4>
                </div>
                <div class="mg-t-20 mg-sm-t-0">

                    <a href="#user" data-bs-toggle="modal" data-animation="effect-slide-in-bottom">
                        <button type="button" class="btn btn-primary btn-icon">
                            <i data-feather="user-plus"></i>
                        </button>

                    </a>


                </div>
            </div>

            <div class="content">
            <table id="viewclints" class="table table-striped table-bordered mt-2" style="width:100%">
    <?php
        $sqlapplication = "SELECT users.userID,users.Username,users.Email,users.password, userrole.UserRoleName,userrole.UserRoleID
FROM users
INNER JOIN userrole ON users.userRoleID=userrole.UserRoleID Where users.softdeletestatus=1";

        $resapplication = mysqli_query($conn,$sqlapplication);

        if($resapplication == true) {
            $count_rows = mysqli_num_rows($resapplication);
            $num = 1;

            if($count_rows > 0) { ?>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>User Id</th>
                        <th>User Name</th>
                        <th>Email </th>
                        <th>Password</th>
                        <th>User Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($resapplication)) {
                        $userID = $row['userID'];
                        $userName = $row['Username'];
                        $email = $row['Email'];
                        $password = $row['password'];
                        $userRoleName = $row['UserRoleName'];
                        $userRoleId = $row['UserRoleID'];

                        
                    ?>
                    <tr>
                        <td><span id=""><?php echo $num++; ?></span></td>
                        <td><span id="medicalCenterID"><?php echo $userID; ?></span></td>
                        <td><?php echo $userName; ?></td>
                        <td><?php echo $email; ?></span></td>
                        <td><span id="mediPhone"><?php echo $password; ?></span></td>
                        <td><span id="mediEmail"><?php echo $userRoleName; ?></span></td>
                        <td style="display: none"><?php echo $userRoleId; ?></td>
                        <td>
                            <button type="button" class="btn btn-success editbtn">
                                <svg fill="#000000" width="800px" height="800px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z"/></svg>
                            </button>
                            <form id="registrationForm" method="post" action="functions/user_delete.php" style="display:inline;">
                                <!--        <form method="POST" action="Funtions/delete_license_precheck.php" style="display:inline;">-->
                                <input type="hidden" name="userId" value="<?php echo $userID; ?>">
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this User?');">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            <?php } else {
                echo "<div class='alert alert-primary mt-2' role='alert'> No Available Applications !</div>";
            }
        } ?>
</table>




            </div>
        </div>
        <!--Popup form for Precheck Registration -->
        <?php include('popups/create-users.php'); ?>
        <?php include('popups/edit-users.php'); ?>
        <!-- End popup -->

        
    
    <?php include('../includes/footer.php'); ?>



        <script>
            $(document).ready(function () {

                $('.editbtn').on('click', function () {

                    $('#userEdit').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                        return $(this).text();
                    }).get();

                    console.log(data);
                    // selectElement('userRole', data[5]);

                    $('#userId').val(data[1]);
                    $('#users_name').val(data[2]);

                     var roleId=data[6];
                    console.log(roleId);
                    if(roleId == 1){
                        $("#usersRole option[value= 1]").attr('selected', true);
                    }else if(roleId == 2){
                        $("#usersRole option[value= 2]").attr('selected', true);
                    }else if(roleId == 3){
                        $("#usersRole option[value= 3]").attr('selected', true);
                    }else if (roleId == 4){
                        $("#usersRole option[value= 4]").attr('selected', true);
                    }


                    // $('#usersRole').val(data[5]);
                    $('#userEmail').val(data[3]);
                    $('#userPassword').val(data[4]);



                });
            });
        </script>

</body>

</html>
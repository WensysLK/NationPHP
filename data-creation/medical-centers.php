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
                            <li class="breadcrumb-item"><a href="#">Medical Centers</a></li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0">View All</h4>
                </div>
                <div class="mg-t-20 mg-sm-t-0">

                    <a href="#modal6" data-bs-toggle="modal" data-animation="effect-slide-in-bottom">
                        <button type="button" class="btn btn-primary btn-icon">
                            <i data-feather="user-plus"></i>
                        </button>

                    </a>


                </div>
            </div>

            <div class="content">
            <table id="viewclints" class="table table-striped table-bordered mt-2" style="width:100%">
    <?php
        $sqlapplication = "SELECT `medicalCenterID`,`MediName`, `AddressLine1`, `AddressLine2`, `mediCity`, `mediPhone`, `mediEmail`, `mediWebsite` FROM `medical_center` WHERE softdeletestatus=1";

        $resapplication = mysqli_query($conn,$sqlapplication);

        if($resapplication == true) {
            $count_rows = mysqli_num_rows($resapplication);
            $num = 1;

            if($count_rows > 0) { ?>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Medical center Id</th>
                        <th>Medical center name</th>
                        <th>Address </th>
                        <th>City</th>
                        <th>Phone</th>
                        <th>E-mail</th>
                        <th>Web site</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($resapplication)) {
                        $medicalCenterID = $row['medicalCenterID'];
                        $mediCentName = $row['MediName'];
                        $mediAdd1 = $row['AddressLine1'];
                        $mediAdd2 = $row['AddressLine2'];
                        $mediCity = $row['mediCity'];
                        $mediPhone = $row['mediPhone'];
                        $mediEmail = $row['mediEmail'];
                        $mediWebsite = $row['mediWebsite'];
                        
                    ?>
                    <tr>
                        <td><span id=""><?php echo $num++; ?></span></td>
                        <td><span id="medicalCenterID"><?php echo $medicalCenterID; ?></span></td>
                        <td><?php echo $mediCentName; ?></td>
                        <td><?php echo $mediAdd1; ?></span></td>
                        <td><span id="mediCity"><?php echo $mediCity; ?></span></td>
                        <td><span id="mediPhone"><?php echo $mediPhone; ?></span></td>
                        <td><span id="mediEmail"><?php echo $mediEmail; ?></span></td>
                        <td><span id="mediWebsite"><?php echo $mediWebsite; ?></span></td>


                        <td>
                            <button type="button" class="btn btn-success editbtn">
                                <svg fill="#000000" width="800px" height="800px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z"/></svg>
                            </button>
                            <form id="registrationForm" method="post"  action="functions/medical_center_delete.php"style="display:inline;">
                                <!--        <form method="POST" action="Funtions/delete_license_precheck.php" style="display:inline;">-->
                                <input type="hidden" name="medicalCenterID" value="<?php echo $medicalCenterID; ?>">                               <button type="submit" class="btn btn-danger btn-sm"
                                                                                                                                                 onclick="return confirm('Are you sure you want to delete this Medical Center?');">
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
        <?php include('popups/create-medical-center.php'); ?>
        <?php include('popups/edit-medical-center.php'); ?>
        <!-- End popup -->

        
    
    <?php include('../includes/footer.php'); ?>

<!--        <script type="text/javascript">-->
<!--            $(document).ready(function (){-->
<!--                $(document).on('click','.edit',function (){-->
<!--                    var medicalCenterID = $('#medicalCenterID').text();-->
<!--                    var mediCentName = $('#mediCentName').text();-->
<!--                    var mediAdd1 = $('#mediAdd1').text();-->
<!--                    var mediAdd2 = $('#mediAdd2').text();-->
<!--                    var mediCity = $('#mediCity').text();-->
<!--                    var mediPhone = $('#mediPhone').text();-->
<!--                    var mediEmail = $('#mediEmail').text();-->
<!--                    var mediWebsite = $('#mediWebsite').text();-->
<!---->
<!--                    $('#modal6').modal('show');-->
<!--                    $('#medicalcenterId').val(medicalCenterID);-->
<!--                    $('#medicalcentername').val(mediCentName);-->
<!--                    $('#phonenumber').val(mediAdd1);-->
<!--                    $('#medicalCenteremail').val(mediAdd2);-->
<!--                    $('#addressline1').val(mediCity);-->
<!--                    $('#addressline2').val(mediPhone);-->
<!--                    $('#medicalCity').val(mediEmail);-->
<!--                    $('#wesiteurl').val(mediWebsite);-->
<!--                });-->
<!--            });-->
<!--        </script>-->

        <script>
            $(document).ready(function () {

                $('.editbtn').on('click', function () {

                    $('#modal78').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                        return $(this).text();
                    }).get();

                    console.log(data);
                    $('#medicalcenterId').val(data[1]);
                    $('#medicalcentername').val(data[2]);
                    $('#phonenumber').val(data[5]);
                    $('#medicalCenteremail').val(data[6]);
                    $('#addressline1').val(data[3]);
                    $('#medicalCity').val(data[4]);
                    $('#wesiteurl').val(data[7]);


                });
            });
        </script>

</body>

</html>
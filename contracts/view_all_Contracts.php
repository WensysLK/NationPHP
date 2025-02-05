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
                            <li class="breadcrumb-item"><a href="#">Contracts</a></li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0">View All</h4>
                </div>
                <div class="mg-t-20 mg-sm-t-0">

                </div>
            </div>
            <div class="content">
                <ul class="nav nav-tabs mb-2" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="available-contracts-tab" data-bs-toggle="tab"
                            data-bs-target="#available-contracts" type="button" role="tab"
                            aria-controls="available-contracts" aria-selected="true">Available Contracts</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="processing-tab" data-bs-toggle="tab" data-bs-target="#processing"
                            type="button" role="tab" aria-controls="processing"
                            aria-selected="false">Processing</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed"
                            type="button" role="tab" aria-controls="completed" aria-selected="false">Departured</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="deported-tab" data-bs-toggle="tab" data-bs-target="#deported"
                            type="button" role="tab" aria-controls="deported" aria-selected="false">Deported</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="available-contracts" role="tabpanel"
                        aria-labelledby="available-contracts-tab">

                        <?php include('contract-parts/available_contracts.php'); ?>

                    </div>
                    <div class="tab-pane fade" id="processing" role="tabpanel" aria-labelledby="processing-tab">

                    <?php include('contract-parts/processing_contracts.php'); ?>

                    </div>
                    <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                        <p>Content for Completed tab.</p>
                    </div>
                    <div class="tab-pane fade" id="deported" role="tabpanel" aria-labelledby="deported-tab">
                        <p>Content for Deported tab.</p>
                    </div>
                </div>
            </div>
        </div>
        <!--Popup form for Precheck Registration -->
        
        <!-- End popup -->

        
    
    <?php include('../includes/footer.php'); ?>

        <script>

            $(document).ready(function () {
                document.getElementById("admin_code_edit_1").style.display = "none";
                document.getElementById("admin_code_edit_2").style.display = "none";
                document.getElementById("admin_code_edit_3").style.display = "none";
                document.getElementById("admin_code_edit_4").style.display = "none";
                $('.buttonNew').on('click', function () {
                    alert("hello");
                    $('#modalEdit').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function () {
                        return $(this).text();
                    }).get();

                    console.log(data);
                    // selectElement('userRole', data[5]);
                    //
                    $('#contractId').val(data[5]);
                    $('#users_name').val(data[2]);
                    $('#passport').val(data[6]);
                    //
                    var roleId=data[3];
                    var contractType=data[4];
                    // console.log(roleId);
                    if(roleId == "kwait"){
                        // document.getElementById("usersRole").selectedIndex = "noCountry"; //Option 10
                        $('select[name^="countryType"] option[value="kwait"]').attr("selected","selected");

                        document.getElementById("admin_code_edit_3").style.display = "block";
                        if(contractType == "domestic"){
                            $('select[name^="contractType_3"] option[value="domestic"]').attr("selected","selected");
                            document.getElementById("enjaze_3").checked = true;
                            document.getElementById("fingerprint_3").checked = true;

                        }else{
                            $('select[name^="contractType_3"] option[value="non-domestic"]').attr("selected","selected");
                            document.getElementById("enjaze_3").checked = true;
                            document.getElementById("fingerprint_3").checked = true;
                        }

                        // $("#usersRole option[value= 1]").attr('selected', true);
                    }else if(roleId == "saudi"){
                        $('select[name^="countryType"] option[value="saudi"]').attr("selected","selected");

                        document.getElementById("admin_code_edit_2").style.display = "block";
                        if(contractType == "domestic"){
                            $('select[name^="contractType_2"] option[value="domestic"]').attr("selected","selected");
                            // document.getElementById("muzaned_1").checked = true;
                            document.getElementById("enjaze_2").checked = true;
                            document.getElementById("fingerprint_2").checked = true;

                        }else{
                            $('select[name^="contractType_2"] option[value="non-domestic"]').attr("selected","selected");
                            // document.getElementById("muzaned_1").checked = true;
                            document.getElementById("enjaze_2").checked = true;
                            document.getElementById("fingerprint_2").checked = true;
                        }
                    }else if(roleId == "noCountry"){
                        $('select[name^="countryType"] option[value="noCountry"]').attr("selected","selected");

                        document.getElementById("admin_code_edit_1").style.display = "block";
                        if(contractType == "domestic"){
                            $('select[name^="contractType_1"] option[value="domestic"]').attr("selected","selected");
                            document.getElementById("muzaned_1").checked = true;
                            document.getElementById("enjaze_1").checked = true;
                            document.getElementById("fingerprint_1").checked = true;

                        }else{
                            $('select[name^="contractType_1"] option[value="non-domestic"]').attr("selected","selected");
                            document.getElementById("muzaned_1").checked = true;
                            document.getElementById("enjaze_1").checked = true;
                            document.getElementById("fingerprint_1").checked = true;
                        }
                    }else if (roleId == "quatar"){
                        $('select[name^="countryType"] option[value="quatar"]').attr("selected","selected");

                        document.getElementById("admin_code_edit_4").style.display = "block";
                        if(contractType == "domestic"){
                            $('select[name^="contractType_4"] option[value="domestic"]').attr("selected","selected");
                            // document.getElementById("muzaned_1").checked = true;
                            document.getElementById("enjaze_4").checked = true;
                            document.getElementById("fingerprint_4").checked = true;

                        }else{
                            $('select[name^="contractType_4"] option[value="non-domestic"]').attr("selected","selected");
                            // document.getElementById("muzaned_1").checked = true;
                            document.getElementById("enjaze_4").checked = true;
                            document.getElementById("fingerprint_4").checked = true;
                        }
                    }
                    //
                    //
                    // // $('#usersRole').val(data[5]);
                    // $('#userEmail').val(data[3]);
                    // $('#userPassword').val(data[4]);



                });
            });
            function toggleDropdownEdit(selObj){
                const ac = document.getElementById("admin_code_edit_1");

                const acd = document.getElementById("admin_code_edit_2");

                const af = document.getElementById("admin_code_edit_3");

                const afd = document.getElementById("admin_code_edit_4");

                ac.style.display = selObj.value === "noCountry" ? "block" : "none";
                acd.style.display = selObj.value === "saudi" ? "block" : "none";
                af.style.display = selObj.value === "kwait" ? "block" : "none";
                afd.style.display = selObj.value === "quatar" ? "block" : "none";
            }

        </script>
        <script>
            const ac = document.getElementById("admin_code_edit_1");
            ac.style.display = "none";

            const acd = document.getElementById("admin_code_edit_2");
            acd.style.display = "none";
            const af = document.getElementById("admin_code_edit_3");
            af.style.display = "none";

            const afd = document.getElementById("admin_code_edit_4");
            afd.style.display = "none";

            function toggleDropdownNew(selObj) {
                alert(selObj);
                ac.style.display = selObj.value === "noCountry" ? "block" : "none";
                acd.style.display = selObj.value === "saudi" ? "block" : "none";
                af.style.display = selObj.value === "kwait" ? "block" : "none";
                afd.style.display = selObj.value === "quatar" ? "block" : "none";
            }
        </script>
</body>

</html>
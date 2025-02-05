<div class="modal fade" id="modal6" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel6" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content tx-14">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel6">Create Contract</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="../contracts/contract-process/create_contract.php" method="POST"
                      enctype="multipart/form-data">
                    <input type="hidden" name="appId" value="<?php echo $applicationID; ?>">
                    <div class="row">
                        <div class="col-4">
                            <img src="../uploads/img/fallback-image.png" class="img-fluid" alt="Responsive image">
                        </div>
                        <div class="col-6">
                            <p><b>Client Name :</b>
                                <?php echo $applicationTitle . "." . $applicationFname . " " . $applicationLname; ?>
                                <br><b>Passport No :</b> <?php echo $applicationPassport; ?>
                            </p>
                            <label for="contractType">Country</label>
                            <select name="countryType" class="form-control" onchange='toggleDropdown(this);'>
                                <option value="none" selected>select country</option>
                                <option value="noCountry">No Country</option>
                                <option value="saudi">Saudi Arabia</option>
                                <option value="kwait">Kwait</option>
                                <option value="quatar">Quatar</option>
                            </select>
                            <div id="admin_code">
                                <label for="contractType">Contract Type</label>
                                <select name="contractType[]" class="form-control">
                                    <option value="none" selected>select Type</option>
                                    <option value="domestic">Domestic</option>
                                    <option value="non-domestic">Non-Domestic</option>
                                </select>

                                <!-- Checkboxes for options -->
                                <div class="mt-3" style="display:none">
                                    <h6>Contract Options:</h6>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="options[]" value="muzaned" id="muzaned" checked disabled>
                                        <label class="form-check-label" for="muzaned">
                                            Muzaned
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="options[]" value="enjaze" id="enjaze" checked disabled>
                                        <label class="form-check-label" for="enjaze">
                                            Enjaze
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="options[]" value="fingerprint" id="fingerprint"checked disabled>
                                        <label class="form-check-label" for="fingerprint">
                                            Finger Print
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div id="admin_code_2">
                                <label for="contractType">Contract Type</label>
                                <select name="contractType[]" class="form-control">
                                    <option value="none" selected>select Type</option>
                                    <option value="domestic">Domestic</option>
                                    <!--                                    <option value="non-domestic">Non-Domestic</option>-->
                                </select>

                                <!-- Checkboxes for options -->
                                <div class="mt-3">
                                    <h6>Contract Options:</h6>
                                    <!--                                    <div class="form-check">-->
                                    <!--                                        <input class="form-check-input" type="checkbox" name="options[]" value="muzaned" id="muzaned">-->
                                    <!--                                        <label class="form-check-label" for="muzaned">-->
                                    <!--                                            Muzaned-->
                                    <!--                                        </label>-->
                                    <!--                                    </div>-->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="options[]" value="enjaze" id="enjaze">
                                        <label class="form-check-label" for="enjaze">
                                            Enjaze
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="options[]" value="fingerprint" id="fingerprint">
                                        <label class="form-check-label" for="fingerprint">
                                            Finger Print
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div id="admin_code_3">
                                <label for="contractType">Contract Type</label>
                                <select name="contractType[]" class="form-control">
                                    <option value="none" selected>select Type</option>
                                    <option value="domestic">Domestic</option>
                                    <option value="non-domestic">Non-Domestic</option>
                                </select>

                                <!-- Checkboxes for options -->
                                <div class="mt-3">
                                    <h6>Contract Options:</h6>
                                    <!--                                    <div class="form-check">-->
                                    <!--                                        <input class="form-check-input" type="checkbox" name="options[]" value="muzaned" id="muzaned">-->
                                    <!--                                        <label class="form-check-label" for="muzaned">-->
                                    <!--                                            Muzaned-->
                                    <!--                                        </label>-->
                                    <!--                                    </div>-->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="options[]" value="enjaze" id="enjaze">
                                        <label class="form-check-label" for="enjaze">
                                            Enjaze
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="options[]" value="fingerprint" id="fingerprint">
                                        <label class="form-check-label" for="fingerprint">
                                            Finger Print
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div id="admin_code_4">
                                <label for="contractType">Contract Type</label>
                                <select name="contractType[]" class="form-control">
                                    <option value="none" selected>select Type</option>
                                    <option value="domestic">Domestic</option>
                                    <option value="non-domestic">Non-Domestic</option>
                                </select>

                                <!-- Checkboxes for options -->
                                <div class="mt-3">
                                    <h6>Contract Options:</h6>
                                    <!--                                    <div class="form-check">-->
                                    <!--                                        <input class="form-check-input" type="checkbox" name="options[]" value="muzaned" id="muzaned">-->
                                    <!--                                        <label class="form-check-label" for="muzaned">-->
                                    <!--                                            Muzaned-->
                                    <!--                                        </label>-->
                                    <!--                                    </div>-->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="options[]" value="enjaze" id="enjaze">
                                        <label class="form-check-label" for="enjaze">
                                            Enjaze
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="options[]" value="fingerprint" id="fingerprint">
                                        <label class="form-check-label" for="fingerprint">
                                            Finger Print
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-2" name="submit">Create Contract</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary tx-13" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    const ac = document.getElementById("admin_code");
    ac.style.display = "none";

    const acd = document.getElementById("admin_code_2");
    acd.style.display = "none";
    const af = document.getElementById("admin_code_3");
    af.style.display = "none";

    const afd = document.getElementById("admin_code_4");
    afd.style.display = "none";

    function toggleDropdown(selObj) {
        ac.style.display = selObj.value === "noCountry" ? "block" : "none";
        acd.style.display = selObj.value === "saudi" ? "block" : "none";
        af.style.display = selObj.value === "kwait" ? "block" : "none";
        afd.style.display = selObj.value === "quatar" ? "block" : "none";
    }
</script>
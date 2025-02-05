<?php include('../../includes/header.php'); ?>

<body>
    <?php include('../../includes/navigation-admin.php'); ?>
    <div class="content content-fixed bd-b">
        <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-style1 mg-b-5">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item"><a href="#">Sponsor</a></li>
                        </ol>
                    </nav>
                    <h4 class="mg-b-0">Registration</h4>
                </div>
                <div class="mg-t-20 mg-sm-t-0">
                    <a href="<?php echo $baseUrl; ?>/agents/sponcers/create-sponcers.php" >
                        <button type="button" class="btn btn-primary btn-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="feather feather-file-plus">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z">

                                </path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="12" y1="18" x2="12" y2="12"></line>
                                <line x1="9" y1="15" x2="15" y2="15"></line>
                            </svg>
                        </button>

                    </a>




                </div>
            </div>
            <div class="content">
                <!--- Tab Start -->
                <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="recruitment-company-tab" data-bs-toggle="tab"
                            data-bs-target="#recruitment-company" type="button" role="tab"
                            aria-controls="recruitment-company" aria-selected="true">Sponsor Details</button>
                    </li>
                  <!--  <li class="nav-item" role="presentation">
                        <button class="nav-link" id="company-tab" data-bs-toggle="tab" data-bs-target="#company"
                            type="button" role="tab" aria-controls="company"
                            aria-selected="false">Company</button>
                    </li>-->
<!--                    <li class="nav-item" role="presentation">-->
<!--                        <button class="nav-link" id="Individual-tab" data-bs-toggle="tab" data-bs-target="#Individual"-->
<!--                            type="button" role="tab" aria-controls="Individual"-->
<!--                            aria-selected="false">Individual</button>-->
<!--                    </li>-->
<!--                    <li class="nav-item" role="presentation">-->
<!--                        <button class="nav-link" id="processing-tab" data-bs-toggle="tab" data-bs-target="#Pending-Agreements"-->
<!--                            type="button" role="tab" aria-controls="Pending-Agreements"-->
<!--                            aria-selected="false">Pending Agreements</button>-->
<!--                    </li>-->
                    
                    
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="recruitment-company" role="tabpanel"
                        aria-labelledby="recruitment-company-tab">

                        <?php include('view-sponcer.php'); ?>
                    
                    </div>
                    <div class="tab-pane fade" id="company" role="tabpanel" aria-labelledby="company-tab">

                    
                    <?php //include('local-agent-fetch/view-company-local-agent.php'); ?>

                    </div>
                    <div class="tab-pane fade" id="Individual" role="tabpanel" aria-labelledby="Individual-tab">
                    <?php //include('local-agent-fetch/view-individual-local-agent.php'); ?>
                    
                    </div>
                    <div class="tab-pane fade" id="Pending-Agreements" role="tabpanel" aria-labelledby="Pending-Agreements-tab">
                    
                   

                    </div>
                    
                </div>
                <!--- Tab End -->
            </div>
        </div>
        

        <?php include('../../includes/footer.php'); ?>

        <!--Popup form for Precheck Registration -->
        <?php include('popups/register_sponcer.php'); ?>
        <!-- End popup -->
</body>

</html>

<!-- DataTables Initialization (if applicable) -->
<script>
  $(document).ready(function() {
      $('#viewcompanyagent').DataTable({
          language: {
              searchPlaceholder: 'Search...',
              sSearch: '',
              lengthMenu: '_MENU_ items/page',
          }
      });
  });
</script>

<script>
  $(document).ready(function() {
      $('#viewindividual').DataTable({
          language: {
              searchPlaceholder: 'Search...',
              sSearch: '',
              lengthMenu: '_MENU_ items/page',
          }
      });
  });
</script>
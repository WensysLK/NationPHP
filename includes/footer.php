<footer class="footer">
    <div>
        <span>&copy; 2024 thenations </span>
        <span>Created by <a href="#">WensysLk</a></span>
    </div>
</footer>

<!-- jQuery (already loaded from local path) -->
<script src="<?php echo $baseUrl; ?>/includes/lib/jquery/jquery.min.js"></script>

<!-- Bootstrap JS -->
<script src="<?php echo $baseUrl; ?>/includes/lib/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Additional Libraries -->
<script src="<?php echo $baseUrl; ?>/includes/lib/feather-icons/feather.min.js"></script>
<script src="<?php echo $baseUrl; ?>/includes/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?php echo $baseUrl; ?>/includes/lib/prismjs/prism.js"></script>
<script src="<?php echo $baseUrl; ?>/includes/lib/parsleyjs/parsley.min.js"></script>
<script src="<?php echo $baseUrl; ?>/includes/lib/jquery-steps/build/jquery.steps.min.js"></script>

<!-- DataTables (Only One Version) -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<!-- DashForge Scripts -->
<script src="<?php echo $baseUrl; ?>/includes/assets/js/dashforge.js"></script>
<script src="<?php echo $baseUrl; ?>/includes/assets/js/dashforge.mail.js"></script>

<!-- Theme Customizer -->
<script src="<?php echo $baseUrl; ?>/includes/lib/js-cookie/js.cookie.js"></script>
<script src="<?php echo $baseUrl; ?>/includes/assets/js/dashforge.settings.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<!-- Custom Scripts -->
<script src="<?php echo $baseUrl; ?>/includes/custom/custom_script.js"></script>



<!-- DataTables Initialization (if applicable) -->
<script>
  $(document).ready(function() {
      // Common options for all DataTables
      const dataTableOptions = {
          language: {
              searchPlaceholder: 'Search...',
              sSearch: '',
              lengthMenu: '_MENU_ items/page',
          }
      };

      // Initialize all tables with the common options
      $('#viewclints, #viewclintsprocesscontracts, #processfprint, #medicalcomplete,#educationTable,#qualificationTable,#workTable,#attachmentTable,#siblinginfo').DataTable(dataTableOptions);
  });
</script>

<!-- Theme Mode Switcher -->
<script>
  $(function(){
    'use strict';

    window.darkMode = function(){
      $('.btn-white').addClass('btn-dark').removeClass('btn-white');
    }

    window.lightMode = function() {
      $('.btn-dark').addClass('btn-white').removeClass('btn-dark');
    }

    var hasMode = Cookies.get('df-mode');
    if(hasMode === 'dark') {
      darkMode();
    } else {
      lightMode();
    }
  });

</script>

<script>
    // Initialize Select2 on the #jobSelect element for multi-select with tags
    $(document).ready(function() {
        $('#jobSelect').select2({
            placeholder: 'Select Job',
            allowClear: true
        });
        
        // Fetch jobs and populate the dropdown when the page loads
        const jobSelectElement = document.getElementById('jobSelect');
        fetchJobs(jobSelectElement);
    });

    function fetchJobs(selectElement) {
       var data="http://localhost/projects/PHPNation/applications/api-requests/fetch_jobs_api.php"
        fetch(data) // Adjust the path to your fetch_jobs.php file
            .then(response => response.json())
            .then(data => {
                // Clear previous options
                selectElement.innerHTML = '';
                
                // Populate the dropdown with job titles and ids
                data.jobs.forEach(job => {
                    const option = document.createElement('option');
                    option.value = job.id;  // Use job ID as the value
                    option.text = job.title; // Display job title
                    selectElement.add(option);
                });
            })
            .catch(error => console.error('Error fetching jobs:', error));
    }
    </script>
</body>
</html>
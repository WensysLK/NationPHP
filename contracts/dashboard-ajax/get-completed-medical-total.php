<script>
// Function to fetch application count
function fetchcommediCount() {
    $.ajax({
        url: 'dashboard-kpi/get_completed_medicals.php', // The PHP script
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // Update the widgets with the fetched counts
            $('#totalcompletedmedicals').text(response.completed_medical_count || '0');
            $('#totalpenpaydmedicals').text(response.finance_medicomp_count || '0');
            $('#totalbookedmedicals').text(response.booked_medical_count || '0');
            $('#totalunfitmedicals').text(response.unfit_medical_count || '0');
            $('#totalguranteemedicals').text(response.finance_medical_count || '0');
        },
        error: function() {
            $('#totalcompletedmedicals').text('Error loading data');
            $('#totalpenpaydmedicals').text('Error loading data');
            $('#totalbookedmedicals').text('Error loading data');
            $('#totalunfitmedicals').text('Error loading data');
            $('#totalguranteemedicals').text('Error loading data');
        }
    });
}

// Call the function when the page loads
$(document).ready(function() {
    fetchcommediCount();
});
</script>
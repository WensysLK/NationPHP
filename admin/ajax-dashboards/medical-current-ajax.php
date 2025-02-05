<script>
// Function to fetch application count
function fetchmedicalCount() {
    $.ajax({
        url: 'dashboard-kpi/get_medical_applications.php', // The PHP script
        method: 'GET',
        dataType: 'json',
        success: function($responsemedical) {
            // Update the widget with the fetched count
            $('#currentmedical').text($responsemedical.total);
        },
        error: function() {
            $('#currentmedical').text('Error loading data');
        }
    });
}

// Call the function when the page loads
$(document).ready(function() {
    fetchmedicalCount();
});
</script>
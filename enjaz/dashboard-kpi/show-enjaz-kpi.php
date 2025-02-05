<script>
// Function to fetch Enjaz KPI count
function fetchenjazkpiCount() {
    $.ajax({
        url: 'dashboard-kpi/get-enjaz-kpi.php', // The PHP script
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // Update the widget with the Enjaz completed count
            $('#totalcompletedenjaz').text(response.enjaz_completed_count || '0');
            $('#totalpendingenjaz').text(response.enjaz_completed_count || '0');
            $('#totalbookedenjaz').text(response.enjaz_booked_count || '0');
        },
        error: function() {
            $('#totalcompletedenjaz').text('Error loading data');
            $('#totalpendingenjaz').text('Error loading data');
            $('#totalbookedenjaz').text('Error loading data');
        }
    });
}

// Call the function when the page loads
$(document).ready(function() {
    fetchenjazkpiCount();
});
</script>

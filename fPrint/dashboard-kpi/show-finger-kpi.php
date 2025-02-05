<script>
// Function to fetch fingerprint KPI count
function fetchfingerkpiCount() {
    $.ajax({
        url: 'dashboard-kpi/get-finger-kpi.php', // The PHP script for fingerprint data
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // Update the widget with the fingerprint counts
            $('#totalcompletedfinger').text(response.finger_completed_count || '0');
            $('#totalpendingfinger').text(response.finger_pending_count || '0');
            $('#totalbookedfinger').text(response.finger_booked_count || '0');
        },
        error: function() {
            $('#totalcompletedfinger').text('Error loading data');
            $('#totalpendingfinger').text('Error loading data');
            $('#totalbookedfinger').text('Error loading data');
        }
    });
}

// Call the function when the page loads
$(document).ready(function() {
    fetchfingerkpiCount();
});
</script>

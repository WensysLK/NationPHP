<script>
// Function to fetch application count
function fetchApplicationCount() {
    $.ajax({
        url: 'dashboard-kpi/get_pending_application.php', // The PHP script
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // Update the widget with the fetched count
            $('#pendingcount').text(response.total);
        },
        error: function() {
            $('#pendingcount').text('Error loading data');
        }
    });
}

// Call the function when the page loads
$(document).ready(function() {
    fetchApplicationCount();
});
</script>
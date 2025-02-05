<script>
// Function to fetch application count
function fetchmuzanedCount() {
    $.ajax({
        url: 'dashboard-kpi/get_muzaned_applications.php', // The PHP script
        method: 'GET',
        dataType: 'json',
        success: function($responsemuzaned) {
            // Update the widget with the fetched count
            $('#muzanedpro').text($responsemuzaned.total);
        },
        error: function() {
            $('#muzanedpro').text('Error loading data');
        }
    });
}

// Call the function when the page loads
$(document).ready(function() {
    fetchmuzanedCount();
});
</script>
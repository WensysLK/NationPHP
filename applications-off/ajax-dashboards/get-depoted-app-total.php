<script>
// Function to fetch application count
function fetchavailappdepotadCount() {
    $.ajax({
        url: 'dashboard-kpi/get-departure-count.php', // The PHP script
        method: 'GET',
        dataType: 'json',
        success: function($resultappdepoted) {
            // Update the widget with the fetched count
            $('#deportedcount').text($resultappdepoted.total);
        },
        error: function() {
            $('#deportedcount').text('Error loading data');
        }
    });
}

// Call the function when the page loads
$(document).ready(function() {
    fetchavailappdepotadCount();
});
</script>
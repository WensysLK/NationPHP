<script>
// Function to fetch application count
function fetchavailappdepartureCount() {
    $.ajax({
        url: 'dashboard-kpi/get-departure-count.php', // The PHP script
        method: 'GET',
        dataType: 'json',
        success: function($responseappdeparturecount) {
            // Update the widget with the fetched count
            $('#departurecount').text($responseappdeparturecount.total);
        },
        error: function() {
            $('#departurecount').text('Error loading data');
        }
    });
}

// Call the function when the page loads
$(document).ready(function() {
    fetchavailappdepartureCount();
});
</script>
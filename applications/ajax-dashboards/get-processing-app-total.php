<script>
// Function to fetch application count
function fetchavailappprocessingCount() {
    $.ajax({
        url: 'dashboard-kpi/get-processing-count.php', // The PHP script
        method: 'GET',
        dataType: 'json',
        success: function($responseappprocesscount) {
            // Update the widget with the fetched count
            $('#processingcount').text($responseappprocesscount.total);
        },
        error: function() {
            $('#processingcount').text('Error loading data');
        }
    });
}

// Call the function when the page loads
$(document).ready(function() {
    fetchavailappprocessingCount();
});
</script>
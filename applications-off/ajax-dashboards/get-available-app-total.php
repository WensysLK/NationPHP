<script>
// Function to fetch application count
function fetchavailappCount() {
    $.ajax({
        url: 'dashboard-kpi/get-application-count.php', // The PHP script
        method: 'GET',
        dataType: 'json',
        success: function($responseappcount) {
            // Update the widget with the fetched count
            $('#availableapp').text($responseappcount.total);
        },
        error: function() {
            $('#availableapp').text('Error loading data');
        }
    });
}

// Call the function when the page loads
$(document).ready(function() {
    fetchavailappCount();
});
</script>
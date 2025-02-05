<script>
// Function to fetch application count
function fetchavailappicCount() {
    $.ajax({
        url: 'dashboard-kpi/get-incomplete-count.php', // The PHP script
        method: 'GET',
        dataType: 'json',
        success: function($responseappiccount) {
            // Update the widget with the fetched count
            $('#incompeleteapp').text($responseappiccount.total);
        },
        error: function() {
            $('#incompeleteapp').text('Error loading data');
        }
    });
}

// Call the function when the page loads
$(document).ready(function() {
    fetchavailappicCount();
});
</script>
<script>
// Function to fetch application count
function fetchenjazCount() {
    $.ajax({
        url: 'dashboard-kpi/get_enjaz_applications.php', // The PHP script
        method: 'GET',
        dataType: 'json',
        success: function($responseenjaz) {
            // Update the widget with the fetched count
            $('#enjazpro').text($responseenjaz.total);
        },
        error: function() {
            $('#enjazpro').text('Error loading data');
        }
    });
}

// Call the function when the page loads
$(document).ready(function() {
    fetchenjazCount();
});
</script>
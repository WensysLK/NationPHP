<script>
// Function to fetch application count
function fetchcontractCount() {
    $.ajax({
        url: 'dashboard-kpi/get_contracts_applications.php', // The PHP script
        method: 'GET',
        dataType: 'json',
        success: function($responsecontract) {
            // Update the widget with the fetched count
            $('#contractspro').text($responsecontract.total);
        },
        error: function() {
            $('#contractspro').text('Error loading data');
        }
    });
}

// Call the function when the page loads
$(document).ready(function() {
    fetchcontractCount();
});
</script>
<!-- Display jobs -->
<h4>Applied Jobs</h4>
<label for="jobSelect">Select Jobs:</label>
<select id="jobSelect" name="job_ids[]" multiple="multiple" style="width: 300px;">
    <!-- Options will be populated by JavaScript -->
</select>

<script>
// Fetch jobs and populate the dropdown when the page loads
const jobSelectElement = document.getElementById('jobSelect');
fetchJobs(jobSelectElement);

function fetchJobs(selectElement) {
    fetch('./api-requests/fetch_jobs_api.php') // Adjust the path to your fetch_jobs.php file
        .then(response => response.json())
        .then(data => {
            // Clear previous options
            selectElement.innerHTML = ''; // Remove default 'Select Job' option

            // Populate the dropdown with job titles and ids
            data.jobs.forEach(job => {
                const option = document.createElement('option');
                option.value = job.id; // Use job ID as the value
                option.text = job.title; // Display job title
                selectElement.add(option);
            });
        })
        .catch(error => console.error('Error fetching jobs:', error));
}
</script>
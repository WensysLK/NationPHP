document.getElementById('findUs').addEventListener('change', function() {
    const subAgentField = document.getElementById('subAgentField');
    if (this.value === 'subAgent') {
        subAgentField.style.display = 'block';
    } else {
        subAgentField.style.display = 'none';
    }
});

// Handle the search functionality
document.getElementById('subAgentSearch').addEventListener('input', function() {
    const query = this.value.trim();

    if (query.length > 2) {
        // Perform an AJAX request to search subagents
        fetch(`form-functions/search-fucntions/search-agent.php?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                const suggestionsContainer = document.getElementById('subAgentSuggestions');
                suggestionsContainer.innerHTML = ''; // Clear previous suggestions

                if (data.length > 0) {
                    data.forEach(agent => {
                        const suggestionItem = document.createElement('a');
                        suggestionItem.className = 'list-group-item list-group-item-action';
                        suggestionItem.textContent = `${agent.name} (${agent.nic})`;
                        suggestionItem.href = 'javascript:void(0);';
                        suggestionItem.onclick = function() {
                            // Fill the hidden subAgentId field with the selected agent's ID
                            document.getElementById('subAgentId').value = agent.id;
                            document.getElementById('subAgentSearch').value = agent.name;
                            suggestionsContainer.innerHTML = ''; // Clear the suggestions
                        };
                        suggestionsContainer.appendChild(suggestionItem);
                    });
                    document.getElementById('addNewSubagentBtn').style.display = 'none'; // Hide "Add New" button
                } else {
                    // Show the "Add New Subagent" button if no agents were found
                    document.getElementById('addNewSubagentBtn').style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error fetching subagents:', error);
                alert('An error occurred while searching. Please try again.');
            });
    } else {
        // Hide the suggestions if the query is too short
        document.getElementById('subAgentSuggestions').innerHTML = '';
        document.getElementById('addNewSubagentBtn').style.display = 'none';
    }
});
//date of birth calculation registration form
document.getElementById('dob').addEventListener('change', calculateAge);

        function calculateAge() {
            const dob = new Date(document.getElementById('dob').value);
            const today = new Date();
            const ageInMilliseconds = today - dob;

            const years = Math.floor(ageInMilliseconds / (365.25 * 24 * 60 * 60 * 1000));
            const remainingMonths = Math.floor((ageInMilliseconds % (365.25 * 24 * 60 * 60 * 1000)) / (30.44 * 24 * 60 *
                60 * 1000));
            const remainingDays = Math.floor((ageInMilliseconds % (30.44 * 24 * 60 * 60 * 1000)) / (24 * 60 * 60 *
                1000));

            document.getElementById('ageDisplay').innerHTML = `Age: ${years}Y, ${remainingMonths}M, ${remainingDays}D`;
        }
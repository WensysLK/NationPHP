// Hight Calculation Javascript Function 
function convertHeight() {
    var feet = parseFloat(document.getElementById('heightFeet')
        .value) || 0;
    var resultHeight = document.getElementById('resultHeight');

    var heightInCm = (feet * 30.48);

    if (!isNaN(heightInCm)) {
        resultHeight.innerHTML =
            `Height in cm: ${heightInCm.toFixed(2)} cm`;
        resultHeight.style.display = 'block';
    } else {
        resultHeight.style.display = 'none';
    }
}

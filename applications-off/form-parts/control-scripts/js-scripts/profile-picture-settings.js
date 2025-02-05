// Profile Image handling
document.addEventListener('DOMContentLoaded', () => {
    const profileImageInput = document.getElementById('profileImageInput');
    const profileImage = document.getElementById('profileImage');
    const openCameraButton = document.getElementById('openCameraButton');
    const cameraPreview = document.getElementById('cameraPreview');
    let stream;

    // Function to handle file input change and preview
    profileImageInput.addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profileImage.src = e.target.result; // Update image preview
            }
            reader.readAsDataURL(file); // Convert file to data URL for preview
        }
    });

    // Function to open camera and take a photo
    openCameraButton.addEventListener('click', async () => {
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            try {
                stream = await navigator.mediaDevices.getUserMedia({ video: true });
                cameraPreview.srcObject = stream;
                cameraPreview.style.display = 'block';
                cameraPreview.play();

                // Add capture button if not already present
                if (!document.getElementById('takePhotoButton')) {
                    const takePhotoButton = document.createElement('button');
                    takePhotoButton.type = 'button';
                    takePhotoButton.id = 'takePhotoButton';
                    takePhotoButton.innerText = 'Capture Photo';
                    takePhotoButton.addEventListener('click', capturePhoto);
                    openCameraButton.parentElement.appendChild(takePhotoButton);
                }
            } catch (error) {
                console.error('Error accessing the camera: ', error);
                alert('Could not access the camera. Please allow camera access.');
            }
        } else {
            alert('Camera not supported on this device or browser.');
        }
    });

    // Function to capture the photo from the video stream
    const capturePhoto = () => {
        const canvas = document.createElement('canvas');
        canvas.width = cameraPreview.videoWidth;
        canvas.height = cameraPreview.videoHeight;
        const context = canvas.getContext('2d');
        context.drawImage(cameraPreview, 0, 0, canvas.width, canvas.height);

        // Update the profile image with the captured photo
        const base64Image = canvas.toDataURL('image/png');
        profileImage.src = base64Image; // Update the preview image

        // Stop the video stream
        stream.getTracks().forEach(track => track.stop());
        cameraPreview.style.display = 'none';

        const takePhotoButton = document.getElementById('takePhotoButton');
        if (takePhotoButton) {
            takePhotoButton.remove();
        }

        // Create a hidden input to send the captured image as base64 to the server
        const capturedPhotoInput = document.createElement('input');
        capturedPhotoInput.type = 'hidden';
        capturedPhotoInput.name = 'capturedPhoto';
        capturedPhotoInput.value = base64Image;
        document.querySelector('form').appendChild(capturedPhotoInput);
    };
});

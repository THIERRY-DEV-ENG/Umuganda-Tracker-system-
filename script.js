let photoCount = 0; 
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const previewArea = document.getElementById('previewArea');
const waitMessage = document.getElementById('waitMessage');
const photoDataInput = document.getElementById('photo_data');
let lastCaptureTime = localStorage.getItem('lastCaptureTime') ? parseInt(localStorage.getItem('lastCaptureTime')) : 0;


photoCount = parseInt('<?php echo $photo_count; ?>', 10);


navigator.geolocation.getCurrentPosition(
    (position) => {
        document.getElementById('gps_coords').value = `${position.coords.latitude},${position.coords.longitude}`;
        document.getElementById('gpsStatus').textContent = `📍 Location: ${position.coords.latitude.toFixed(4)}, ${position.coords.longitude.toFixed(4)}`;
        document.getElementById('gpsStatus').style.color = '#00A651';
    },
    (error) => {
        document.getElementById('gpsStatus').textContent = '❌ GPS access denied!';
        document.getElementById('gpsStatus').style.color = '#EF3340';
    }
);


if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
        })
        .catch(err => {
            console.error("Camera error: ", err);
            document.getElementById('gpsStatus').textContent = '❌ Camera access denied!';
            document.getElementById('gpsStatus').style.color = '#EF3340';
        });
}


document.getElementById('captureBtn').addEventListener('click', () => {
    const now = Date.now();
    if (photoCount >= 2) {
        alert("You’ve taken the maximum 2 photos.");
        return;
    }
    if (lastCaptureTime && (now - lastCaptureTime) < 60000) { 
        const waitTime = Math.ceil((60000 - (now - lastCaptureTime)) / 60000);
        waitMessage.textContent = `Please wait ${waitTime} minute(s) for the next photo.`;
        return;
    }
    const context = canvas.getContext('2d');
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    const photoData = canvas.toDataURL('image/jpeg');
    photoCount++;
    const preview = document.createElement('img');
    preview.src = photoData;
    previewArea.appendChild(preview);
    if (photoDataInput.value) {
        photoDataInput.value += '|' + photoData;
    } else {
        photoDataInput.value = photoData;
    }
    lastCaptureTime = now;
    localStorage.setItem('lastCaptureTime', lastCaptureTime);
    if (photoCount < 2) {
        waitMessage.textContent = "Wait 1 minute for the next photo.";
    } else {
        waitMessage.textContent = "Both photos captured. Submit when ready.";
        document.getElementById('submitBtn').disabled = false;
    }
});
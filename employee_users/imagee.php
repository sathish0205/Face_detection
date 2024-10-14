<html>
    <body>
        <img src="DAHANA1.jpg" id="myImg1">
        <img src="NAMMA.jpg" id="myImg2">
        <script src="https://cdn.jsdelivr.net/npm/@teklab/face-api@0.22.3/dist/face-api.min.js"></script>
        <script>
            // Wait for the face-api library to load
            document.addEventListener("DOMContentLoaded", async function() {
                await faceapi.nets.ssdMobilenetv1.loadFromUri('/models');
                await faceapi.nets.faceLandmark68Net.loadFromUri('/models');
                await faceapi.nets.faceRecognitionNet.loadFromUri('/models');

                const input1 = document.getElementById('myImg1');
                const input2 = document.getElementById('myImg2');

                const detection1 = await faceapi.detectSingleFace(input1).withFaceLandmarks().withFaceDescriptor();
                const detection2 = await faceapi.detectSingleFace(input2).withFaceLandmarks().withFaceDescriptor();

                if (detection1 && detection2) {
                    const descriptor1 = detection1.descriptor;
                    const descriptor2 = detection2.descriptor;

                    const distance = faceapi.euclideanDistance(descriptor1, descriptor2);

                    alert(distance);
                } else {
                    alert('One or both faces could not be detected');
                }
            });
        </script>
    </body>
</html>

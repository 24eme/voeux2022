<?php 

require __DIR__.'/config.inc.php'; 

?>
<!doctype html>
<html lang="fr_FR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
        <meta name="mobile-web-app-capable" content="yes">
    </head>
    <body style="margin: 0; padding: 0; overflow-x: hidden;">
        <div id="block_presentation" class="container text-center">
            <div class="row">
                <div class="col-md-6 offset-md-3 col-lg-4 offset-lg-4 pt-4 pb-4">
                    <h2>Pour finaliser votre affiche</h2>
                    <p class="lead pt-4">Une photo</p>
                    <div class="d-grid gap-2 mt-4">
                        <button id="btn-start" class="btn btn-primary d-block" type="button">Démarrer l'appareil photo</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="block_camera" class="d-none">
            <div style="position: relative; margin: 0; padding: 0; overflow: hidden;">
            <video id="camera" style="margin: 0; padding: 0; width: 100%;" autoplay playsinline></video>
            <img id="photo" src="" style="position: absolute; top: 0; left: 0; margin: 0; padding: 0;" />
            <img id="tenue" src="tenue/<?php echo $tenue ?>" style="width: 200%; position: absolute; bottom: 0; left: -50%; margin: 0; padding: 0;" />
            </div>
            <div class="fixed-bottom bg-light p-2" style="z-index: 9999;">
                <div class="container">
                    <div id="block-btn-photo" class="d-grid gap-2">
                        <button id="btn-take" class="btn btn-primary d-block" type="button"><i class="bi bi-camera-fill"></i> Prendre la photo</button>
                    </div>
                    <div id="block-loading" class="d-none text-center">
                        <div class="spinner-grow text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <form id="form_camera" action="photo.php?csv=<?php echo $GET['csv'] ?>" method="POST" enctype="multipart/form-data">
                        <div id="block-btn-confirmation" class="d-none row">
                            <div class="d-grid gap-2 col-6">
                                <button id="btn-cancel" class="btn btn-outline-danger" type="button">Recommencer</button>
                            </div>
                            <div class="d-grid gap-2 col-6">
                                <button class="btn btn-success" type="submit">Confirmer</button>
                            </div>
                        </div>
                        <input id="input_camera" name="camera" style="width: 100%; margin: 0; padding: 0; position: fixed; bottom: 20px; display:none;" type="file" />
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var video = document.querySelector('#camera');
            var photo = document.querySelector('#photo');
            var constraints = window.constraints = {
              audio: false,
              video: { facingMode: "user" }
            };
            var streaming = false
            var width = 1800;
            var height = 0;

            document.querySelector('#btn-start').addEventListener('click', function() {
                navigator.mediaDevices.getUserMedia(constraints)
                .then(function(stream) {
                  window.stream = stream;
                  video.srcObject = stream;
                  video.onloadedmetadata = function (e) {
                    video.play()
                  }
                })
                .catch(function(error) {
                  if (error.name === 'ConstraintNotSatisfiedError') {
                    alert('The resolution ' + constraints.video.width.exact + 'x' +
                        constraints.video.height.exact + ' px is not supported by your device.');
                  } else if (error.name === 'PermissionDeniedError') {
                    alert('Permissions have not been granted to use your camera and ' +
                      'microphone, you need to allow the page access to your devices in ' +
                      'order for the demo to work.');
                  } else {
                      alert('getUserMedia error: ' + error.name, error);
                  }
                });
            });

            video.addEventListener('canplay', function(ev){
                if (streaming) {
                  return;
                }
                
                document.querySelector('#block_presentation').classList.add('d-none');
                document.querySelector('#block_camera').classList.remove('d-none');
                document.body.classList.add('bg-dark');

                height = video.videoHeight / (video.videoWidth/width);
                var ratio = video.videoHeight / video.videoWidth;
                video.style.height = video.clientWidth * ratio+"px";
                video.setAttribute('width', width);
                video.setAttribute('height', height);
                streaming = true;
                document.querySelector('#tenue').style.bottom = "-"+document.querySelector('#tenue').clientHeight * 0.45+"px";
            }, false);
            document.querySelector('#btn-take').addEventListener('click', function(ev){
                document.getElementById('block-btn-photo').classList.add('d-none');
                document.getElementById('block-loading').classList.remove('d-none');
                setTimeout(function() { takepicture() }, 100);
                ev.preventDefault();
            }, false);
            document.querySelector('#btn-cancel').addEventListener('click', function() {
                document.getElementById('block-btn-confirmation').classList.add('d-none');
                document.getElementById('block-btn-photo').classList.remove('d-none');
                photo.src = "";
                photo.style.height = 0;
                photo.style.width = 0;
            });

            function dataURLtoBlob(dataurl) {
                var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
                    bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
                while(n--){
                    u8arr[n] = bstr.charCodeAt(n);
                }
                return new Blob([u8arr], {type:mime});
            };

            function takepicture() {
                let canvasBuffer = document.createElement('canvas');
                canvasBuffer.width = video.width;
                canvasBuffer.height = video.height;
                canvasBuffer.getContext('2d').drawImage(video, 0, 0, width, height);
                photo.setAttribute('src', canvasBuffer.toDataURL('image/png'));
                photo.style.width = video.style.width;
                photo.style.height = video.style.height;
                let filename = "camera.png";
                let dataTransfer = new DataTransfer();
                dataTransfer.items.add(new File([dataURLtoBlob(photo.src)], filename, {
                    type: 'image/png'
                }));
                document.getElementById('input_camera').files = dataTransfer.files;
                document.getElementById('block-btn-confirmation').classList.remove('d-none');
                document.getElementById('block-loading').classList.add('d-none');
            }
        </script>
    </body>    
</html>

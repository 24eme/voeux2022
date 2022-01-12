'use strict';

// Put variables in global scope to make them available to the browser console.
var video = document.querySelector('#camera');
var photo = document.querySelector('#photo');
var constraints = window.constraints = {
  audio: false,
  video: true
};
var startbutton  = document.querySelector('#take')
var errorElement = document.querySelector('#errorMsg');
var streaming = false
var width = 1700;
var height = 0;
var fabricImage = null;

navigator.mediaDevices.getUserMedia(constraints)
.then(function(stream) {
  var videoTracks = stream.getVideoTracks();
  console.log('Got stream with constraints:', constraints);
  console.log('Using video device: ' + videoTracks[0].label);
  stream.onremovetrack = function() {
    console.log('Stream ended');
  };
  window.stream = stream; // make variable available to browser console
  video.srcObject = stream;
  video.onloadedmetadata = function (e) {
    video.play()
  }
})
.catch(function(error) {
  if (error.name === 'ConstraintNotSatisfiedError') {
    errorMsg('The resolution ' + constraints.video.width.exact + 'x' +
        constraints.video.height.exact + ' px is not supported by your device.');
  } else if (error.name === 'PermissionDeniedError') {
    errorMsg('Permissions have not been granted to use your camera and ' +
      'microphone, you need to allow the page access to your devices in ' +
      'order for the demo to work.');
  }
  errorMsg('getUserMedia error: ' + error.name, error);
});

video.addEventListener('canplay', function(ev){
  if (!streaming) {
    height = video.videoHeight / (video.videoWidth/width);
    var ratio = video.videoHeight / video.videoWidth;
    console.log(ratio);
    video.style.height = video.clientWidth * ratio+"px";
    console.log(video.style.height);
    video.setAttribute('width', width);
    video.setAttribute('height', height);
    streaming = true;
  }
}, false);

function errorMsg(msg, error) {
  errorElement.innerHTML += '<p>' + msg + '</p>';
  if (typeof error !== 'undefined') {
    console.log(error);
  }
}

function takepicture() {
  var canvasBuffer = document.createElement('canvas');
  canvasBuffer.width = video.width;
  canvasBuffer.height = video.height;
  console.log(video.width);
  canvasBuffer.getContext('2d').drawImage(video, 0, 0, width, height);
  photo.setAttribute('src', canvasBuffer.toDataURL('image/png'));
  photo.style.width = video.style.width;
  photo.style.height = video.style.height;
}

startbutton.addEventListener('click', function(ev){
  takepicture();
  ev.preventDefault();
}, false);

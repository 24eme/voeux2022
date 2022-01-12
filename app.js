'use strict';

// Put variables in global scope to make them available to the browser console.
var video = document.querySelector('video');
var photo = document.querySelector('#photo');
var photo_resultat = document.querySelector('#photo_resultat');
var canvas = new fabric.Canvas('portrait');
var constraints = window.constraints = {
  audio: false,
  video: true
};
var startbutton  = document.querySelector('#startbutton')
var errorElement = document.querySelector('#errorMsg');
var streaming = false
var width = 600
var height = 0
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
    video.setAttribute('width', width);
    video.setAttribute('height', height);
    streaming = true;
  }
}, false);

function errorMsg(msg, error) {
  errorElement.innerHTML += '<p>' + msg + '</p>';
  if (typeof error !== 'undefined') {
    console.error(error);
  }
}

function takepicture() {
  var canvasBuffer = document.createElement('canvas');
  canvasBuffer.width = width;
  canvasBuffer.height = height;
  canvasBuffer.getContext('2d').drawImage(video, 0, 0, width, height);
  photo.width = width;
  photo.height = height;
  photo.setAttribute('src', canvasBuffer.toDataURL('image/png'));
  var canvasHTML = document.querySelector('#portrait');
  canvasHTML.width = width;
  canvasHTML.height = height;
  canvas.setHeight(350);
  canvas.setWidth(250);
  video.style.opacity = 0.5;
  document.querySelector('#zoom').value = 65;
  canvas.remove(canvas.getObjects()[0]);
  fabricImage = new fabric.Image.fromURL(canvasBuffer.toDataURL('image/png'), function(img) {
    canvas.add(img);
    canvas.centerObject(canvas.getObjects()[0]);
  });
}

startbutton.addEventListener('click', function(ev){
  takepicture();
  ev.preventDefault();
}, false);

document.querySelector('#save').addEventListener('click', function(ev) {
  photo_resultat.src = canvas.toDataURL({
        format: 'png',
        quality: 1
  });
})

document.querySelector('#reset').addEventListener('click', function(ev) {
  canvas.remove(canvas.getObjects()[0]);
  video.style.opacity = 1;
})

document.querySelector('#zoom').addEventListener('change', function(ev) {
  canvas.getObjects()[0].scale(this.value/50);
  canvas.centerObject(canvas.getObjects()[0]);
  canvas.renderAll();
})

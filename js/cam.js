  
function $(elem) {
         return document.querySelector(elem);
     }
 
var canvas = $('canvas'),
     context = canvas.getContext('2d'),
     video = $('video'),
     snap = $('#snap'),
     close = $('#close'),
     upload = $('#upload'),
     uploaded = $('#uploaded'),
     dog = $('#dog'),
     cat = $('#cat'),
     fox = $('#fox'),
     stream;

var dog_img = new Image();
var fox_img = new Image();
var cat_img = new Image();

dog_img.style.display = "none";
dog_img.src = "../img/dog.png";

cat_img.style.display = "none";
cat_img.src = "../img/cat.png";

fox_img.style.display = "none";
fox_img.src = "../img/fox.png";

navigator.getUserMedia = ( navigator.getUserMedia ||
                       navigator.webkitGetUserMedia ||
                       navigator.mozGetUserMedia ||
                       navigator.msGetUserMedia);

navigator.getUserMedia({audio: false, video: true},
    function(stream) {
      steam = stream;
      track = stream.getTracks()[0];
      video.src = window.URL.createObjectURL(stream);
      video.play();
    },
function(error) {
console.log('getUserMedia() error', error);
});

// take a shot
snap.addEventListener('click', function() {
    context.drawImage(video, 0, 0, 400, 300);
}, false);

//add image
dog.addEventListener('click', function() {
    context.drawImage(dog_img, 50, 30, 200, 150);
}, false);
cat.addEventListener('click', function() {
    context.drawImage(cat_img, 50, 30, 200, 150);
}, false);
fox.addEventListener('click', function() {
    context.drawImage(fox_img, 50, 30, 200, 150);
}, false);

// close cam
close.addEventListener('click', function() {
    track.stop();
}, false);

//upload
upload.addEventListener('click', function() {
jQuery.post('../php/save_img.php', {
     snapData: canvas.toDataURL('image/png')
 }).done(function(rs) {
     console.log(rs);
 }).fail(function(err) {
     console.log(err);
 });
}, false);

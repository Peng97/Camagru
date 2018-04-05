  
function $(elem) {
         return document.querySelector(elem);
     }
 
var canvas = $('canvas'),
     context = canvas.getContext('2d'),
     video = $('video'),
     snap = $('#snap'),
     clean = $('#clean'),
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

    upload.addEventListener('click', function() {
    jQuery.post('../php/save_img.php', {
         data: canvas.toDataURL('image/png')
     }).done(function(rs) {
        location.reload();
     }).fail(function(err) {
         console.log(err);
     });
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

}, false);

//upload file
var preview = document.getElementById('upfile');

// clean cam
clean.addEventListener('click', function() {
    context.clearRect(0, 0, canvas.width, canvas.height);
}, false);

function previewFile() {
  var file    = document.querySelector('input[type=file]').files[0];
  var reader  = new FileReader();


  reader.addEventListener("load", function () {
    preview.src = reader.result;

    preview.onload = function() {
        context.drawImage(preview, 1, 1, 400, 300);

        upload.addEventListener('click', function() {
        jQuery.post('../php/save_img.php', {
             data: canvas.toDataURL('image/png')
         }).done(function(rs) {
            location.reload();
         }).fail(function(err) {
             console.log(err);
         });
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
    }


  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
}
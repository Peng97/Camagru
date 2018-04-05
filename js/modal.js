
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.querySelectorAll("[id='icon']");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var img_modal = document.getElementById("img_modal");
var send = document.getElementById("send");
var comm = document.getElementById("comment");
var comment_list = document.getElementById("comment_list");
var remove = document.getElementById("remove");
var more = document.getElementById("more");
var less = document.getElementById("less");
var like = document.getElementById("like");

// partie modal 
var img_id;
var owner_id;  // these value will be init once user click on one of image of gallery
var is_owner; 
var img_path;
var username;
var nblike;

$( document ).ready(function() {
  for (var i=0; i < btn.length; i++) {
    btn[i].onclick = showModal;
  }
});

// show comments..

function getcomm() {

    jQuery.post( "../php/comment_list.php",{
      img_id : img_id
    }).done(function(rs) {
      rs = rs.split("\n");

      var i = 1;
      while (++i < rs.length - 2)
      {
        rs[i] = rs[i].split(" => ");

        var para = document.createElement("p");
        var node = document.createTextNode(rs[i][1]);
        para.appendChild(node);

        comment_list.appendChild(para);
      }
    });
}

//get number of total like
function getlike() {
    jQuery.post( "../php/like_nb.php",{
      img_id : img_id
    }).done(function(rs) {
      nblike = Number(rs);
      like.innerHTML = nblike + " like";
    });
}

function showModal(event) {
  modal.style.display = "block";
  img_modal.src = (event.srcElement && event.srcElement.src) || (event.target && event.target.src);

  jQuery.post('../php/check.php', {  //check if user is owner of this image
     data: img_modal.src
    }).done(function(rs) {

      rs = rs.split("\n");
      owner_id = (rs[2].split("[userid] => "))[1];
      img_id = (rs[4].split("[id] => "))[1];
      is_owner = (rs[6].split("[is_owner] => "))[1];  //split & save needed value
      img_path = (rs[7].split("[imgpath] => "))[1];
      username = (rs[8].split("[username] => "))[1];

      getcomm();
      getlike();
     if (is_owner == 1){
          remove.style.display = "block";  // display remove button if user=owner

          remove.onclick = function() {
            jQuery.post('../php/remove.php', {
                path: img_path,
                id: img_id
            });
            location.reload();
          }
    }
 });
}

if (send != null)
{
  send.onclick = function() {

  	jQuery.post( "../php/comment.php",{
      comm : comm.value,
      img_id : img_id,
      owner_id : owner_id,
      path : img_path
    }).done(function(rs) {
          var para = document.createElement("p");
          var node = document.createTextNode(username + " : " + comm.value);
          para.appendChild(node);

          comment_list.appendChild(para);    
          comm.value = "";
    });
  }


like.onclick = function (argument) {
    jQuery.post( "../php/like.php",{
      img_id : img_id,
    }).done(function(rs) {
        (Number(rs) == 1 ) ? nblike += 1 : nblike -= 1; 
        like.innerHTML = nblike + " like";
       }
    );
  }
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
    while (comment_list.firstChild) {
      comment_list.removeChild(comment_list.firstChild);
    }
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

if (more != null)
{
  more.onclick = function(event) {
        jQuery.post( "../php/moreorless.php",{
        more : 1,
      }).done(function(rs) {
          location.reload();
         }
      );
  }
}

if (less != null)
{
  less.onclick = function(event) {
      jQuery.post( "../php/moreorless.php",{
        more : -1,
      }).done(function(rs) {
          location.reload();
         }
      );
  }
}


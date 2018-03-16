
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.querySelectorAll("[id='icon']");;

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var img_modal = document.getElementById("img_modal");
var send = document.getElementsByClassName("send");

document.getElementById("like").innerHTML = "0 like";

for (var i=0; i < btn.length; i++) {
  btn[i].onclick = showModal;
}

function showModal(event) {
  modal.style.display = "block";
  img_modal.src = (event.srcElement && event.srcElement.src) || (event.target && event.target.src);  
  imageSelected = (event.srcElement && event.srcElement.src) || (event.target && event.target.src);
}

if (send.length != 0)
{
	send[0].onclick = function() {
		console.log(send);
	}
} 

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
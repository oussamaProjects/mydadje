function log($msg) {
    console.log($msg);
}

var toggler = document.getElementsByClassName("open-folder");
var i;

for (i = 0; i < toggler.length; i++) {
    toggler[i].addEventListener("click", function() {
        this.parentElement.querySelector(".nested").classList.toggle("hide");
        // this.classList.toggle("hidden");
        // this.nextSibling.cla ssList.toggle("hidden");
        // log(this.nextSibling);
    });
}

// var closeFolder = document.getElementsByClassName("close-folder");
// closeFolder.addEventListener("click", function() {
//     this.parentElement.querySelector(".nested").classList.remove("hide");
// });
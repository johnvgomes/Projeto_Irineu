  //  When the HTML elements load, call init()
        document.addEventListener("DOMContentLoaded", init, false);
       
        //  Rotate the video by 30degrees when image is clicked
        function init() {
          var video = document.getElementById("theVideo");
          if (video) {
            var rotateVal = 0;       //  Global variable to hold current rotation value
            document.getElementById("rotateVideo").addEventListener("click", function () {
              rotateVal = (rotateVal += 30) % 360;  // Calculate the next value, but keep between 0 and 360
              var temp = "rotate(" + rotateVal + "deg)"; // Create a style string
              document.getElementById("theVideo").style.msTransform = temp;  // Set the style
            }, false);
          }
        }
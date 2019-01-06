var imgArray = ["IMG_8905.JPG", "IMG_8906.JPG", "IMG_8907.JPG","IMG_8912.JPG","IMG_8913.JPG","IMG_8914.JPG" ];
var imhIndex = 0;
var img = document.getElementById('img');

function changeImg(){
    img.setAttribute("src",imgArray[imhIndex]);
    imhIndex++;

    if(imhIndex >= imgArray.length){
        imhIndex = 0;
    }
}
setInterval(changeImg, 2000);
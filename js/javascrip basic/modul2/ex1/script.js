window.onload = int;
var canvas, ctx;
function int(){
    canvas = document.querySelector("#myCanvas");
    ctx = canvas.getContext('2d');
    ctx.fillStyle = 'red';
    ctx.fillRect(10,10,30,30);
    
    ctx.strokeStyle = 'green';
    ctx.lineWidth = 5;
    ctx.strokeRect(100,40,40,40);

    ctx.beginPath();
    ctx.arc(60,60,10,0,2*Math.PI);
    ctx.fill();

    ctx.fillStyle = 'purple';
    ctx.font = "20px Arial";
    ctx.fillText("Hello", 60, 20);
}   
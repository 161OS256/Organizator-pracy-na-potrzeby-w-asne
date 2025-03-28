<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <title>Podpis</title>
 
   <script type="text/javascript" src="jquery.js"></script>

</head>
 
<body>
<?php include('conect.php'); 
 if ($_GET['akcja']=='zidp') {
 $zidp = $_GET['idp'];
 $pdo->exec("update temp set idp='$zidp'");
 }
?>
<div>
		<div style="position: absolute; left: 10px; top: 30px"><canvas id="canvasSignature" width="1000px" height="350px" style="border:2px solid #000000;"></canvas>

<div style="position: absolute; left: 880px; top: 365px"><a href=\cigla/palety.php><button onclick="podpis()"><h1>Zapisz</h1></button></a></div>
<div style="position: absolute; left: 30px; top: 365px"><a href=\cigla/podpis.php><button><h1>Wyczyść</h1></button></a></div>
</div>

 <script type="text/javascript">
	$(document).ready(function () {
		 initialize();
	});

	function getPosition(mouseEvent, sigCanvas) {
		 var x, y;
		 if (mouseEvent.pageX != undefined && mouseEvent.pageY != undefined) {
				x = mouseEvent.pageX;
				y = mouseEvent.pageY;
		 } else {
				x = mouseEvent.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
				y = mouseEvent.clientY + document.body.scrollTop + document.documentElement.scrollTop;
		 }

		 return { X: x - sigCanvas.offsetLeft, Y: y - sigCanvas.offsetTop };
	}

	function initialize() {
		 var sigCanvas = document.getElementById("canvasSignature");
		 var context = sigCanvas.getContext("2d");
		 context.strokeStyle = 'Black';
		 context.lineWidth = 7;
		 context.lineCap = 'round';

		 var is_touch_device = 'ontouchstart' in document.documentElement;

		 if (is_touch_device) {
				var drawer = {
					 isDrawing: false,
					 touchstart: function (coors) {
							context.beginPath();
							context.moveTo(coors.x, coors.y);
							this.isDrawing = true;
					 },
					 touchmove: function (coors) {
							if (this.isDrawing) {
								 context.lineTo(coors.x, coors.y);
								 context.stroke();
							}
					 },
					 touchend: function (coors) {
							if (this.isDrawing) {
								 this.touchmove(coors);
								 this.isDrawing = false;
							}
					 }
				};

				function draw(event) {

					 var coors = {
							x: event.targetTouches[0].pageX,
							y: event.targetTouches[0].pageY
					 };

					 var obj = sigCanvas;

					 if (obj.offsetParent) {
							do {
								 coors.x -= obj.offsetLeft;
								 coors.y -= obj.offsetTop;
							}
							while ((obj = obj.offsetParent) != null);
					 }

					 drawer[event.type](coors);
				}

				sigCanvas.addEventListener('touchstart', draw, false);
				sigCanvas.addEventListener('touchmove', draw, false);
				sigCanvas.addEventListener('touchend', draw, false);

				sigCanvas.addEventListener('touchmove', function (event) {
					 event.preventDefault();
				}, false); 
		 }
		 else {

				$("#canvasSignature").mousedown(function (mouseEvent) {
					 var position = getPosition(mouseEvent, sigCanvas);

					 context.moveTo(position.X, position.Y);
					 context.beginPath();

					 $(this).mousemove(function (mouseEvent) {
							drawLine(mouseEvent, sigCanvas, context);
					 }).mouseup(function (mouseEvent) {
							finishDrawing(mouseEvent, sigCanvas, context);
					 }).mouseout(function (mouseEvent) {
							finishDrawing(mouseEvent, sigCanvas, context);
					 });
				});

		 }
	}

	function drawLine(mouseEvent, sigCanvas, context) {

		 var position = getPosition(mouseEvent, sigCanvas);

		 context.lineTo(position.X, position.Y);
		 context.stroke();
	}

	function finishDrawing(mouseEvent, sigCanvas, context) {

		 drawLine(mouseEvent, sigCanvas, context);

		 context.closePath();

		 $(sigCanvas).unbind("mousemove")
								 .unbind("mouseup")
								 .unbind("mouseout"); }
      
 function podpis() {
 
  var strDataPng = canvasSignature.toDataURL();
 
  var my_url = "png.php";
 
  $.ajax({
    type: "POST",
    url: my_url,
    data: { filecode: strDataPng } } ); } 
 


</script>

</body>
</html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>My Canvas Test</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
<canvas id="canvas1" style="border: 1px solid red" width="<?php echo($width); ?>" height="<?php echo($height); ?>">
</canvas>
<script>
window.jQuery || document.write('<script src="/js/jquery-2.1.3.min.js"><\/script>')
</script>
<script>
var canvas = document.getElementById('canvas1')
var cxt = canvas.getContext('2d')

var $title = $('title'), title = $title.text()
var x, y, dx = 0, dy = 0, ddx = 0, ddy = 0, px = <?php echo($px); ?>, py = <?php echo($py); ?>, scale = <?php echo($scale); ?>

var bx, by
var tick = <?php echo($tick); ?>, timer
var l = 1, pointer = l - 1, ml = <?php echo($ml); ?>, record = []
var $body = $('body')
var started = false
var doTick = function(){
	if (started) {
		// velocity
		dx = dx + ddx
		dy = dy + ddy
		
		// friction
		if (dx > 0) {
			dx -= 1
		} else if (dx < 0) {
			dx += 1
		}
		if (dy > 0) {
			dy -= 1
		} else if (dy < 0) {
			dy += 1
		}
		
		// position
		x = x + dx
		y = y + dy
		
		// bounce
		if (x > bx) {
			x = bx - (x - bx)
			dx = -dx
		} else if (x < 0) {
			x = -x
			dx = -dx
		}
		if (y > by) {
			y = by - (y - by)
			dy = -dy
		} else if (y < 0) {
			y = -y
			dy = -dy
		}
		
		// draw
		if (dx !== 0 || dy !== 0) {
			draw(x / scale, y / scale)
		}
		
		// loop
		timer = setTimeout('doTick()', tick)
	}
}

var toNextPointer = function(pointer){
	var next = pointer + 1
	if (next >= ml) {
		return next - ml
	} else {
		return next
	}
}

var draw = function(x, y){
	if (l < ml) {
		cxt.beginPath()
		cxt.moveTo(record[pointer].x, record[pointer].y)
		pointer = toNextPointer(pointer)
		record[pointer] = new Point(x, y)
		l += 1
		cxt.lineTo(x, y)
		cxt.stroke()
	} else {
		pointer = toNextPointer(pointer)
		
		// clear old line
		cxt.strokeStyle = 'white'
		cxt.lineWidth = 3
		cxt.beginPath()
		var nextPointer = toNextPointer(pointer)
		cxt.moveTo(record[pointer].x, record[pointer].y)
		cxt.lineTo(record[nextPointer].x, record[nextPointer].y)
		cxt.stroke()
		cxt.strokeStyle = 'black'
		cxt.lineWidth = 1
		
		// overwrite with new point and render
		cxt.beginPath()
		record[pointer] = new Point(x, y)
		cxt.moveTo(record[nextPointer].x, record[nextPointer].y)
		for (var i = 0; i < ml - 1; i ++) {
			nextPointer = toNextPointer(nextPointer)
			cxt.lineTo(record[nextPointer].x, record[nextPointer].y)
		}
		cxt.stroke()
	}
	
}

var statusControl = {
	resume: function(){
		started = true
		doTick()
		$title.text(title + ' - running')
	},
	pause: function(){
		started = false
		$title.text(title + ' - paused')
	}
}

var Point = function(x, y){
	this.x = x
	this.y = y
}

var canvasInit = function(){
	bx = $(canvas).width() * scale
	by = $(canvas).height() * scale
	x = Math.round(bx / 2)
	y = Math.round(by / 2)
	cxt.moveTo(x / scale, y / scale)
	record[pointer] = new Point(x / scale, y / scale)
	
	statusControl.resume()
	
	$body.keydown(function(e){
		switch (e.which) {
		case 37: //left
			ddx = -px
			break
		case 38: //up
			ddy = -py
			break
		case 39: //right
			ddx = px
			break
		case 40: //down
			ddy = py
			break
		}
	}).keyup(function(e){
		switch (e.which) {
		case 37: //left
		case 39: //right
			ddx = 0
			break
		case 38: //up
		case 40: //down
			ddy = 0
			break
		}
	}).keypress(function(e){
		switch (e.which) {
		case 112: //p
			if (started) statusControl.pause()
			break
		case 13: //Enter
			if (! started) statusControl.resume()
			break
		case 97: //a
			px -= 1
			break
		case 100: //d
			px += 1
			break
		case 119: //w
			py += 1
			break
		case 115: //s
			py -= 1
			break
		}
	})
}

$(function(){
	canvasInit()
})
</script>
</body>
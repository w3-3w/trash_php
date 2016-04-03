<head>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>My Canvas Test</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>
<body>
<canvas id="canvas1" style="border: 1px solid red" width="<?php echo($width); ?>" height="<?php echo($height); ?>">
Sorry, your browser does not support canvas!
</canvas>
<script>
window.jQuery || document.write('<script src="/js/jquery-2.1.3.min.js"><\/script>')
</script>
<p>
vx=<span id="dx">0</span> vy=<span id="dy">0</span> v=<span id="velocity">0.00</span> vmax=<span id="vmax">0.00</span>
</p>
<p>
length=<span id="length">1</span> ticks=<span id="count">0</span>
</p>
<script>
var canvas = document.getElementById('canvas1')
var cxt = canvas.getContext('2d')

var $title = $('title'), title = $title.text()
var x, y, dx, dy, ddx, ddy, bx, by
var px = <?php echo($px); ?>, py = <?php echo($py); ?>, scale = <?php echo($scale); ?>, initLength = <?php echo($initLength); ?>, tick = <?php echo($tick); ?>, bl = <?php echo($bl); ?>, br = <?php echo($br); ?>

var timer
var l, pointer, record, ml, bean, count
var $body = $('body')
var started = false

var $dx = $('#dx')
var $dy = $('#dy')
var $velocity = $('#velocity')
var $vmax = $('#vmax')
var $length = $('#length')
var $count = $('#count')
var vmax = 0

var doTick = function(){
	if (started) {
		// count
		count ++
		
		// velocity
		dx = dx + ddx
		dy = dy + ddy
		
		// friction
		if (dx > 0) {
			dx --
		} else if (dx < 0) {
			dx ++
		}
		if (dy > 0) {
			dy --
		} else if (dy < 0) {
			dy ++
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
		
		// move
		if (dx !== 0 || dy !== 0) {
			var point = new Point(x / scale, y / scale)
			if (beanFunc.reach(point)) {
				beanFunc.eat()
				beanFunc.generate()
			} else {
				beanFunc.render()
			}
			draw(point)
			if (isCollision()) {
				statusControl.over()
			}
		}
		
		// status
		$dx.text(dx)
		$dy.text(dy)
		$length.text(l)
		$count.text(count)
		var velocity = Math.sqrt(dx * dx + dy * dy)
		$velocity.text(velocity.toFixed(2))
		if (velocity > vmax) {
			vmax = velocity
			$vmax.text(vmax.toFixed(2))
		}
		
		// loop
		timer = setTimeout('doTick()', tick)
	}
}

var isCollision = function(){
	var prevPointer = toPrevPointer(pointer)
	var collision = false
	var nowPointer = pointer
	for (var i = 0; i < l - 2; i ++) {
		nowPointer = toNextPointer(nowPointer)
		if (geometry.isCross(record[prevPointer], record[pointer], record[nowPointer], record[toNextPointer(nowPointer)])) {
			collision = true
			break
		}
	}
	return collision
}

var geometry = {
	isDifferentSide: function(base1, base2, check1, check2){
		var ex = base2.y - base1.y
		var ey = base1.x - base2.x
		var e = base2.x * base1.y - base1.x * base2.y
		var check = function(cp){
			return cp.x * ex + cp.y * ey + e
		}
		var c1 = check(check1)
		var c2 = check(check2)
		if (Math.abs(c1) < 1e-10) c1 = 0
		if (Math.abs(c2) < 1e-10) c2 = 0
		return c1 * c2 < 0
	},
	isCross: function(pa1, pa2, pb1, pb2){
		return this.isDifferentSide(pa1, pa2, pb1, pb2) && this.isDifferentSide(pb1, pb2, pa1, pa2)
	}
}

var toNextPointer = function(pointer){
	var next = pointer + 1
	if (next >= l) {
		return next - l
	} else {
		return next
	}
}

var toPrevPointer = function(pointer){
	var prev = pointer - 1
	if (prev < 0) {
		return prev + l
	} else {
		return prev
	}
}

var Bean = function(x, y, r){
	this.x = x
	this.y = y
	this.r = r
}

var beanFunc = {
	reach: function(p){
		return (p.x - bean.x) * (p.x - bean.x) + (p.y - bean.y) * (p.y - bean.y) <= bean.r * bean.r
	},
	eat: function(){
		this.clear()
		ml += bl
	},
	generate: function(){
		bean = new Bean(Math.random() * bx / scale, Math.random() * by / scale, br / scale)
		this.render()
	},
	clear: function(){
		cxt.beginPath()
		cxt.fillStyle = 'white'
		cxt.arc(bean.x, bean.y, bean.r * 1.1, 0, 2 * Math.PI)
		cxt.fill()
	},
	render: function(){
		cxt.beginPath()
		cxt.fillStyle = 'rgb(139,90,0)'
		cxt.arc(bean.x, bean.y, bean.r, 0, 2 * Math.PI)
		cxt.fill()
	}
}

var draw = function(point){
	if (l < ml) {
		l += 1
		for (var i = l - 1; i > pointer + 1; i --) {
			record[i] = record[i - 1]
		}
		cxt.beginPath()
		cxt.moveTo(record[pointer].x, record[pointer].y)
		pointer = toNextPointer(pointer)
		record[pointer] = point
		cxt.lineTo(point.x, point.y)
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
		record[pointer] = point
		cxt.moveTo(record[nextPointer].x, record[nextPointer].y)
		for (var i = 0; i < l - 1; i ++) {
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
	},
	over: function(){
		started = false
		$title.text(title)
		cxt.fillStyle = 'rgba(178,34,34,0.5)'
		cxt.fillRect(0, 0, $(canvas).width(), $(canvas).height())
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
	l = 1
	pointer = l - 1
	record = []
	record[pointer] = new Point(x / scale, y / scale)
	dx = dy = ddx = ddy = 0
	ml = initLength
	count = 0
	$vmax.text(vmax = 0)
	cxt.clearRect(0, 0, $(canvas).width(), $(canvas).height())
	beanFunc.generate()
	
	statusControl.resume()
}

$(function(){
	canvasInit()
	$body.keydown(function(e){
		if (started) {
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
		}
	}).keyup(function(e){
		if (started) {
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
		}
	}).keypress(function(e){
		if (! started) {
			canvasInit()
		}
	})
})
</script>
</body>
</body>
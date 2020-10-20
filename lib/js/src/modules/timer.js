// timekeeping & fps limiter

function Timer(fps) {
	this.fps      = fps;
	this.interval = 1.0 / this.fps;
	this.reset();
}

Timer.prototype = {
	reset: function() {
		this.now    = this.then = this.start = Date.now();
		this.age    = 0;
		this.delta  = 0;
		this.paused = false;
	},

	update: function() {
		this.now   = Date.now();
		this.delta = (this.now - this.then) * 0.001;
	},

	nextFrame: function() {
		if (this.delta >= this.interval) {
			this.then  = this.now;
			this.age  += this.delta;
			return true;
		} else
			return false;
	},

	getRunTime: function() {
		return (Date.now() - this.start) * 0.001;
	},

	pause: function() {
		this.paused = true;
	},

	resume: function() {
		this.paused = false;
		this.reset();
	}
};
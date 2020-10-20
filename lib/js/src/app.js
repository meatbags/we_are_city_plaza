var App = {
	init: function() {	
		// events
		
		$("#nav-button, .nav a").on("click", function(){
			App.toggleMenu();
		});
		
		// trigger open
		
		if (window.location.href != siteUrl && window.location.href != siteUrl + "home/") {
			$(".main").addClass("active");
			$(".title").addClass("active");
			$(".nav a").each(function(i,e) {
				if (window.location.href == $(this).attr("href")) {
					$(this).click();
				}
			});
		}
		
		// remove loading screen
		
		$(".background img").css({opacity: 1});
		$(".loading-screen").css({opacity: 0});
		setTimeout(function(){
			$(".loading-screen").remove();
		}, 500);
		
		// scroll
		
		$(window).on("scroll", function(){ App.onScroll(); });
		App.onScroll();

		// setup
		
		App.imageIndex = 0;
		App.timer = new Timer(2);
		App.active = ($("#background__canvas").length != 0);
		
		if (App.active) {
			App.cvs = document.getElementById("background__canvas");
			App.ctx = App.cvs.getContext("2d");
			App.resize();
			$(window).on("resize", function(){ App.resize(); });
			App.loop();
		}
	},
	
	onScroll: function() {
		if (isHome) {
			var t, at, pt, et;

			t = $(window).scrollTop() + 50;
			at = $("#about").offset().top;
			pt = $("#photographers").offset().top;
			et = $("#exhibitions").offset().top;

			if ((t >= at && t < pt) || (t >= et)) {
				$("#nav-button").css({color: "black"});
			} else {
				$("#nav-button").css({color: "white"});
			}

			if ($("#nav-button").hasClass("active")) {
				App.toggleMenu();
			}
		}
	},
	
	toggleMenu: function() {
		if ($("#nav-button").hasClass("active")) {
			$("#nav-button, .nav").removeClass("active");
			App.onScroll();
		} else {
			$("#nav-button, .nav").addClass("active");
			$("#nav-button").css({color: "black"});
		}
	},
	
	resize: function() {
		App.cvs.width = window.innerWidth;
		App.cvs.height = window.innerHeight;
	},
	
	draw: function() {
		var c, r, g, b;
		
		r = Math.floor(Math.random() * 255);
		g = Math.floor(Math.random() * 255);
		b = Math.floor(Math.random() * 255);
		c = "rgb(" + r + ", " + b + ", " + g + ")";
		
		App.ctx.fillStyle = c;
		App.ctx.clearRect(0, 0, window.innerWidth, window.innerHeight);
		App.ctx.fillRect(0, 0, window.innerWidth, window.innerHeight);
		
		// get next image
		
		App.imageIndex = (App.imageIndex + 1) % $(".image-wrapper").length;
		$(".image-wrapper.active").removeClass("active");
		$(".image-wrapper:eq(" + App.imageIndex + ")").addClass("active");
	},
	
	loop: function() {
		requestAnimationFrame(App.loop);
		App.timer.update();
		
		if (App.timer.nextFrame()) {
			App.draw();
		}
	}
};

var $ = jQuery;

window.onload = function() {
	App.init();
};
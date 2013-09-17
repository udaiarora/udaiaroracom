$(window).load(function(){
	$(".foo").fadeOut(500, function(){
		$("html").niceScroll({scrollspeed : "100", autohidemode : false});
	});
	$(".main-content").css({"visibility":"visible"});
});

$(document).ready(function () {
 
    var anim_angle=360;
    var isRunning=false;
    $("#change-text, .spin-text").on("click", function(ev) {
    	if (!isRunning){
    		isRunning=true;
    		$("#change-text").removeClass("breath");
	    	$("#change-text").css({'-webkit-transform':'rotate('+anim_angle+'deg)','-moz-transform':'rotate('+anim_angle+'deg)', '-ms-transform':'rotate('+anim_angle+'deg)','-o-transform':'rotate('+anim_angle+'deg)', '-webkit-transition-duration':'500ms', '-moz-transition-duration':'500ms', '-o-transition-duration':'500ms', '-ms-transition-duration':'500ms'});
	    	anim_angle+=360;
	    	$(".spin-text").find(".visible").fadeOut(200, function(){


			if (0==$(".spin-text").find(".visible").next().length) 
			{
				$(".spin-text").find(".visible").siblings().first().removeClass("hidden").addClass("visible").removeAttr("style");
			}
			else 
			{
				$(".spin-text").find(".visible").next().removeClass("hidden").addClass("visible").removeAttr("style");
			}

		    $(this).addClass("hidden").removeClass("visible");
		    	
	    	});
	    	setTimeout(function()
	    	{
	    		isRunning=false;
	    		$("#change-text").addClass("breath");
	    	}, 500);
		}
		    	
    })
});
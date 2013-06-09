/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Equal Heights Plugin
 * Equalize the heights of elements. Great for columns or any elements
 * that need to be the same size (floats, etc).
 * 
 * Version 1.0
 * Updated 12/10/2008
 *
 * Copyright (c) 2008 Rob Glazebrook (cssnewbie.com) 
 *
 * Usage: $(object).equalHeights([minHeight], [maxHeight]);
 * 
 * Example 1: $(".cols").equalHeights(); Sets all columns to the same height.
 * Example 2: $(".cols").equalHeights(400); Sets all cols to at least 400px tall.
 * Example 3: $(".cols").equalHeights(100,300); Cols are at least 100 but no more
 * than 300 pixels tall. Elements with too much content will gain a scrollbar.
 * 
 */

(function($) {
	$.fn.equalHeights = function(minHeight, maxHeight) {
		tallest = (minHeight) ? minHeight : 0;
		this.each(function() {
			if($(this).height() > tallest) {
				tallest = $(this).height();
			}
		});
		if((maxHeight) && tallest > maxHeight) tallest = maxHeight;
		return this.each(function() {
			$(this).height(tallest).css("overflow","auto");
		});
	}
})(jQuery);

//jquery color animation plugin 
//here is the demo http://jqueryui.com/animate/#default
// div# 4
$(function() {
    var state = true;
    $( "#effect" ).hover(function() {
      if ( state ) {
        $( "#effect" ).animate({
          backgroundColor: "#314f6a",
          color: "#fff",
          height: 375
        }, 1000 );
      } else {
        $( "#effect" ).animate({
          backgroundColor: "#fff",
          color: "#000",
          height: 100
        }, 1000 );
      }
      state = !state;
    });
  });
  
  
//  How to Make a Smooth Animated Menu with jQuery
//http://buildinternet.com/2009/01/how-to-make-a-smooth-animated-menu-with-jquery/
//div# 2
  $(document).ready(function(){

    //When mouse rolls over
    $("li").mouseover(function(){
//        $(this).stop().animate({height:'50px'},{queue:false, duration:600, easing: 'easeOutBounce'})
    });

    //When mouse is removed
    $("li").mouseout(function(){
//        $(this).stop().animate({height:'50px'},{queue:false, duration:600, easing: 'easeOutBounce'})
    });

});
  

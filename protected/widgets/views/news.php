<?php
/* @var $this NewsController */
/* @var $news Array */
/* @var $dates Array */
/* @var $type String */
?>

<ul class="bxslider">
<?php
foreach($news as $key => $value)
{
	if($key != "")
	{
		echo "<li>";
		echo CHtml::encode(date('m/d/Y \a\t g:i a', strtotime($dates[$key])));
		echo "<br/>" . $value;
		echo "</li>";
	}
}
?>
</ul>

<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		$(window).load(function() {
			// Equalize the height of all the news-slider containers to the height of the largest news post.
			equalheight('.news-slider');

			// For each ul with the class bxslider that is not nested, set a unique id to it, then define it as a bxslider.
			var i=0;
			$('.bxslider').each(function(){
				i++;
				var attr = $(this).attr('id');
				if (typeof attr == typeof undefined || attr == false) {
					var newID = 'my_slider' + i;
					$(this).attr('id', newID);
					var slider = $('#' + newID).bxSlider({
						mode: 'vertical',
						minSlides: 1,
						maxSlides: 1,
						easing: 'ease',
						pager: false
					});
					equalheight('.bx-wrapper');
					
					$(window).resize(function() {
						slider.reloadSlider();
						equalheight('.bx-wrapper');
						equalheight('.news-slider');
					});
				}
			});
		});
	});

	/* Thanks to CSS Tricks for pointing out this bit of jQuery
	http://css-tricks.com/equal-height-blocks-in-rows/
	It's been modified into a function called at page load and then each time the page is resized. One large modification was to remove the set height before each new calculation. */
	equalheight = function(container){
		var currentTallest = 0, currentRowStart = 0, rowDivs = new Array(), $el, topPosition = 0;

		$(container).each(function() {
			$el = $(this);
			$($el).height('auto')
			topPostion = $el.position().top;

			if (currentRowStart != topPostion) {
				for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
					rowDivs[currentDiv].height(currentTallest + 7);
				}
				rowDivs.length = 0; // empty the array
				currentRowStart = topPostion;
				currentTallest = $el.height();
				rowDivs.push($el);
			} 
			else {
				rowDivs.push($el);
				currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
			}
			for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
				rowDivs[currentDiv].height(currentTallest + 7);
			}
		});
	}
</script>

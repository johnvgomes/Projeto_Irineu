$(document).ready(function(){
	$(window).load(function() {
		setTimeout(function() {
			$(".loader").animate({opacity: 0}, 1500, function() {
				$(this).remove();
				$("body, html").animate({scrollTop:0},200);
			});
		}, 1000);
	});


});

$(document).ready(function() {	

	$('a[name=modal]').click(function(e) {
		e.preventDefault();
		
		var id = $(this).attr('href');
		
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
		
		$('#mask').css({'width':maskWidth,'height':maskHeight});

		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
		
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
		
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
		
		$(id).fadeIn(2000); 
		
	});
	
	$('.window .close').click(function (e) {
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		
	
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});			
	
});
$(document).ready(function() {
	$(".upload").uploadify({
		height        : 40,
		swf           : './img/uploadify.swf',
		uploader      : './uploadify.php',
		width         : 320,
		onUploadSuccess : function(arg1, filename, arg3) {
			$("#form-queixa").prepend('<input type="hidden" name="images[]" value="'+filename+'" />');

		},
		buttonText: "Selecione as fotos"
	});
})
$(document).ready(function() {
	if ($().fancybox){
		$('.fancybox-thumbs').fancybox({
			prevEffect : 'none',
			nextEffect : 'none',

			closeBtn  : true,
			arrows    : true,
			nextClick : true,

			helpers : {
				thumbs : {
					width  : 80,
					height : 80
				}
			}
		});
	}
});

$(document).ready(function() {
	if ($().owlCarousel){
	$("#owl-demo").owlCarousel({
		
      autoPlay: 3000, //Set AutoPlay to 3 seconds
      
      items : 4,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3]
      
  });
}
	
});
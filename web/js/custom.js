$(document).ready(function(){
 
 // Add slideDown animation to Bootstrap dropdown when expanding.
  	$('.dropdown').on('show.bs.dropdown', function() {
  		if($(window).width() > 1199) {
  			$(this).find('.dropdown-menu').first().stop(true, true).slideDown();
  		}
  	});

  // Add slideUp animation to Bootstrap dropdown when collapsing.
  	$('.dropdown').on('hide.bs.dropdown', function() {
  		if($(window).width() > 1199) {
    		$(this).find('.dropdown-menu').first().stop(true, true).slideUp();	
    	}
	});



	


	$('.cst-btn-fixed').click( function() {
		$('.fixed-list').fadeToggle(200);
	});


	/*JS FOR SCROLLING THE ROW OF THUMBNAILS*/ 
	$(document).ready(function () {
	  $('.vid-item').each(function(index){
	    $(this).on('click', function(){
	      var current_index = index+1;
	      $('.vid-item .thumb').removeClass('active');
	      $('.vid-item:nth-child('+current_index+') .thumb').addClass('active');
	    });
	  });
	});
 // Add slideDown animation to Bootstrap dropdown when expanding.
  	$('.dropdown').on('show.bs.dropdown', function() {
  		if($(window).width() > 1199) {
  			$(this).find('.dropdown-menu').first().stop(true, true).slideDown();
  		}
  	});

  // Add slideUp animation to Bootstrap dropdown when collapsing.
  	$('.dropdown').on('hide.bs.dropdown', function() {
  		if($(window).width() > 1199) {
    		$(this).find('.dropdown-menu').first().stop(true, true).slideUp();	
    	}
	});



	$('.owl-carousel2').owlCarousel({
		margin: 30,
	    loop:false,
		nav:true,
		navText: ["<img src='img/prev.svg'>","<img src='img/next.svg'>"],
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1	            
	        },
	        768:{
	            items:3
	        },
	        992:{
	            items:3
	        }
	    },
	    autoplay: true,
	    autoplayHoverPause: true,
	    dots: false,
	    autoplayTimeout: 5000
	});


	$('.cst-btn-fixed').click( function() {
		$('.fixed-list').fadeToggle(200);
	});


	/*JS FOR SCROLLING THE ROW OF THUMBNAILS*/ 
	$(document).ready(function () {
	  $('.vid-item').each(function(index){
	    $(this).on('click', function(){
	      var current_index = index+1;
	      $('.vid-item .thumb').removeClass('active');
	      $('.vid-item:nth-child('+current_index+') .thumb').addClass('active');
	    });
	  });
	});




	$('.owl-carousel3').owlCarousel({
		margin: 2,
	    loop:false,
		navText: ["<img src='/V1/web/img/prev.svg'>","<img src='/V1/web/img/next.svg'>"],
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:3,	
	            nav:true            
	        },
	        768:{
	            items:3,
	            nav:true
	        },
	        992:{
	            items:3,
	            nav:true
	        }
	    },
	    autoplay: false,
	    dots: false
	});


	$('.owl-carousel4').owlCarousel({
		margin: 100,
	    loop:false,
		nav:true,
		navText: ["<img src='img/prev.svg'>","<img src='img/next.svg'>"],
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1	            
	        },
	        768:{
	            items:2
	        },
	        992:{
	            items:2
	        }
	    },
	    autoplay: true,
	    dots: false,
	    autoplayHoverPause: true,
	    autoplayTimeout: 4000
	});


	$('.pr-carousel-img-bl').click( 
		function() {
		var imgToChange = $(this).attr('src');
		$('.pr-car-img-to-change').attr('src', imgToChange);
		$('.pr-carousel-img-bl').removeClass('active-pr');
		$(this).addClass('active-pr');
	});	



	$('.owl-carousel5').owlCarousel({
		margin: 20,
	    loop:false,
		nav:true,
		navText: ["<img src='img/prev.svg'>","<img src='img/next.svg'>"],
	    responsiveClass:true,
	    responsive:{
	        0:{
	            items:1	            
	        },
	        768:{
	            items:2
	        },
	        992:{
	            items:3
	        }
	    },
	    autoplay: true,
	    dots: false,
	    autoplayHoverPause: true,
	    autoplayTimeout: 4000
	});


	$('.pr-carousel-img-bl').click( 
		function() {
		var imgToChange = $(this).attr('src');
		$('.pr-car-img-to-change').attr('src', imgToChange);
		$('.pr-carousel-img-bl').removeClass('active-pr');
		$(this).addClass('active-pr');
	});	

	/*
	$('.star-f-e').hover( function() {
		$(this).find($('img')).last().animate({opacity:1}, 0);
		$.each($(this).prevAll(), function() {
			$(this).find($('img')).last().animate({opacity:1}, 0);
		});

		$.each($(this).nextAll(), function() {
			$(this).find($('img')).last().animate({opacity:0}, 0);
		});

	});

	$('.star-f-e').click( function() {
		$(this).parent().attr('clicked-star', $(this).index() );

		$(this).find($('img')).last().animate({opacity:1}, 0);
		$.each($(this).prevAll(), function() {
			$(this).find($('img')).last().animate({opacity:1}, 0);
		});
 
		$.each($(this).nextAll(), function() {
			$(this).find($('img')).last().animate({opacity:0}, 0);
		});
	});

	$('.stars-wrap').hover( function() {

	}, function() {
		var clickedStar = $(this).attr('clicked-star');
		$(this).find($('.star-f-e')).eq( clickedStar ).trigger('click');
	});
	*/

	$('.testimonials-head img:nth-of-type(1)').click( function() {
		$('.owl-carousel4 .owl-nav .owl-prev').trigger('click');
	});

	$('.testimonials-head img:nth-of-type(2)').click( function() {
		$('.owl-carousel4 .owl-nav .owl-next').trigger('click');
	});




	$('.ctg-filt-a-i').click( function() {
		$('.ctg-filt-a-i').removeClass('a-i-toggled');
		$(this).addClass('a-i-toggled');
	});


});


$(document).ready(function() {
// $('.switcherslider').slick({
//   infinite: true,
//   slidesToShow: 3,
//   slidesToScroll: 3
// });


	$(".slick-track>img").css("width" , "135px");
	
document.onkeyup = function (e) {
	    e = e || window.event;
	    if (e.keyCode === 13) {
	        if ($(".posttextarea").val() != "") {
		 alert("done");
	        }
	    }
	    // Отменяем действие браузера
	    return false;
	}

$(function () {
 
  $(".rateYo").rateYo({
    rating: 5,
    fullStar: true,
    starWidth: "18px"
  });
   $(".modalrateYo").rateYo({
    rating: 5,
    fullStar: true,
    starWidth: "18px"
  });
      $(".rateYocomment").rateYo({
    rating: 5,
    fullStar: true,
    starWidth: "18px"
  });
  });

















//	$("#firstselect").on("change" , function(){
//		$(".rangepicker1").val($(this).val()); 
//	});
//	$(".value1").text($(".rangepicker1").val() + "$");
//	$(".value2").text($(".rangepicker2").val() + "$");
//	$(".value3").text($(".rangepicker3").val() + " persons");
//		$('.hiddenhelp1 p').on("click" , function(){
//			var val = $(this).data('id');
//			$('.rangepicker1').val(val).change();
//			
//		});
//		$('.hiddenhelp2 p').on("click" , function(){
//			var val = $(this).data('id');
//			$('.rangepicker2').val(val).change();
//		});
//		$('.hiddenhelp3 p').on("click" , function(){
//			var val = $(this).data('id');
//			$('.rangepicker3').val(val).change();
//		});
		$(".first_range_text").mouseenter(function() {
			$(".hiddenhelp1").css({"transition" : ".1s ease all", "visibility" : "visible"});
			$(".hiddenhelp1").mouseenter(function(){
				$(this).css("visibility" , "visible");
			});
		})
  		$(".first_range_text").mouseleave(function() {
 			$(".hiddenhelp1").css({"transition" : ".1s ease all" ,"visibility" : "hidden"});
 			$(".hiddenhelp1").mouseleave(function(){
				$(this).css("visibility" , "hidden");
			});
 		 });
  		$(".second_range_text").mouseenter(function() {
			$(".hiddenhelp2").css({"transition" : ".1s ease all", "visibility" : "visible"});
			$(".hiddenhelp2").mouseenter(function(){
				$(this).css("visibility" , "visible");
			});
		})
  		$(".second_range_text").mouseleave(function() {
 			$(".hiddenhelp2").css({"transition" : ".1s ease all" ,"visibility" : "hidden"});
 			$(".hiddenhelp2").mouseleave(function(){
				$(this).css("visibility" , "hidden");
			});
 		 });
  		$(".third_range_text").mouseenter(function() {
			$(".hiddenhelp3").css({"transition" : ".1s ease all", "visibility" : "visible"});
			$(".hiddenhelp3").mouseenter(function(){
				$(this).css("visibility" , "visible");
			});
		})
  		$(".third_range_text").mouseleave(function() {
 			$(".hiddenhelp3").css({"transition" : ".1s ease all" ,"visibility" : "hidden"});
 			$(".hiddenhelp3").mouseleave(function(){
				$(this).css("visibility" , "hidden");
			});
 		 });

	$(".iconsblock").on("click" , function(){
		$(".iconsblock").removeClass("fullopac");
		$(this).addClass("fullopac");
	});





	$('.ulswitch>li>a').on("click" , function(){
		$('.ulswitch>li>a').removeClass("activedeltagamma")
		$(this).addClass("activedeltagamma");
	});

	$('.point').on('click',function(){
		$('.point.activeswitcher').removeClass('activeswitcher');
		$('.switcherblock.activeblock').removeClass('activeblock');
		$(this).addClass('activeswitcher');
		$('#'+$(this).attr('for')).addClass('activeblock');
	});
	$(".togglewrap").click(function(){
    $("#togglemenu").toggle(600);
});
	$('.communicate_li').on('click',function(){
		$('#'+$('.communicate_li.liact').attr('for')).hide();
		$('.communicate_li.liact').removeClass('liact');
		$(this).addClass('liact');
		$('#'+$(this).attr('for')).show();
	});

	$('.change_text').on('click',function(){
		var value = CKEDITOR.instances['editor1'].getData() + CKEDITOR.instances['editor2'].getData();
		if ($('#editor3').length>0){
			value += CKEDITOR.instances['editor3'].getData();
		}
		$('.keksos').html(value);
		$('#deltagamma').modal('hide');
	});

	$('.add_stream').on('click',function(){
		var text = $('textarea[name="iframe"]').val();
		if (text == ""){
			$('textarea[name="iframe"]').css('border','1px solid red');
			return false;
		}
		$('textarea[name="iframe"]').css('border','');
		$('textarea[name="iframe"]').val('');
		$('.iframe').html(text);
		$('#live_stream').modal('hide');
	});

	$('.save_event').on('click',function(){
		$('#deltagamma2').modal('hide');
		if ($('input[name="RSVP"]').prop('checked')){
				setTimeout( function() { $('#RSVP').modal('show'); } , 1000)

		}
	});

	$('input[name="yelta"]').on('change',function(){
		var val = $(this).val();
		if (val == 1){
			$('.firstblock').show();
			$('.secondblock').hide();
		} else {
			$('.firstblock').hide();
			$('.secondblock').show();
		}
	});
	$('a[href="#opencart"]').on('click',function(e){
			e.preventDefault();
				$('#buymodal').css('visibility','hidden');
				setTimeout( function() { $('#buymodal').modal('hide'); } , 5);
				setTimeout( function() { $('#opencart').modal('show');$('#buymodal').css('visibility','visible');} , 500);
		});
	$('a[href="#RSVP"]').on('click',function(e){

  	e.preventDefault();
 	$('#modaunkn1').css('visibility','hidden');
 	$('#modaunkn').css('visibility','hidden');
 	$('#deltagamma2').css('visibility','hidden');
 	setTimeout( function() { $('#modaunkn').modal('hide'); } , 5);
 	setTimeout( function() { $('#deltagamma2').modal('hide'); } , 5);
  	setTimeout( function() { $('#modaunkn1').modal('hide'); } , 5);
	setTimeout( function() { $('#RSVP').modal('show');$('#modaunkn1').css('visibility','visible');} , 500);
	setTimeout( function() { $('#RSVP').modal('show');$('#modaunkn').css('visibility','visible');} , 500);
	setTimeout( function() { $('#RSVP').modal('show');$('#deltagamma2').css('visibility','visible');} , 500);
});
	$('.blockwrapplinger').on('click',function(){
		$('#add_img').modal('show');
	});

	$('.zetta .emptyblock').on('click',function(){
		$('input[name="img_cust"]').trigger('click');
	});


	$(document).on('click','.zetta .imageblockform',function(){
		$('.zetta .imageblockform.activeblockform').removeClass('activeblockform');
		$(this).addClass('activeblockform');
	});
	$('.change_pic_cust').on('click',function(){
		$('.middleimg img').attr('src',$('.zetta .imageblockform.activeblockform img').attr('src'));
		$('#modaunkn2').modal('hide');
	});


	$('input[name="img_cust"]').on('change',function(){
		readURL_cust(this);
		$(this).val('');
	});
	function readURL_cust(input) {

	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	         reader.onload = function (e) {
	        	$('.zetta .imageblockform.activeblockform').removeClass('activeblockform');
	        	$('.zetta').prepend('<div class="col-lg-4  col-xs-4 clearfix"><div class="imageblockform activeblockform"><img src="' + e.target.result + '" alt=""></div></div>');
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}

	$('.images_block .emptyblock').on('click',function(){
		$('input[name="img_bg"]').trigger('click');
	});

	$('.switcher img').on('click',function(){
		$('.main_img_product').attr('src',$(this).attr('src'));
		$('.switcher img.activeswticherimg').removeClass('activeswticherimg');
		$(this).addClass('activeswticherimg');
	});

	$('.buttoncheckout').on('click',function(e){
		e.preventDefault();
		$('#opencart').modal('hide');
		setTimeout( function() { $('#opencartvisa').modal('show'); } , 500)

	});

	$('.payment').on('click',function(){
		$('.payment.activecard').removeClass('activecard');
		$(this).addClass('activecard');
		$('#visa').hide();
		$('#paypal').hide();

		$('#' + $(this).attr('for')).show();
	});

	$('.ulswitch li').on('click',function(e){
		e.preventDefault();
		$('.ulswitch li.switchactiveuldelta').removeClass('switchactiveuldelta');
		$(this).addClass('switchactiveuldelta');
		$('.Descriptionblock').hide();
		$('.Reviewsblock').hide();

		$('#' + $(this).attr('for')).show();
	});

	$('.write_review').on('click',function(e){
		e.preventDefault();
		$('.btn_hide').hide();
		$('.post_review').show();
	});

	$('.priceitems div').on('click',function(){
		$('#buymodal').modal('show');
	});

	$('input[name="img_bg"]').on('change',function(){
		readURL_bg(this);
		$(this).val('');
	});

	$('.firstulhere').on('click',function(){
		$('#modaunkn').modal('show');
	});

	$('.secondulhere').on('click',function(){
		$('#modaunkn1').modal('show');
	});

	$('.thirdulhere').on('click',function(){
		$('#modaunkn2').modal('show');
	});

	function readURL_bg(input) {

	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	        	$('.images_block .imageblockform.activeblockform').removeClass('activeblockform');
	        	$('.images_block').prepend('<div class="col-lg-4  col-xs-4 clearfix"><div class="imageblockform activeblockform"><img src="' + e.target.result + '" alt=""></div></div>');
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$(document).on('click','.images_block .imageblockform',function(){
		$('.images_block .imageblockform.activeblockform').removeClass('activeblockform');
		$(this).addClass('activeblockform');
	});
	$('.change_pic').on('click',function(){
		$('.blockwrapplinger').css('background','url("' + $('.images_block .imageblockform.activeblockform img').attr('src') + '") no-repeat');
		$('#add_img').modal('hide');
	});









	$('.textevent').on('click',function(){
		$('#deltagamma').modal('show');
	});

	$('.wrapplinger').on('click',function(){
		$('#deltagamma2').modal('show');
	});
	

	$('.maincontent img').on('click',function(){
		$('.maincontent img').attr('for','');
		$('input[name="imgchnages"]').trigger('click');
		$(this).attr('for','change');
	});	

	$('input[name="imgchnages"]').on('change',function(){
		readURL(this);
		$(this).val('');
	});

	function readURL(input) {

	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	            $('img[for="change"]').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	/*
	|--------------------------------------------------
	| Common variable
	|--------------------------------------------------
	*/
	w = $( window ).width();

	//Control arrow of Collapse
	$('.controlCollapse').on('click', function(e) {
		if ($(this).hasClass('iconArrowRight')) {
			$(this).removeClass('iconArrowRight');
			$(this).addClass('iconArrowDown');
		} else {
			$(this).removeClass('iconArrowDown');
			$(this).addClass('iconArrowRight');
		}
	})

	//Dropdown Menu
	$('.btn-dropdown-menu-selected').on('click', function (event) {
		checkOpen = $(this).parent().hasClass("open");
		// close all dropdown
		dropdowns = $('.group-dropdown-menu-selected');
		dropdowns.removeClass('open');
		// toogle dropdown selected
		if (!checkOpen) $(this).parent().addClass('open');
	});
	$('body').on('click', function (e) {
		if (!$('btn-dropdown-menu-selected').is(e.target) 
			&& $('btn-dropdown-menu-selected').has(e.target).length == 0 
			&& $('.group-dropdown-menu-selected').has(e.target).length == 0
		) {
			$('.group-dropdown-menu-selected').removeClass('open');
		}
	});
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('D/M/YYYY') + ' - ' + end.format('D/M/YYYY'));
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end
    }, cb);

//     $('#keks_date').daterangepicker({
//        startDate: start,
//        endDate: end
//    }, cbs);
//
//    function cbs(start, end) {
//        $('#keks_date span').html(start.format('D/M/YYYY') + ' - ' + end.format('D/M/YYYY'));
//    }
//
//    cbs(start, end);
    cb(start, end);



	//Top Menu Auto show
	$('.menu-sublink-wrapper').on('mouseover', function (event) {
		if (w >= 768) 
			$(this).addClass("active");
	});
	$('.menu-sublink-wrapper').on('mouseleave', function (event) {
		$(this).removeClass("active");
		$(this).find('.menu-sublink-wrapper').removeClass("active");
	});

	//Slect number of guest in Manuallu modal
	$('#selectNbGuest').on("change", function (event) {
		$(".form-dynamic").empty();
		if (event.target.value == 0) {
			$(this).parent().addClass('alone');
		} else 
			$(this).parent().removeClass('alone');

		for (var i = 0; i < event.target.value; i++) {
			newRow = '<div class="form-dynamic-row clearfix">'
					'<select name="guest-relation-${i}" id="">'
						'<option value="">Relation</option>'
						'<option value="">optional</option>'
						'<option value="">optional</option>'
					'</select>'
					'<input type="text" name="guest-name-${i}">'
					'<select name="guest-place-with-${i}" id="">'
						'<option value="">Place with</option>'
						'<option value="">optional</option>'
						'<option value="">optional</option>'
					'</select>'
				'</div>';
			$(".form-dynamic").append(newRow);
		}
	})

	//Toggle arrow Sort
	$('.btnSort').on('click', function() {
		$(this).find('span').toggleClass('iconRotate180');
	})

	//increase and decrease form type number
	$('.btnPlus').on('click', function(e) {
		e.preventDefault();
		range = 1;
		$(this).parent().find('input')[0].value = parseInt($(this).parent().find('input')[0].value) + range;
	})
	$('.btnMinus').on('click', function(e) {
		e.preventDefault();
		range = 1;
		$(this).parent().find('input')[0].value = parseInt($(this).parent().find('input')[0].value) - range;
	})

	/*
	|--------------------------------------------------
	| Simple Slider
	|--------------------------------------------------
	*/
	setWidthOfEachSlider(setColumnOfSlider(w));

	$('.simple-slider button.control-right').on('click', function(e) {
		e.preventDefault();
		if (!$(this).hasClass('disabled')) {
			simpleSlideMoveLeft(setColumnOfSlider(w));
		};
	})
	$('.simple-slider button.control-left').on('click', function(e) {
		e.preventDefault();
		if (!$(this).hasClass('disabled')) {
			simpleSlideMoveRight(setColumnOfSlider(w));
		};
	})

	/*
	|--------------------------------------------------
	| View Quote
	|--------------------------------------------------
	*/
	$('.btn-view-quote').on('click', function() {
		$('.quotation-form .form-request').removeClass('hidden');
	})

	/*
	|--------------------------------------------------
	| Notification
	|--------------------------------------------------
	*/
	$('.btn-notification').on('click', function() {
		$(this).removeClass('active');
	})

	/*
	|--------------------------------------------------
	| Choose Shape
	|--------------------------------------------------
	*/
	$('.btn-choose-shape').on('click', function () {
		shape = $(this).attr('alt');
		console.log(shape);
		$.ajax({
			// url: "your url",

		}).done(function(data) {
			$('.simple-slider .view ul').empty();
			// replace data in slide here
			$('.btn-choose-shape').removeClass("active");
			$(this).addClass("active");
		});
	})

})

$(window).scroll(function () {
	var header = $('.budget-detail .control-panel');
	if (header.length) {
		if (!header.hasClass('control-panel-fixed')) {
			if ($(window).scrollTop() > header.offset().top + header.height() )
				fixedTableHeader(header)
		} else {
			if ($(window).scrollTop() < ($('.budget-detail').offset().top + 30))
				unFixedTableHeader(header)
		}

	}
})

$(window).resize(function () {
	/*
	|--------------------------------------------------
	| Common variable
	|--------------------------------------------------
	*/
	w = $( window ).width();
	
	setWidthOfEachSlider(setColumnOfSlider(w));
})

/*
|--------------------------------------------------
| Budget page
|--------------------------------------------------
*/
function fixedTableHeader(elem) {
	elem.addClass('control-panel-fixed');
}
function unFixedTableHeader(elem) {
	elem.removeClass('control-panel-fixed');
}


/*
|--------------------------------------------------
| Function Simple Slider
|--------------------------------------------------
*/
setColumnOfSlider = function (windowWidth) {
	if (windowWidth>=768) {
		return 3;
	} else if (windowWidth>=480) {
		return 2;
	} else{
		return 1;
	}
}
setWidthOfEachSlider = function (column = 3) {
	containerWidth = $('.simple-slider .view').width();
	$('.simple-slider .view ul li').css('width', containerWidth/column);
}
simpleSlideMoveLeft = function (column = 3) {
	$('.simple-slider button.control').addClass('disabled');
	container = $('.simple-slider ul');
	slider = $('.simple-slider ul li:first-child');

	slider.clone().appendTo(container);

	container.animate({
		left: - slider.outerWidth(),
		},500, function() {
			slider.remove();
			container.css('left', '0');
			$('.simple-slider button.control').removeClass('disabled');
		}
	);
}
simpleSlideMoveRight = function (column = 3) {
	$('.simple-slider button.control').addClass('disabled');
	container = $('.simple-slider ul');
	slider = $('.simple-slider ul li:last-child');

	slider.clone().prependTo(container);
	container.css('left', - slider.outerWidth());

	container.animate({
		left: 0,
		},500, function() {
			slider.remove();
			$('.simple-slider button.control').removeClass('disabled');
		}
	);
	$('#colorinput').ColorPicker({flat: true});
}

$(function () {
 
  $("#rateYo1").rateYo({
    rating: 2,
    fullStar: true,
    starWidth: "18px"
  });
  $("#rateYo2").rateYo({
    rating: 2,
    fullStar: true,
    starWidth: "18px"
  });
    $("#rateYo3").rateYo({
    rating: 2,
    fullStar: true,
    starWidth: "18px"
  });
      $("#rateYo4").rateYo({
    rating: 2,
    fullStar: true,
    starWidth: "18px"
  });
        $("#rateYo5").rateYo({
    rating: 2,
    fullStar: true,
    starWidth: "18px"
  });
          $("#rateYo6").rateYo({
    rating: 2,
    fullStar: true,
    starWidth: "18px"
  });
});



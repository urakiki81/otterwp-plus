/*
 * Let's begin with validation functions
 */
jQuery.extend(jQuery.fn, {
	/*
	 * check if field value lenth more than 3 symbols ( for name and comment ) 
	 */
	validate: function () {
		if (jQuery(this).val().length < 3) {jQuery(this).addClass('error');return false} else {jQuery(this).removeClass('error');return true}
	},
	/*
	 * check if email is correct
	 * add to your CSS the styles of .error field, for example border-color:red;
	 */
	validateEmail: function () {
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/,
		    emailToValidate = jQuery(this).val();
		if (!emailReg.test( emailToValidate ) || emailToValidate == "") {
			jQuery(this).addClass('error');return false
		} else {
			jQuery(this).removeClass('error');return true
		}
	},
});
 
jQuery(function($){

	$(document).on("mouseover", '.otw-star a', function () {
		
		var onStar = parseInt($(this).data("value"), 10); //
		$(this).parent().children(".star").each(function (e) {
			
		  if (e < onStar) {
			$(this).addClass("hover");
		  } else {
			$(this).removeClass("hover");
		  }
		});
	  }).on("mouseout", function () {
		$(this).parent().children(".star").each(function (e) {
		  $(this).removeClass("hover");
		});
	  });
	  
	  $(document).on("click", '.otw-star a', function( event )  {
		event.preventDefault();
		var onStar = parseInt($(this).data("value"), 10);
		var stars = $(this).parent().children("a.star");
	  
	  
		if (onStar === 5) {
		  $(".button-box .done").removeAttr("disabled");
		} else {
		  $(".button-box .done").attr("disabled", "true");
		}
	  
		for (i = 0; i < stars.length; i++) {
		  $(stars[i]).removeClass("active");
		}
	  
		for (i = 0; i < onStar; i++) {
		  $(stars[i]).addClass("active");
		}
	  

		$("[data-tag-set]").hide();
		$("[data-tag-set=" + onStar + "]").show();
	  });

	  $(document).on("click",'.comment-form-rating .stars a', function(e){
		e.preventDefault();
		var rating = $(this).data("value");
		$('.comment-form-rating select[name="rating"]').val(rating);
	});

	  $(".done").on("click", function () {
		$(".rating-component").hide();
		$(".feedback-tags").hide();
		$(".button-box").hide();
		$(".submited-box").show();
		$(".submited-box .loader").show();
	  
		setTimeout(function () {
		  $(".submited-box .loader").hide();
		  $(".submited-box .success-message").show();
		}, 1500);
	  });
	  
	$(document).on("click", '.otw-star a', function( event ) {
		event.preventDefault();
		
		const rating = $(this).text()
		$("#rating").prop("selectedIndex", rating);
	
	});
	
	/*
	 * On comment form submit
	 */
	if ( $("body").hasClass("otterwp-disable-reivew") ) {
		// do nothing
	 }else{
	$(document).on("submit", "#commentform", function(e) {
		e.preventDefault(); // prevent form from submitting
		var closestForm = $(this).closest("form"); // get the closest form to the clicked button
		var number = $('.otw-woo-reviews__header h2').text().replace(/[^0-9]/gi, '');
		var text = $('.otw-woo-reviews__header h2').text().replace(/\d+/g, '');
	    var rating = closestForm.find('#rating').val();
		var rating = closestForm.find('#rating').val();
		var newNum = parseInt(number)
		var newCount = newNum + 1;
		var rating = closestForm.find("input[name='rating']");
		var button = $(this), // submit button
			respond = closestForm.find('.woocommerce-Reviews'), // comment form container
			commentlist = closestForm.closest('.woocommerce-Reviews').find('.commentlist'), // comment list container
			cancelreplylink = closestForm.find('#cancel-comment-reply-link');
		// if user is logged in, do not validate author and email fields
		if(closestForm.find('#author').length)
			closestForm.find('#author').validate();
	
		if(closestForm.find('#email').length)
			closestForm.find('#email').validateEmail();

		// validate comment in any case
		closestForm.find('#comment').validate();
	
		// if comment form isn't in process, submit it
		if (!button.hasClass('loadingform') && !closestForm.find('#author').hasClass('error') && !closestForm.find('#email').hasClass('error') && !closestForm.find('#comment').hasClass('error')) {
			// ajax request
			$.ajax({
				type : 'POST',
				url : otterwp_ajax_comment_params.ajaxurl, // admin-ajax.php URL
				data: closestForm.serialize() + '&action=ajaxcomments', // send form data + action parameter
				beforeSend: function(xhr){
					// what to do just after the form has been submitted
					button.addClass('loadingform').val('Loading...');
				},
				error: function (request, status, error) {
					if( status == 500 ){
						alert( 'Error while adding comment' );
					} else if( status == 'timeout' ){
						alert('Error: Server doesn\'t respond.');
					} else {
						// process WordPress errors
						var wpErrorHtml = request.responseText.split("<p>"),
							wpErrorStr = wpErrorHtml[1].split("</p>");
	
						alert( wpErrorStr[0] );
					}
				},
				success: function ( addedCommentHTML, data ) {
					// if this post already has comments
					if( commentlist.length > 0 ){
					
						// if in reply to another comment
						if( respond.parent().hasClass( 'comment' ) ){
						
							// if the other replies exist
							if( respond.parent().children( '.children' ).length ){	
								respond.parent().children( '.children' ).prepend( addedCommentHTML );
							} else {
								// if no replies, add <ol class="children">
								addedCommentHTML = '<ol class="children">' + addedCommentHTML + '</ol>';
								respond.parent().prepend( addedCommentHTML );
		
							  
							}
							// close respond form
							cancelreplylink.trigger("click");
						} else {
							// simple comment
							commentlist.prepend( addedCommentHTML );
							$('.otw-woo-reviews__header h2').text(text + newCount);
							$('.otw-woo-review__avatar h2').text(text + newCount);
							$(".otw-woo-reviews__body").animate({ scrollTop: 0 }, "fast");
					
						}
					}else{
						// if no comments yet
						addedCommentHTML = '<ol class="comment-list">' + addedCommentHTML + '</ol>';
						respond.prepend( $(addedCommentHTML) );
						$('.otw-woo-reviews__header h2').text(text + newCount);
						$('.otw-woo-review__avatar h2').text(text + newCount);
						$(".otw-woo-reviews__body").animate({ scrollTop: 0 }, "fast");
					}
					$('.otw-woo-reviews__header h2').text(text + newCount);
					$('.otw-woo-review__avatar h2').text(text + newCount);
					$(".otw-woo-reviews__body").animate({ scrollTop: 0 }, "fast");
					// clear textarea field
					$('#comment').val('');
				},
				complete: function(){
					// what to do after a comment has been added
					button.removeClass( 'loadingform' ).val( 'Post Comment' );
					$('.otw-star span a').removeClass('active hover');
					$('.otw-tags-container').css('display', 'none');
				}
			});
		}
		return false;
	});
	 }
});
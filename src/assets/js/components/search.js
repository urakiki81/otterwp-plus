
  jQuery(document).ready(function($) {
    var nonce = woo_my_ajax_object.nonce;
    var typingTimer;                // timer identifier
    var doneTypingInterval = 100;  // time in ms, 5 second for example
    var $input = $(this).find('.wp-block-search__input');
    var $current = "";
    if ( $("body").hasClass("otterwp-disable-search") ) {
      // do nothing
     }else{
    $(document).on("click", ".wp-block-search__input", function() {
      $('html, body').animate({
          scrollTop: $($input).offset().top
      }, 1000);

  });
    // on keyup, start the countdown
    $input.on('keyup', function (e) {
      clearTimeout(typingTimer);
     
      $current = $(this).closest('.wp-block-search__inside-wrapper');
    
      // Check if the key that was pressed is 'Tab'
      if (e.key === 'Tab') {
        // Get the last tabbable element within the otw-search-container
        const $lastTabbableElement = $('.otw-search-container').find(':tabbable').last();
        if ($(e.target).is($lastTabbableElement)) {
          // If the current element is the last tabbable element, do not execute doneTyping
          return;
        }
      }
    
      typingTimer = setTimeout(doneTyping, doneTypingInterval);
      
      $('.wp-block-search__input').attr("autocomplete", "off");
    });
    // on keydown, clear the countdown 
    $input.on('keydown', function (e) {
        clearTimeout(typingTimer);
              if (e.type === 'keydown' && !e.key === 'Tab') {
        $('.search-hint').remove(); // remove the hint div
        $('.break').remove(); // remove the hint div
  
        $('.otw-search-container').remove(); // remove the hint div
        }
        $('.wp-block-search__input').attr("autocomplete", "on");
      });
  
    // user is "finished typing," do something
    function doneTyping () {
      var search_query = $input.val();
      $.ajax({
        url: woo_my_ajax_object.ajax_url,
        type: 'POST',
        data: {
          action: 'search_products',
          search_query: search_query,
          security: nonce,
        },
        success: function(response) {
          // do something with the response here
          $('.break').remove(); // remove the hint div
          $('.otw-search-container').remove(); // remove the hint div
          $($current).append('<div class="otw-search-container"><div class="otw-search-close"></div></div>');
          $('.otw-search-container').attr('tabindex', 0);
          $('.otw-search-container').append(response);
        }
      });
    }
    $(document).on('click', 'body', function(e){
      if ($(".wp-block-search__inside-wrapper input").is(":focus")) {
        $('.otw-search-container').css('display','block');
      }else{
        $('.otw-search-container').css('display','none');
        $('.wp-block-search').removeClass('otw-focused');

      }
     
  });     
  $(document).on('click', '.otw-search-close', function(e){
      $('.otw-search-container').css('display','none');
  });
  $(document).on('focusin focusout', function (e) {
    var $searchDiv = $('.wp-block-search');
  
    if ($searchDiv.has(e.target).length > 0) {
      $searchDiv.addClass('otw-focused');
    } else {
      $searchDiv.removeClass('otw-focused');
    }
  });

  $(document).on('focusin focusout', '.search-hint', function(e){
    if (e.type === 'focusin') {
      $('.wp-block-search').addClass('otw-focused');
      $(this).addClass('focus')
    }else{
      $(this).removeClass('focus')
    }
  });

}
});

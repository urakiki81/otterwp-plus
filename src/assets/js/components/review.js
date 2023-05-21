import $ from 'jquery';
$(document).ready(function() {

    var RstartTime;
    var RtouchingElement = false;
    var RdragDirection = "";
     var RstartY = 0,
         RstartX = 0;
     var RcurrentY = 0,
         RcurrentX = 0;
     var RisOpen = false;
     var RisMoving = false;
     var RmenuHeight = window.innerHeight;
     var RlastY = 0;
     var RlastX = 0;
     var RmoveY = 0; // where in the screen is the menu currently
     var RmaxOpacity = 1;
     var RnewOpacity = 0;
     var timeoutId;

     function debounce(func, wait = 10, immediate = true) {
        var timeout;
        return function() {
          var context = this, args = arguments;
          var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
          };
          var callNow = immediate && !timeout;
          clearTimeout(timeout);
          timeout = setTimeout(later, wait);
          if (callNow) func.apply(context, args);
        };
      };
   
     $(document).on("touchstart", ".otw-woo-reviews__header", function(evt) {
        $('.otw-woo-reviews-bg').addClass("otw-transition");
         RstartTime = new Date().getTime();
         RstartY = evt.touches[0].pageY;
         RstartX = evt.touches[0].pageX;
         //var hight = this.clientHeight;
         RtouchingElement = true;
         touchStartR(RstartY, RstartX, $(this)); 
         $('.otw-woo-reviews-bg').removeClass("has-transition");
       });
   
       $(document).on("touchend", ".otw-woo-reviews__header", function(evt) {
   
 
     // Calculating new position of scrollbar
     $('.otw-woo-reviews').removeClass("no-transition");
     $('.otw-woo-reviews-bg').removeClass("no-transition");
         const translateY = RcurrentY - RstartY; // distance moved in the x axis
         const translateX = RcurrentX - RstartX; // distance moved in the y axis
 
         const timeTaken = (new Date().getTime() - RstartTime);
         RtouchingElement = false;
         touchEndR(RcurrentY, RcurrentX, translateY, translateX, timeTaken, $(this));
      
     });
     $(document).on("touchmove", ".otw-woo-reviews__header",  debounce(function(evt) {
         // if (!RtouchingElement)
         //     return;
         const hight = this.clientHeight;
 
         RcurrentY = evt.touches[0].pageY;
         RcurrentX = evt.touches[0].pageX;
         const translateY = RcurrentY - RstartY; // distance moved in the x axis
         const translateX = RcurrentX - RstartX; // distance moved in the y axis
         
         touchMoveR(evt, RcurrentY, RcurrentX, translateY, translateX, hight, $(this));
         evt.stopPropagation();
     }));
 
   function touchStartR(RstartY, RstartX) {
     
        $('.otw-woo-reviews').addClass("no-transition");
        $('.otw-woo-reviews-bg').addClass("no-transition");
     
         RisOpen = true;
         RisMoving = true;
         RlastY = RstartY;
         RlastX = RstartX;
 
         if (RisOpen && RmoveY !== 0) {
            RmoveY = 0;
        } else if (!RisOpen && RmoveY !== -RmenuHeight) {
            RmoveY = -RmenuHeight;
        }

         
        
     }
function touchMoveR(evt, RcurrentY, RcurrentX, translateY, translateX, hight, thisObj) {
  if (RmoveY + (RcurrentY - RlastY) > 0 && RmoveY + (RcurrentY - RlastY) > -RmenuHeight) {
    RmoveY = RmoveY + (RcurrentY - RlastY);
  } else if (RmoveY + (RcurrentY - RlastY) < 0 && RmoveY + (RcurrentY - RlastY) > -RmenuHeight) {
    evt.stopPropagation();
  }
 
  RlastY = RcurrentY;
 
  var percentageBeforeDif = (Math.abs(RmoveY) * 100) / 200;
  var percentage = 100 - percentageBeforeDif;
  RnewOpacity = (((RmaxOpacity) * percentage) / 100 );
 
  updateUiR();
}
           
         
           
 
       
       function touchEndR(RcurrentY, RcurrentX, translateY, translateX, timeTaken, hight, thisObj, position) {
         RisMoving = false;
         var velocity = 0.3;
         const id = $(thisObj);
     
        
         if (RcurrentY === 0 && RcurrentX === 0) {
           if (RisOpen) {
 
           } else {
    
 
           }
       } else {
           if (RisOpen) {
               if ((translateY < (-RmenuHeight) / 2) || (Math.abs(translateY) / timeTaken > velocity)) {
                    openMenuR(translateY);
                    closeMenuR(translateY, position, RcurrentY, RcurrentX);                   
                   RisOpen = false;
               } else {
                   openMenuR(thisObj);
                   RisOpen = true;
                   translateY = null;
               }
           } else {
               if (translateY > RmenuHeight / 2 || (Math.abs(translateY) / timeTaken > velocity)) {
                 openMenuR();
                   RisOpen = true;
                   translateY = null;
               } else {
                   closeMenuR(translateY);
                   openMenuR(translateY);
                   RisOpen = false;
                   translateY = null;
               }
 
           }
           
         }

         RnewOpacity = '';
         translateY = null;
     }
     function updateUiR() {
        
        var offestMove = RmoveY
        console.log("updateUiR called with", RmoveY, RnewOpacity);
        if (RisMoving) {
            $('.otw-woo-reviews__header').removeClass('otw-swipe');
            $('.otw-woo-reviews-bg').css("opacity", RnewOpacity);
            $('.otw-woo-reviews').css("transform", "translateY(" + offestMove + 'px' + ")");
            //requestAnimationFrame(updateUiR); 
                   
        }else{
            $('.otw-woo-reviews__header').addClass('otw-swipe');
            $('.otw-woo-reviews-bg').attr("style", "");
            $('.otw-woo-reviews-bg').removeClass("no-transition");
        }
    }
   function closeMenuR(translateY) {
           if (translateY > 0 || !RisOpen) {
            const $otwReviews = $('.otw-woo-reviews');
            const $otwReview = $('.otw-woo-review');
            const $otwReviewsBg = $('.otw-woo-reviews-bg');
            
            $otwReviews.removeClass('otw-woo-reviews-open').removeAttr('style');
            $otwReview.removeClass('otw-woo-review-open').addClass('otw-woo-review-closed');
            $otwReviewsBg.removeClass('otw-transition has-transition').removeAttr('style');
             RstartY = 0,
             RstartX = 0;
             RcurrentY = 0,
             RcurrentX = 0;       
            if ($(".otw-floating-cart")[0]){
                $(".otw-floating-cart").addClass("otw-add-height");
            }             
           }
           
           
       }
   function openMenuR() {
    $('.otw-woo-reviews').attr("style", "");
    $('.otw-woo-reviews').removeClass("no-transition");
    RstartY = 0,
    RstartX = 0;
    RcurrentY = 0,
    RcurrentX = 0; 
     }
     $(document).on('click', '.otw-woo-review-closed', function (e) {
      const $this = $(this);
      const $otwSingle = $this.closest('.otw-woocommerce-single');
      const $otwReview = $this.find('.otw-woo-review');
      const $otwReviews = $otwSingle.find('.otw-woo-reviews');
      const $otwReviewsBg = $otwSingle.find('.otw-woo-reviews-bg');
  
      $otwReview.removeClass('otw-woo-review-closed').addClass('otw-woo-review-open');
      $otwReviews.addClass('otw-woo-reviews-open').removeClass('no-transition');
      $otwReviewsBg.addClass('otw-transition has-transition');
   });
   $(document).on('click', '.otw-woo-reviews-close-btn', function (e) {
        e.stopPropagation();
        const $this = $(this);
        const $otwSingle = $this.closest('.otw-woocommerce-single');
        const $otwReview = $otwSingle.find('.otw-woo-review');
        const $otwReviews = $otwSingle.find('.otw-woo-reviews');
        const $otwReviewsBg = $otwSingle.find('.otw-woo-reviews-bg');
    
        $otwReviews.removeClass('otw-woo-reviews-open').attr('style', '');
        $otwReview.removeClass('otw-woo-review-open').addClass('otw-woo-review-closed');
        $otwReviewsBg.removeClass('has-transition otw-transition');

     }); 
     $(document).on('click', '.woocommerce-review-link', function (e) {
      e.preventDefault();
      var tabDiv = $('.woocommerce-tabs');
      if (tabDiv.length > 0) {
        var offset = tabDiv.offset().top;
        $('html, body').animate({
          scrollTop: offset
        }, 200);
      }

   }); 
     function isElementOnScreen($element) {
        var elementTop = $element.offset().top;
        var elementBottom = elementTop + $element.outerHeight();
        var viewportTop = $(window).scrollTop();
        var viewportBottom = viewportTop + $(window).height();
    
        return elementTop < viewportBottom && elementBottom > viewportTop;
    }
    

    
     
});

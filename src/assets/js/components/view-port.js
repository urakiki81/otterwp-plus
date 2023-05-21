import $ from 'jquery';
$(document).ready(function() {
    var nonce = woo_my_ajax_object.nonce;
    var startTime;
    var touchingElement = false;
    var dragDirection = "";
     var startY = 0,
         startX = 0;
     var currentY = 0,
         currentX = 0;
     var isOpen = false;
     var isMoving = false;
     var lastY = 0;
     var lastX = 0;
     var moveY = 0; 
     var maxOpacity = 1;
     var position = "";
     var newOpacity = 0;
     var menuHeight = window.innerHeight;
     var postid = "";
     var comparingID = "";
     var productName  = "";
     var section = "";
     var originalUrl;
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

     $(document).on("touchstart", ".otw-woocommerce-header",  true, function(evt) {
         startTime = new Date().getTime();
         startY = evt.touches[0].pageY;
         startX = evt.touches[0].pageX;

         touchingElement = true;
         touchStart(startY, startX, $(this)); 
          
       });
 
   
       $(document).on("touchend", ".otw-woocommerce-header",  function() {
   
 
     // Calculating new position of scrollbar
 
         const translateY = currentY - startY; // distance moved in the x axis
         const translateX = currentX - startX; // distance moved in the y axis
 
         const timeTaken = (new Date().getTime() - startTime);
         touchingElement = false;
         touchEnd(currentY, currentX, translateY, translateX, timeTaken, $(this));     
      
     });
     $(document).on("touchmove", ".otw-woocommerce-header", debounce(function(evt) {

         const hight = this.clientHeight;
 
 
         currentY = evt.touches[0].pageY;
         currentX = evt.touches[0].pageX;
         const translateY = currentY - startY; // distance moved in the x axis
         const translateX = currentX - startX; // distance moved in the y axis
         
         touchMove(evt, currentY, currentX, translateY, translateX, hight, $(this));
 
     }));
 
   function touchStart(startY, startX) {
     
         $('.otw-woocommerce-single').addClass('otw-no-transition');
     
         isOpen = true;
         isMoving = true;
         lastY = startY;
         lastX = startX;
 
         if (isOpen) {
            moveY = 0;
        } else {
            moveY = -menuHeight;
        }
         
        
     }
     function touchMove(evt, currentY, currentX, translateY, translateX, hight, thisObj) {
               var menuHeight = hight;
                   if (!dragDirection) {
 
                     if (Math.abs(translateY) >= Math.abs(translateX)) {
                         dragDirection = "vertical";
                     } else {
                         dragDirection = "horizontal";
                     }
                      
                 }
                 if (dragDirection === "horizontal") {
                     lastY = currentY;
                     lastX = currentX;
                 } else{  
                     if (moveY + (currentY - lastY) > 0 && moveY + (currentY - lastY) > -menuHeight) {
                         moveY = moveY + (currentY - lastY);
                     
                     }else if (moveY + (currentY - lastY) < 0 && moveY + (currentY - lastY) > -menuHeight){
                       evt.stopPropagation();
                     }
 
                     lastY = currentY;
                     lastX = currentX;
 
 
                     var percentageBeforeDif = (Math.abs(moveY) * 100) / 200;
                     var percentage = 100 - percentageBeforeDif;
                     newOpacity = (((maxOpacity) * percentage) / 100);                    
                          
                 }
 
                 requestAnimationFrame(updateUi); 
                    
           }
           
         
           
 
       
       function touchEnd(currentY, currentX, translateY, translateX, timeTaken, hight, thisObj, position) {
         var menuHeight = hight;
         isMoving = false;
         var velocity = 0.3;
     
         $('.otw-woocommerce-single').removeClass('otw-no-transition');
                if (currentY === 0 && currentX === 0) {
                if (isOpen) {
        
                } else {
            
        
                }
                } else {
                    if (isOpen) {
                        if ((translateY < (-menuHeight) / 2) || (Math.abs(translateY) / timeTaken > velocity)) {
                                openMenu(translateY);
                                closeMenu(translateY, position, currentY, currentX);                   
                            isOpen = false;
                        } else {
                            openMenu();
                            isOpen = true;
                            translateY = null;
                        }
                    } else {
                        if (translateY > menuHeight / 2 || (Math.abs(translateY) / timeTaken > velocity)) {
                            openMenu();
                            isOpen = true;
                            translateY = null;
                        } else {
                            closeMenu(translateY);
                            openMenu(translateY);
                            isOpen = false;
                           
                        }
            
                    }
                }
         translateY = null;
     }
 
   function closeMenu(translateY) {

           if (translateY > 0 || !isOpen) {
           
            MenuIsClosed();  
            window.location.hash = '';
            window.scrollTo({ top: position, left:0, behavior: "instant"});
           }else{
           $('body').css('overflow','hidden');
           }
                    
       }
 
   function openMenu() {
         $('.otw-woocommerce-single').attr("style", "");
         $('.otterwp-content').attr("style", "");
         if ($(".otw-woo-reviews.otw-woo-reviews-open")[0]){
            $('.otw-woo-reviews').attr("style", "");
            $('.otw-woo-reviews-bg').attr("style", "");
            $('.otw-woo-reviews-bg').addClass("otw-transition");
        }
        isOpen = true;
        startY = 0,
        startX = 0;
        currentY = 0,
        currentX = 0; 
        return false; 
 
       
     }
     function MenuIsClosed() { 
        window.scrollTo({ top: position, left:0, behavior: "instant"});
        $('.otw-woocommerce-single').removeClass("otw-top");
        $('.otw-woocommerce-single').addClass("otw-bottom");
        $('body').removeClass('otw-items-open');
        $('.otw-floating-cart').addClass("otw-add-height");
        $('.otw-archive__content').attr("style", "");
        $('.otw-woocommerce-single').attr("style", "");
        if ($(".otw-woo-reviews.otw-woo-reviews-open")[0]){
           $('.otw-woo-reviews-bg').removeClass("otw-transition");
       }
        $('body').attr("style", "");
        startY = 0,
        startX = 0;
        currentY = 0,
        currentX = 0; 
       }
       function MenuIsOpen(e) {

        
            $('.otw-woocommerce-single').removeClass("otw-bottom");
            $('.otw-woocommerce-single').addClass("otw-top");
           
            $('.otterwp-content').attr("style", "");
            $('html').css('height', '100vh');
            const $body = $('body');
            $body.addClass('otw-items-open').css({
              'overflow': 'hidden',
              'position': 'fixed',
              'top': -position
            });
           
            return false; 
            
       }
       if (window.matchMedia("(max-width: 768px)").matches) {
        document.body.classList.add("otw-mobile");
      }
      $(document).off('click').on('click', ".otw-woocommerce-header", function opneClosedMenu(e) {
        position = $(window).scrollTop();
        if ($('div.otw-bottom').length) {
           window.location.hash =  "#product=" + postid + "-" + productName;
            return false;     
        }
        return false; 
       
      });

        $(document).on('click', '.traffic-light-maximize', function(e){
                var scrollPos = $(window).scrollTop();
                position = scrollPos;
                var container = $('body');
                - container.offset().top 
                + container.scrollTop();
                $('html').css('height', '100vh');
                $('body').css({
                    'position': 'fixed',
                    'overflow': 'hidden',
                    'top': -position
                  });
                  const $otwSingle = $('.otw-woocommerce-single');
                  $otwSingle.removeClass('otw-minimize otw-split otw-bottom')
                           .addClass('otw-top otw-maximize');
                $('body').removeClass("is-comparying");
                $('body').addClass('otw-items-open');
            if ($(".otw-moblie")[1]){
                $('.wp-block-query').addClass("otw-items-body-open"); 
                }
               window.location.hash =  "#product=" + postid + "-" + productName;
        })
        $(document).on('click', '.traffic-light-split', function(e){
            var section = $('.wp-block-post-title[data-attrs=' + postid + ']');
            if ($(".otw-minimize")[0]){
                $('.wp-block-query').animate({
                    scrollTop: $(section).offset().top
                  }, 'slow'); 
            }
            const $otwSingle = $('.otw-woocommerce-single');
            $otwSingle.removeClass('otw-maximize otw-minimize otw-bottom')
                     .addClass('otw-split otw-top');
            $('.wp-site-blocks').addClass("otw-items-body-open"); 
            $('body').addClass('otw-items-open is-comparying');
           window.location.hash =  "#product=" + postid + "-" + productName;
            
           
    
        })
        
        $(document).on('click', '.traffic-light-switch', function(e){
            e.stopImmediatePropagation();
            $(".is-main").remove();
            $('.otw-woocommerce-single').animate({ left: '0' }, 300);
            $(".otw-woocommerce-single").removeClass("is-compared");
            $(".otw-woocommerce-single").addClass("is-main");
            postid = comparingID;
            window.location.hash =  "#product=" + postid + "-" + productName;
        });
        $(document).on('click', '.traffic-light-close', function(e){
            e.stopImmediatePropagation();
            window.location.hash = '';
            $(".otw-woocommerce-single").remove();
            $('body').attr("style", "");
            $('body').removeClass("is-comparying");
            $('.wp-site-blocks').removeClass("otw-items-body-open ");
            postid = ""
        });
        $(document).on('click', '.traffic-light-minimize', function(e){
            e.stopImmediatePropagation();
            MenuIsClosed();
            window.location.hash = '';
            window.scrollTo({ top: position, left:0, behavior: "instant"});
            $('.otw-woocommerce-single').removeClass('otw-maximize otw-split');
            $('.wp-site-blocks').removeClass("otw-items-body-open");
            $('body').removeClass("is-comparying");
        });
               
        $(document).on('click', '.traffic-light-close-comp', function(e){
            e.stopImmediatePropagation();
            $(".is-compared").remove();
        });
        $(document).on('click', ".otw-bottom .otw-woocommerce-header", function opneClosedMenu(e) {
            var scrollPos = $(window).scrollTop();
            position = scrollPos;
            $('.otw-woocommerce-single').animate({ top: '0' }, 200);
            const $otwSingle = $('.otw-woocommerce-single');
            $otwSingle.removeClass('otw-split otw-minimize otw-bottom');
            $otwSingle.addClass('otw-maximize otw-top');
            $('body').addClass('otw-items-open');
            if ($('div.otw-bottom').length) {
               window.location.hash =  "#product=" + postid + "-" + productName;
                return false;     
            }
            return false; 
           
          });
    
          $(document).on('click', ".wc-forward", function stopPropagation (e) {
            e.stopPropagation();
        });
 

        if ( $("body").hasClass("otterwp-disable-shopping") ) {
            return null;
         }else{
            $(document).on('click', ".ajax_add_to_cart", function(e) {
                e.preventDefault();
                if (!$(this).hasClass("product_type_variable")) {
                    e.stopPropagation();
                }
            });
            $(document).on('keydown', ".ajax_add_to_cart", function(e) {
                if (e.keyCode === 13) { // Enter key code
                  e.stopPropagation();
                }
              });
              
        $(document).on('click keydown', '.otter-woo-data', function (e) {
            if ( e.keyCode === 13) {
                // Do default behavior for keydown, except for Enter key
                e.preventDefault();
                originalUrl = $(this).find('a').attr('href');
                window.location.href = originalUrl
                return;
              
            }else if (e.which === 1){
                e.preventDefault();
                originalUrl = $(this).find('a').attr('href');
                section = e.currentTarget;
                postid = $(this).attr('data-id');  
                updateItem(e);
            }
        });


        $(document).on('click keydown', '.otterwp-product-id', function (e) { 
            console.log(e.keyCode)
            if ( e.keyCode === 13) {
                // Do default behavior for keydown, except for Enter key
                e.preventDefault();
                originalUrl = $(this).find('a').attr('href');
                window.location.href = originalUrl
                return;
            }else if (e.which === 1){
                e.preventDefault();
                originalUrl = $(this).find('a').attr('href');
                postid = $(this).attr('data-product_id');
                section = e.currentTarget;
                updateItem(e);  
            }
        });
        $(document).on('click keydown', '.woocommerce-grouped-product-list-item__label', function (e) { 
            console.log(e.keyCode)
            if ( e.keyCode === 13) {
                // Do default behavior for keydown, except for Enter key
                e.preventDefault();
                originalUrl = $(this).find('a').attr('href');
                window.location.href = originalUrl
                return;
            }else if (e.which === 1){
                e.preventDefault();
                originalUrl = $(this).find('a').attr('href');
                postid = $(this).find('label').attr('for').replace('product-', '');
                section = e.currentTarget;
                updateItem(e);  
            }
        });
        $(document).on('click keydown', '.wc-block-components-product-name', function (e) {
            if ( e.keyCode === 13) {
                // Do default behavior for keydown, except for Enter key
                e.preventDefault();
                originalUrl = $(this).find('a').attr('href');
                window.location.href = originalUrl
                return;
              
            }else if (e.which === 1){
            e.preventDefault();
            e.stopImmediatePropagation();
             originalUrl = $(this).find('a').attr('href');
            //$(".otw-woocommerce-single").remove();
            var elem = e.currentTarget;
            var ELEMENT = elem;
            let ids = null;
            for(let i = 0, keys = Object.keys(ELEMENT); i < keys.length; i++)
            {
            if ((ids = keys[i].match(/^__react[^$]*(\$.+)$/)))
            {
                ids = ids[1];
                break;
            }
            }
            var reactProps = (`__reactProps`);
            var propsID = (reactProps+ids);
            let newContent = e.currentTarget[propsID].children[0].props.children.props.product.id;
            section = e.currentTarget;
            postid = newContent;
            updateItem(e);
        }

    });
        $(document).on('click keydown', '.wc-block-all-products .wc-block-grid__product', function (e) {
            if ( e.keyCode === 13) {
                // Do default behavior for keydown, except for Enter key
                e.preventDefault();
                originalUrl = $(this).find('a').attr('href');
                window.location.href = originalUrl
                return;
              
            }else if (e.which === 1){
                e.preventDefault();
                 originalUrl = $(this).find('a').attr('href');
                e.stopImmediatePropagation();
                if (e.target.tagName === 'BUTTON' && e.target.classList.contains('add_to_cart_button')) {
                    return null;
                }
                //$(".otw-woocommerce-single").remove();
                var elem = e.currentTarget;
                var ELEMENT = elem;
                let ids = null;
                for(let i = 0, keys = Object.keys(ELEMENT); i < keys.length; i++)
                {
                if ((ids = keys[i].match(/^__react[^$]*(\$.+)$/)))
                {
                    ids = ids[1];
                    break;
                }
                }
                var reactProps = (`__reactProps`);
                var propsID = (reactProps+ids);
                let newContent = e.currentTarget[propsID].children[0].props.children.props.product.id;
                section = e.currentTarget;
                postid = newContent;
                updateItem(e);
            }
        });
    
        $(document).on('click', '.wc-block-featured-product', function (e) {
            if ( e.keyCode === 13) {
                // Do default behavior for keydown, except for Enter key
                e.preventDefault();
                originalUrl = $(this).find('a').attr('href');
                window.location.href = originalUrl
                return;
              
            }else if (e.which === 1){
                e.preventDefault();
                 originalUrl = $(this).find('a').attr('href');
                //$(".otw-woocommerce-single").remove();
                section = e.currentTarget;
                postid = $(this).attr('data-product-id');
                updateItem(e);
            }
        });
    
        $(document).ready(function(){
                $(document).trigger('onLandEvent', [1011]);
        });
    }
        function updateItem(e, scrollPos) {
            if ($(".otw-moblie")[0]){
                // Do something if class exists
                
             } else {
                $('.wp-site-blocks').addClass("otw-items-body-open");   
                $('.wp-site-blocks').css('background-color', $("body").css("background-color"));
             // Do something if class does not exist
             }
            if ($(".otw-items-open")[0]){
            }else{
                var scrollPos = $(window).scrollTop();
                position = scrollPos;
                if ($(".otw-closed")[0]){
                    var scrollPos = $(window).scrollTop();
                    position = scrollPos;
            }
        }
        $( "body" ).addClass("otw-loading");
        if (!$('.is-comparying').length) {
            $(".otw-woocommerce-single").remove();
          }else{
            $(".is-compared").remove();
          }
            
            $.ajax({
                type: "POST",
                url: woo_my_ajax_object.ajax_url,
                timeout: 3000,
                security: nonce,
                data: {
                    action: 'otterwp_woo_load_more',
                    postid: postid,
                    security: nonce,
                },
                beforeSend: function(){
                    $( ".otterwp-loader-container" ).addClass("otter_is_loading");
                },
                error: function () {
                    $( ".otterwp-loader-container" ).removeClass("otter_is_loading");
                    $(".wp-site-blocks").removeClass("otw-items-open");  
                    $('body').attr("style", ""); 
                    $('.wp-site-blocks').removeClass("otw-items-body-open");
                
                    if (originalUrl) {
                        window.location.href = originalUrl;
                    } else {
                        alert( "Opps somthing went wrong. Try again" );
                        window.location.hash = '';
                    }
                    $( "body" ).removeClass("otw-loading");
                },
                complete: function(){
                    $( ".otterwp-loader-container" ).removeClass("otter_is_loading");
                }, 
                
                success: function (data) {
                    productName = $(data).find('.product_title').first().text();
                    productName = productName.replace(/\s+/g, '-');
                        if(!data)// if data is empty do nothing
                        {
                            $('body').attr("style", "");
                            $( "body" ).removeClass("otw-items-open");
                            $(".wp-site-blocks").removeClass("otw-items-body-open");
                            alert( "Opps somthing went wrong. Try again" );
                        }else// else load mobile content
                        {                        
                            $('body').css({
                                'position': 'fixed',
                                'overflow': 'hidden',
                                'top': -position
                              });
                            $('body').addClass('otw-items-open');
                            if (!$('.is-comparying').length) {
                                window.location.hash =  "#product=" + postid + "-" + productName;
                                var $dataWithMain = $(data).addClass('is-main');
                                    $('body').append($dataWithMain);
                                }else{
                                    
                                    comparingID = postid;
                                    var $dataWithClass = $(data).addClass('is-compared');
                                    $('body').append($dataWithClass);
                                    $('.otw-woocommerce-single').addClass("otw-split");
                                    $('.otw-woocommerce-single').removeClass("otw-maximize");
                                    var hash = window.location.hash; // Assign hash to varalible
                                    //var hashid = hash.replace("#", ""); // remove # from number 
                                    var idIndex = hash.indexOf("product=")
                                    var idWithName = hash.substring(idIndex + 8)
                                    var id = idWithName.split("-")[0]
                                    postid = id;                                   
                                }
                            $('otw-woocommerce-single').focus();
                            $( '.woocommerce-product-gallery', data ).each( function() {
                            $( '.woocommerce-product-gallery' ).wc_product_gallery();
                            $('.wp-site-blocks').addClass("otw-items-body-open"); 
                            $.getScript(site.theme_path);

                            $( "body" ).removeClass("otw-loading");
                        } );
                        }
                    
                        },
   
                    });
                   
                    return false; 
        }
        function updateUi() {
            var offestItemMove = moveY;
          
            if (isMoving && moveY > 0) {
              $('.otw-woocommerce-header').removeClass('otw-swipe');
              $('.otw-top').css("transform", "translateY(" +  offestItemMove + 'px' + ")");
              $('.otterwp-opactiy').css("opacity", 1 - (offestItemMove / 300));
              
              if ($(".otw-woo-reviews.otw-woo-reviews-open")[0]) {
                $('.otw-woo-reviews').css("opacity", 1 - (offestItemMove / 300));
                $('.otw-woo-reviews').addClass("no-transition");
                $('.otw-woo-reviews-bg').addClass("no-transition");
              }
          
              requestAnimationFrame(updateUi);
              $('body').css('overflow', 'visible');
            }
          
            if (!isMoving) {
              $('.otw-woocommerce-header').addClass('otw-swipe');
              $('.entry-content').css("opacity", 1);
          
              if ($(".otw-woo-reviews.otw-woo-reviews-open")[0]) {
                $('.otw-woo-reviews').removeClass("no-transition");
                $('.otw-woo-reviews-bg').removeClass("no-transition");
              }
            }
          }

        $(document).on('hashChange', function(e, eventInfo) { 
       e.stopPropagation? e.stopPropagation() : e.cancelBubble = true;
        e.preventDefault();
        
            var subscribers = $('.otterwp-enabled-shopping');
            subscribers.trigger('hashChangeHandler', [eventInfo]);
        });
        $(document).one('onLandEvent', function(e, eventInfo) { 
            var subscribers = $('.otterwp-enabled-shopping');
            subscribers.trigger('onLandHandler', [eventInfo]);
            e.stopPropagation();
        });
        $(window).bind('hashchange', function() {

                $(document).trigger('hashChange', [1011]);
        });
        $(document).on('hashChangeHandler', function(e) {
            var hash = window.location.hash; // Assign hash to varalible
            var hashid = hash.replace("#", ""); // remove # from number
            
            var idIndex = hash.indexOf("product=")
            var idWithName = hash.substring(idIndex + 8)
            var id = idWithName.split("-")[0]
            if (!$(".otw-loading")[0]){
            if(hashid === '')// hash is empte closed page
            {
                MenuIsClosed();
                window.scrollTo({ top: position, left:0, behavior: "instant"});
                $('.wp-site-blocks').removeClass("otw-items-body-open");
            }else{
                if (hash.indexOf("product=") !== -1) {
                if (id === postid)// hash matchs postid open page
                {

                        MenuIsOpen(e);
                        $('.wp-site-blocks').addClass("otw-items-body-open");
                                      
                }else // hash dose not match loads new content
                {
                    postid = id
                    updateItem(e);
                    }
                }else{
                    if(window.location.hash.indexOf("review") !== -1) {
                        window.location.hash =  "#product=" + postid + "-" + productName;
                    }else{
                      $('.wp-site-blocks').removeClass("otw-items-body-open");  
                    }
                    
                }
                return false;    
            } 
        }
       
        });
        $(document).one('onLandHandler', function(e) { 
            if ($('body').hasClass('otw-items-open')) {  
                }else{
                    if ($(".otterwp-enabled-shopping")[0]){
                        if (postid == null){
                            return;
                        }else{  
                            if(window.location.hash.length === 0){
                                return;
                            }else{              
                                var hash = window.location.hash;
                                var idIndex = hash.indexOf("product=")
                                if (idIndex !== -1) {
                                    var idWithName = hash.substring(idIndex + 8)
                                    var id = idWithName.split("-")[0]
                                    postid = id;
                                    updateItem(e);
                                }
                            }
                        }
                    }
            }   
        });  
        window.addEventListener('resize', function() {
            if (window.innerWidth < 768) {
              // Do something when the screen size is below 768 pixels
              $('body').removeClass("is-comparying")
            }else{
                if ($('.otw-woocommerce-single ').hasClass('otw-not-compared')) {
                    $('body').addClass("is-comparying")
                }
            }
          });

});

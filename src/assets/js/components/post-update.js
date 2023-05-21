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
         var menuHeight = 240;
         var postid = "";
    
         function debounce(func, wait = 10, leading = true) {
            var timeout;
            return function() {
              var context = this, args = arguments;
              var later = function() {
                timeout = null;
                if (!leading) func.apply(context, args);
              };
              var callNow = leading && !timeout;
              clearTimeout(timeout);
              timeout = setTimeout(later, wait);
              if (callNow) func.apply(context, args);
            };
          }
    
         $(document).on("touchstart", ".otw-post-header__content",  true, function(evt) {
             startTime = new Date().getTime();
             startY = evt.touches[0].pageY;
             startX = evt.touches[0].pageX;
    
             touchingElement = true;
             touchStart(startY, startX, $(this)); 
              
           });
     
       
           $(document).on("touchend", ".otw-post-header__content",  function() {
       
     
         // Calculating new position of scrollbar
     
             const translateY = currentY - startY; // distance moved in the x axis
             const translateX = currentX - startX; // distance moved in the y axis
     
             const timeTaken = (new Date().getTime() - startTime);
             touchingElement = false;
             touchEnd(currentY, currentX, translateY, translateX, timeTaken, $(this));     
          
         });
         $(document).on("touchmove", ".otw-post-header__content", debounce(function(evt) {
            const hight = this.scrollHeight;
          
            currentY = evt.touches[0].pageY;
            currentX = evt.touches[0].pageX;
            const translateY = currentY - startY; // distance moved in the x axis
            const translateX = currentX - startX; // distance moved in the y axis
            
            touchMove(evt, currentY, currentX, translateY, translateX, hight, $(this));
          }, { passive: true }));
     
       function touchStart(startY, startX) {
         
             $('.otterwp-post-container').addClass('otw-no-transition');
         
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
         function touchMove(evt, currentY, currentY, translateY, translateX, hight, thisObj) {
            var menuHeight = hight;
            if (!dragDirection) {
              dragDirection = Math.abs(translateY) >= Math.abs(translateX) ? "vertical" : "horizontal";
            }
            if (dragDirection === "horizontal") {
              lastY = currentY;
              lastX = currentX;
            } else {
              moveY = Math.min(Math.max(moveY + currentY - lastY, -menuHeight), 0);
              lastY = currentY;
              lastX = currentX;
              var percentageBeforeDif = (Math.abs(moveY) * 100) / menuHeight;
              var percentage = 100 - percentageBeforeDif;
              newOpacity = (maxOpacity * percentage) / 100;
            }
            
            updateUi();
            requestAnimationFrame(touchMove);
          }

               
             
               
     
           
           function touchEnd(currentY, currentX, translateY, translateX, timeTaken, hight, thisObj, position) {
             var menuHeight = hight;
             isMoving = false;
             var velocity = 0.3;
         
             $('.otterwp-post-container').removeClass('otw-no-transition');
                    if (currentY === 0 && currentX === 0) {
                    if (isOpen) {
            
                    } else {
                
            
                    }
                    } else {
                        if (isOpen) {
                            if ((translateY < (-menuHeight) / 2) || (Math.abs(translateY) / timeTaken > velocity)) {
                                    //openMenu(translateY);
                                    closeMenu(translateY, position, currentY, currentX);                   
                                isOpen = false;
                            } else {
                               // openMenu();
                                isOpen = true;
                                translateY = null;
                            }
                        } else {
                            if (translateY > menuHeight / 2 || (Math.abs(translateY) / timeTaken > velocity)) {
                               // openMenu();
                                isOpen = true;
                                translateY = null;
                            } else {
                                closeMenu(translateY);
                               // openMenu(translateY);
                                isOpen = false;
                               
                            }
                
                        }
                    }
             translateY = null;
         }
     
       function closeMenu(translateY) {
    
               if (translateY > 0 || !isOpen) {
               
                closeMenuScroll();  
                window.location.hash = '';
                
                if($(".theme-kadence")[0] != undefined){
                    setTimeout(function () {
                        window.scrollTo({ top: position, left:0, behavior: "instant"});
                    }, 0);
                    }else{
                        window.scrollTo({ top: position, left:0, behavior: "instant"});
                    }
               }else{
               $('body').css('overflow','hidden');
               }
                        
           }
	$( '.view-more-query' ).on( 'click', function( e ) {
		e.preventDefault();

		const self = $( this );
		const queryEl = $( this ).closest( '.wp-block-query' );
		const postTemplateEl = queryEl.find( '.wp-block-post-template' );

		if ( queryEl.length && postTemplateEl.length ) {
			const block = JSON.parse( queryEl.attr( 'data-attrs' ) );
			const maxPages = block.attrs.query.pages || 0;

			$.ajax( {
				url: i18n.ajax_url,
				dataType: 'json html',
				data: {
					action: 'query_render_more_pagination',
					attrs: queryEl.attr( 'data-attrs' ),
					paged: queryEl.attr( 'data-paged' ),
				},
				complete( xhr ) {
					const nextPage = Number( queryEl.attr( 'data-paged' ) ) + 1;

					if ( maxPages > 0 && nextPage >= maxPages ) {
						self.remove();
					}

					queryEl.attr( 'data-paged', nextPage );

					if ( xhr.responseJSON ) {
                    	console.log( xhr.responseJSON ); // eslint-disable-line
					} else {
						const htmlEl = $( xhr.responseText );

						if ( htmlEl.length ) {
							const html = htmlEl.find( '.wp-block-post-template' ).html() || '';

							if ( html.length ) {
								postTemplateEl.append( html );
								return;
							}
						}

						self.remove();
					}
				},
			} );
		}
	} );
    
    $(document).on('click', '.traffic-light-maximize', function(e){
        if ($(".otw-minimize")[0]){
            var scrollPos = $(document).scrollTop() + 46;
            position = scrollPos;
            var container = $('body');
            - container.offset().top 
            + container.scrollTop();
            $('body').css('position','fixed');
            $('body').css('overflow','hidden');
            $('html').css('height', '100vh');
            $('body').css('top', -position);
            console.log(position)
        }
        $('.otterwp-post-container').addClass('otw-maximize');
        $('.otterwp-post-container').removeClass('otw-minimize');
        $('.otterwp-post-container').removeClass('otw-split');
        $('body').addClass('otw-items-open');
        if ($(".otw-moblie")[1]){
            $('.wp-block-query').addClass("otw-items-body-open"); 
            }
    })
    $(document).on('click', '.traffic-light-split', function(e){
        var section = $('.wp-block-post-title[data-attrs=' + postid + ']');
        if ($(".otw-minimize")[0]){
            $('.wp-block-query').animate({
                scrollTop: $(section).offset().top
              }, 'slow'); 
        }
        $('.otterwp-post-container').addClass('otw-split');
        $('.otterwp-post-container').removeClass('otw-maximize');
        $('.otterwp-post-container').removeClass('otw-minimize');
        $('.otterwp-loader-container').removeClass('otw-maximize');
        $('body').addClass('otw-items-open');
        $('.wp-block-query').addClass("otw-items-body-open");

    })
    $(document).on('click', '.traffic-light-close', function(){
        $(".otterwp-post-container").remove();
        $('body').removeClass('otw-items-open');
        $('.wp-block-query').removeClass("otw-items-body-open");
        $('.otterwp-ative').removeClass("otw-top");
        $('.otterwp-loader-container').addClass('otw-maximize');
        $('body').removeClass('otw-items-open');
        $('body').attr("style", "");
        
    });
    $(document).on('click', '.traffic-light-minimize', function(){
        
        if ($(".otter-wp-is-vidoe")[0]){
            $('.otterwp-post-container').addClass('otw-closed-vidoe');
        }
        if ($(".otter-wp-is-audio")[0]){
            $('.otterwp-post-container').addClass('otw-closed-audio');
        }
        $('.otterwp-post-container').removeClass('otw-maximize');
        $('.otterwp-post-container').addClass('otw-minimize');
        $('.otterwp-post-container').removeClass('otw-split');
        $('body').removeClass('otw-items-open');
        $('.wp-block-query').removeClass("otw-items-body-open");
        $('.otterwp-ative').removeClass("otw-top");
        $('body').removeClass('otw-items-open');
        $('body').attr("style", "");
        closeMenuScroll();
    });

    function closeMenuScroll(){
        $('.otterwp-post-container').addClass("otw-minimize");
        $('body').removeClass('otw-items-open');
        //$('.otw-floating-cart').addClass("otw-add-height");
        $('.otw-archive__content').attr("style", "");
        $('.otterwp-post-container').attr("style", "");
    //     if ($(".otw-woo-reviews.otw-woo-reviews-open")[0]){
    //        $('.otw-woo-reviews-bg').removeClass("otw-transition");
    //    }
        $('body').attr("style", "");
        $('html').attr("style", "");
        startY = 0,
        startX = 0;
        currentY = 0,
        currentX = 0; 
        window.scrollTo({ top: position, left:0, behavior: "instant"});
        console.log(position);
    }
    $(document).on('click', '.wp-block-post-title', function(e){
            e.preventDefault();
            postid = $(this).attr('data-attrs');
            updateItem(e);
    });
    const userAgent = navigator.userAgent.toLowerCase();
    const isTablet = /(ipad|tablet|(android(?!.*mobile))|(windows(?!.*phone)(.*touch))|kindle|playbook|silk|(puffin(?!.*(IP|AP|WP))))/.test(userAgent);
    if (isTablet === true){
        $('body').addClass('otw-moblie');// Ipads  
    }
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|SAMSUNG|Samsung|SGH-[I|N|T]|GT-[I|N]|SM-[A|N|P|T|Z]|SHV-E|SCH-[I|J|R|S]|SPH-L/i.test(navigator.userAgent) ) {
        $('body').addClass('otw-moblie');//Mobile divice
    }
    if (navigator.userAgent.match(/Mac/) && navigator.maxTouchPoints && navigator.maxTouchPoints > 2) {
        $('body').addClass('otw-moblie');// Ipads
    }
    // $(window).on("resize", function (e) {
    //     checkScreenSize();
    // });

    // checkScreenSize();
    function updateItem(e, scrollPos) {
        var section = $('.wp-block-post-title[data-attrs=' + postid + ']');

            if ($(".otw-items-open")[0]){
                
            } else if ($(".otw-closed")[0]){
                var scrollPos = $(document).scrollTop() + 46;
                position = scrollPos;
                var container = $('body');
                - container.offset().top 
                + container.scrollTop();
                if ($(".otw-moblie")[1]){
                    $('.wp-block-query').addClass("otw-items-body-open"); 
                    }
                $('.wp-block-query').animate({
                    scrollTop: $(section).offset().top
                  }, 'slow'); 
            }else{
                var scrollPos = $(document).scrollTop() + 46;
                position = scrollPos;
                var container = $('body');
                - container.offset().top 
                + container.scrollTop();
            }
        $(".otterwp-post-container").remove();
            //var alert = ($("html").scrollTop()+ "px");

            // I don't know why the shorthand method had not worked for me as well
            // But this method has worked for me.
            $.ajax({
                type: "POST",
                url: woo_my_ajax_object.ajax_url,
                data: {
                    action: 'sunset_load_more',
                    postid: postid,
                },
                beforeSend: function(){
                    $( ".otw-loading" ).addClass("otter_items_wrap_loading");
                },
                error: function () {
                    $( ".otw-loading" ).removeClass("otter_items_wrap_loading");
                    $('.wp-block-query').removeClass("otw-items-body-open"); 
                    alert( "Opps somthing went wrong. Try again" );
             
                },
                complete: function(){
                    $( ".otw-loading" ).removeClass("otter_items_wrap_loading");
                }, 
                
                success: function (data) {

                        if(!data)// if data is empty do nothing
                        {
                            $('body').attr("style", "");
                            $('html').attr("style", "");
                            $( "body" ).removeClass("otw-items-open");
                            alert( "Opps somthing went wrong. Try again" );
                        }else// else load mobile content
                        {                        
                            if ($(".otw-items-open")[0]){
                            console.log('test')
                        } else if ($(".otw-closed")[0]){
                            $('.wp-block-query').animate({
                                scrollTop: $(section).offset().top
                              }, 'slow'); 
                              
                        }else{
                            $('.wp-block-query').animate({
                                scrollTop: $(section).offset().top
                              }, 'slow'); 
                        }  
                            $("body")
                            .css({ position: "fixed", overflow: "hidden" })
                            .css({ height: "100vh", top: -position })
                            .addClass("otw-items-open")
                            .append(data);
                        
                        $(".wp-block-query").addClass("otw-items-body-open");


                            window.location.hash = postid;

                        }
                        },

            
            })
        }
    
    $(document).on('hashChange', function(e, eventInfo) { 
        e.stopPropagation? e.stopPropagation() : e.cancelBubble = true;
         e.preventDefault();
             var subscribers = $('.theme-ajax-theme');
             subscribers.trigger('hashChangeHandler', [eventInfo]);
         });
         $(document).one('onLandEvent', function(e, eventInfo) { 
             var subscribers = $('.theme-ajax-theme');
             subscribers.trigger('onLandHandler', [eventInfo]);
             e.stopPropagation();
         });
 
         $(window).bind('hashchange', function() {
                 $(document).trigger('hashChange', [1011]);
         });
        
         $(document).on('hashChangeHandler', function(e) {
             var hash = window.location.hash; // Assign hash to varalible
             var hashid = hash.replace("#", ""); // remove # from number
             if(hashid === '')// hash is empte closed page
             {
                 MenuIsClosed();
             }else 
             {
                 if (hashid === postid)// hash matchs postid open page
                 {
                         MenuIsOpen(e);
                                       
                 }else // hash dose not match loads new mobile content
                 {
                     postid = hashid
                     updateItem(e);
                     }
                 }
                 return false;    
         });
         $(document).one('onLandHandler', function(e) { 
             if ($(".theme-ajax-theme")[0]){
                 if (postid == null){
                     return;
                 }else{  
                     if(window.location.hash.length === 0){
                         return;
                     }else{              
                     var hash = window.location.hash;
                     postid = hash.replace("#", "");
                     updateItem(e);
                     }
                 }
             }
             
             
         });
         function MenuIsClosed() { 

            $('.otterwp-ative').removeClass("otw-top");
            $('.otterwp-ative').addClass("otw-bottom");
            $('body').removeClass('otw-items-open');
           // $('.otw-floating-cart').addClass("otw-add-height");
            $('.otterwp-ative').attr("style", "");
            $('.otterwp-ative').attr("style", "");
            if ($(".otter-wp-is")[0]){
               $('.otw-woo-reviews-bg').removeClass("otw-transition");
           }
            $('body').attr("style", "");
            $('html').attr("style", "");
            startY = 0,
            startX = 0;
            currentY = 0,
            currentX = 0; 
           }
           function MenuIsOpen(e) {
                $('.otterwp-ative').removeClass("otw-bottom");
                $('.otterwp-ative').addClass("otw-top");
                $('.wp-site-blocks').addClass("otw-items-open");
                $('body').addClass('otw-items-open');
                $('.otterwp-ative').attr("style", "");
                $('html').css('height', '100vh');
                $('body').css('overflow','hidden');
                $('body').css('position','fixed');
                $('body').css('top', - position);
               
                return false; 
                
           }
           function updateUi() {
            if (isMoving && moveY > 0) {
              $('.otterwp-post-container').removeClass('otw-swipe').css({
                "transform": "translateY(" + moveY + "px)",
                "opacity": newOpacity
              });
              if ($('.otw-woo-reviews').is('.otw-woo-reviews-open')) {
                $('.otw-woo-reviews').addClass("no-transition").css("opacity", newOpacity);
                $('.otw-woo-reviews-bg').addClass("no-transition");
              }
              $('body').css('overflow','visible');
            } else {
              $('.otw-woocommerce-header').addClass('otw-swipe');
              if ($('.otw-woo-reviews').is('.otw-woo-reviews-open')) {
                $('.otw-woo-reviews').removeClass("no-transition");
                $('.otw-woo-reviews-bg').removeClass("no-transition");
              }
            }
           
          }
});
var gesture = {
    x: [],
    y: [],
    match: ''
  },
  tolerance = 200
  toleranceX = 160;
  var touchduration = 500
  var onlongtouch; 
  var timer;
window.addEventListener('touchstart',function(e){
  if (!timer) {
    timer = setTimeout(onlongtouch, touchduration);
}
for (i=0;i<e.touches.length;i++){
  gesture.x.push(e.touches[i].clientX)
  gesture.y.push(e.touches[i].clientY)
}
});
window.addEventListener('touchmove',function(e){
//e.preventDefault()
for (var i=0; i<e.touches.length; i++) {
  gesture.x.push(e.touches[i].clientX)
  gesture.y.push(e.touches[i].clientY)
}
});
window.addEventListener('touchend',function(e){
  if (timer) {
    clearTimeout(timer);
    timer = null;
}
    xTravel = gesture.x[gesture.x.length-1] - gesture.x[0],
    yTravel = gesture.y[gesture.y.length-1] - gesture.y[0];
    
if (xTravel<tolerance && xTravel>-tolerance && yTravel<-tolerance){
  var clientHeight = document.querySelector('.social-icons').clientHeight;
  var trayHeight = document.querySelector('.swipe-left').clientHeight;
  var tolto = trayHeight + clientHeight + 256;
    //this.document.querySelector('.o-container').style.bottom = tolto + "px";
    
    this.document.getElementById('mini-nav').style.bottom = "200px";
    document.querySelector(".mini-nav").classList.add("otter_show");
    //document.querySelector('.bottom-tray').style.maxHeight = "100%";
    document.querySelector('.box').style.maxHeight = "100%";
    //document.querySelector('.otter_container_wrap').classList.remove('otter_show');
    document.querySelector('.otter_bg').classList.remove('otter_show');
    document.querySelector(".bottom-tray").classList.remove("cart-open");
 console.log(tolto);
}
if (xTravel<tolerance && xTravel>-tolerance && yTravel>tolerance){
  //this.document.querySelector('.o-container ').style.bottom = "0px";
    this.document.getElementById('mini-nav').style.bottom = "0px";
    document.querySelector(".mini-nav").classList.remove("otter_show");
    //document.querySelector('.bottom-tray').style.maxHeight = "0px";
    document.querySelector('.box').style.maxHeight = "0px";
    
    
}
if (yTravel<tolerance && yTravel>-toleranceX && xTravel<-toleranceX){
  var singlePost = document.getElementsByClassName('single-post');
  var cart = document.getElementsByClassName('otter_container');
  if (singlePost.length > 0) {
    var singleNext = document.getElementsByClassName('c-post-navigation__post--next');
    if(singleNext.length > 0){
      var url = document.querySelector(".c-post-navigation__post--prev .c-post-navigation__link").getAttribute("href");
      window.location.href = url;
    }else{
      
    }
    }else{
      if (cart.length > 0) {
      document.querySelector(".otter_container_wrap").classList.remove("otter_show");
      document.querySelector(".otter_bg").classList.remove("otter_show");
      document.querySelector(".bottom-tray").classList.remove("cart-open");
    }else{
      
      document.querySelector(".menu").classList.remove("is-visible");
      document.querySelector(".overlay").classList.remove("active");
    }
    }
}
if (yTravel<tolerance && yTravel>-toleranceX && xTravel>toleranceX){
  var singlePost = document.getElementsByClassName('single-post');
  var cart = document.getElementsByClassName('otter_container');
  if (singlePost.length > 0) {
    var singlePrev = document.getElementsByClassName('c-post-navigation__post--prev');
    if(singlePrev.length > 0){
      var url = document.querySelector(".c-post-navigation__post--next .c-post-navigation__link").getAttribute("href");
      window.location.href = url;
    }else{
    }
    }else{
      if (cart.length > 0) {
      document.querySelector(".otter_container_wrap").classList.add("otter_show");
      document.querySelector(".otter_bg").classList.add("otter_show");
      document.querySelector(".mini-nav").classList.remove("otter_show");
      this.document.getElementById('mini-nav').style.bottom = "0";
      document.querySelector(".otter_container").style.height = "calc(100% - 46px)";
      //document.querySelector('.bottom-tray').style.maxHeight = "0px";
      document.querySelector('.box').style.maxHeight = "0px";
      document.querySelector(".bottom-tray").classList.add("cart-open");
    }else{
      
      document.querySelector(".menu").classList.add("is-visible");
      document.querySelector(".overlay").classList.add("active");
    }
    }
}


setTimeout(function(){
 
    
},100)
gesture.x = []
gesture.y = []
gesture.match = xTravel = yTravel = ''

},100)
var singlePost = document.getElementsByClassName('single-post');
if (singlePost.length > 0) {
  var singleNext = document.getElementsByClassName('c-post-navigation__post--prev');
  if(singleNext.length > 0){
    let prev = document.querySelector(".c-post-navigation__post--prev")
    var pgNav = document.querySelector('.swipe-left__title');
    var dupe = prev.cloneNode(true);
    pgNav.appendChild(dupe);
    var right = document.createElement('p');
    right.innerHTML = 'swipe Left to Prev Post!';
    right.className = 'cart-swipe';
    document.querySelector('.swipe-left__title').appendChild(right);
    
  
  }else{
    document.querySelector(".swipe-left").remove();
  }
  var singlePrev = document.getElementsByClassName('c-post-navigation__post--next');
  if(singlePrev.length > 0){
    let prev = document.querySelector(".c-post-navigation__post--next")
    var pgNav = document.querySelector('.swipe-right__title');
    var dupe = prev.cloneNode(true);
    pgNav.appendChild(dupe);
    var right = document.createElement('p');
    right.innerHTML = 'swipe Right to Next Post!';
    right.className = 'cart-swipe';
    document.querySelector('.swipe-right__title').appendChild(right);
  
  }else{
    document.querySelector(".swipe-right").remove();
  }
}else{
  console.log('test');
  var cart = document.getElementsByClassName('otter_container');
  if (cart.length > 0) {
  var left = document.createElement('p');
  left.innerHTML = 'Swipe Left to close cart!!';
  left.className = 'cart-close';
  document.querySelector('.swipe-left__title').appendChild(left);
  var right = document.createElement('p');
  right.innerHTML = 'swipe Right to Open cart!';
  right.className = 'cart-open';
  document.querySelector('.swipe-right__title').appendChild(right);
}else{
  var leftMenu = document.createElement('p');
  leftMenu.innerHTML = 'Swipe Left to close Menu!!';
  leftMenu.className = 'cart-close';
  document.querySelector('.swipe-left__title').appendChild(leftMenu);
  var rightMenu = document.createElement('p');
  rightMenu.innerHTML = 'swipe Right to Open Menu!';
  rightMenu.className = 'cart-open';
  document.querySelector('.swipe-right__title').appendChild(rightMenu);
}
}
function preventDefault(e){
  e.preventDefault();
}

function disableScroll(){
  document.body.addEventListener('touchmove', preventDefault, { passive: false });
}
function enableScroll(){
  document.body.removeEventListener('touchmove', preventDefault);
}
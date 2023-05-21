// Create the arrays for recently viewed products and wishlist
var recentlyViewed = [];
var wishlist = [];

function addProductIdToRecentViews() {
    var productInfos = document.getElementsByClassName("woocommerce-page");
    for (var i = 0; i < productInfos.length; i++) {
        var classes = productInfos[i].classList;
        for (var j = 0; j < classes.length; j++) {
            if (classes[j].startsWith("data-product-id-")) {
                var productId = classes[j].split("-")[3];
                var productId = classes[j].split("-")[3];
                if (document.body.classList.contains("single-product")) {
                    addToRecentlyViewed(productId);
                }
                break;
            }
        }
    }
}
function addToRecentlyViewed(productId) {
    var productId = Number(productId);
    if (!isNaN(productId)) {
        var index = recentlyViewed.indexOf(productId);
        // Check if product already exist in the array
        if (index !== -1) {
            // Product already exist in the array, remove it
            recentlyViewed.splice(index, 1);
        }
        // Add product to the beginning of the array
        recentlyViewed.unshift(productId);
        // Keep the array limited to 10 items
        if (recentlyViewed.length > 10) {
            recentlyViewed.pop();
        }
        createCookie("recentlyViewed", JSON.stringify(recentlyViewed), 365);
    }
}
function createCookie(name, value, days) {
    var expires;
    var cookieValue = getCookie(name);
    var ids = cookieValue ? JSON.parse(cookieValue) : [];
    var currentDate = new Date();
    expires = "; expires=" + currentDate.setDate(currentDate.getDate() + days);
    if (!ids.includes(value)) {
        ids.unshift(value); // Add the new value to the beginning of the array
        if (ids.length > 10) {
            ids.pop(); // Remove the last element if the array is longer than 10
        }
    }
    document.cookie = name + "=" + JSON.stringify(ids) + expires + "; path=/";
}
// Function to set a cookie
var existingValue = JSON.parse(getCookie(name));
function createWishlistCookie(value, days) {
    var expires = "";
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toUTCString();
    var existingValue = JSON.parse(getCookie('wishlist')) || [];
    if(existingValue.includes(value)){
        return;
    }
    existingValue.push(value);
    document.cookie = 'wishlist' + "=" + JSON.stringify(existingValue) + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

// Function to check if a cookie exists
function checkCookie() {
    var recentlyViewedCookie = getCookie("recentlyViewed");
    if (recentlyViewedCookie != null) {
        recentlyViewed = JSON.parse(recentlyViewedCookie);
    } else {
        recentlyViewed = [];
    }
    var wishlistCookie = getCookie("wishlist");
    if (wishlistCookie != null) {
        wishlist = JSON.parse(wishlistCookie);
    } else {
        wishlist = [];
    }
}

function addToWishlist(productId) {
    var wishlist = JSON.parse(getCookie('wishlist')) || [];
    wishlist.push(productId);
    createCookie('wishlist', wishlist, 365);
}

function removeFromWishlist(productId) {
    var wishlist = JSON.parse(getCookie('wishlist')) || [];
    var index = wishlist.indexOf(productId);
    if (index > -1) {
        wishlist.splice(index, 1);
    }
    createWishlistCookie('wishlist', wishlist, 365);
}

function addProductIdToWishlist() {
    var checkbox = document.querySelector('.wishlist-checkbox');
    checkbox.addEventListener("click", function(e) {
        console.log('click');
        e.stopPropagation();
        if(checkbox.checked) {
            var productId = checkbox.dataset.productId;
            addToWishlist(productId);
        } else {
            var productId = checkbox.dataset.productId;
            removeFromWishlist(productId);
        }
    });
}
window.onload = function() {
    console.log('test')
    addProductIdToRecentViews();
  // Get all the checkbox elements with data-product-id attribute
  var checkboxes = document.querySelectorAll("[data-product-id]");

  // Get the wishlist cookie
  var wishlist = JSON.parse(getCookie("wishlist")) || [];
  // Loop through all checkboxes
  for (var i = 0; i < checkboxes.length; i++) {
    var checkbox = checkboxes[i];
    var productId = checkbox.dataset.productId;
    // Check if the product is already in the wishlist
    if (wishlist.includes(productId)) {
        checkbox.checked = true;
        checkbox.classList.add("checked");
    }
  }
    // Check if the recently viewed cookie exists
    var recentlyViewedCookie = getCookie("recentlyViewed");
    if (recentlyViewedCookie != null) {
        recentlyViewed = JSON.parse(recentlyViewedCookie);
    } else {
        recentlyViewed = [];
    }
    // Check if the wishlist cookie exists
    var wishlistCookie = getCookie("wishlist");
    if (wishlistCookie != null) {
        wishlist = JSON.parse(wishlistCookie);
    } else {
        wishlist = [];
    }
    // Log the recently viewed array to the console
    console.log("Recently Viewed:", recentlyViewed);
    // Log the wishlist array to the console
    console.log("Wishlist:", wishlist);
}
// Add event listener to the checkbox
var checkbox = document.querySelector(".wishlist-checkbox");
checkbox.addEventListener("click", toggleWishlist);
// Get the wishlist cookie
var wishlist = JSON.parse(getCookie("wishlist")) || [];
// Get the product id from the checkbox
var productId = checkbox.dataset.productId;
// Check if the product is already in the wishlist
if (wishlist.includes(productId)) {
    checkbox.checked = true;
}
function toggleWishlist() {
    var productId = this.dataset.productId;
    var wishlist = JSON.parse(getCookie("wishlist")) || [];
    var wishlistIndex = wishlist.indexOf(productId);
    if (wishlistIndex === -1) {
        wishlist.push(productId);
        this.checked = true;
    } else {
        wishlist.splice(wishlistIndex, 1);
        this.checked = false;
    }
    createWishlistCookie(productId, 365);
}

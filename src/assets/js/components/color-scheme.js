import $ from 'jquery';
function setBodyClass() {
  // Get the background color of the body element
  var bgColor = $('body').css('background-color');

  // Convert the background color to RGB
  var rgb = bgColor.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);

  // Get the red, green, and blue values from the RGB values
  var r = parseInt(rgb[1]);
  var g = parseInt(rgb[2]);
  var b = parseInt(rgb[3]);

  // Calculate the luminance of the background color
  var luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;

  // Add a class of 'light' or 'dark' to the body element
  $('body').addClass(luminance > 0.5 ? 'light' : 'dark');
}

$(document).ready(function() {
  setBodyClass();
});
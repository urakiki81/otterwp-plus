<?php
/**
 * Template part for loading
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package     Otterwp
 * @author      Otterwp
 * @link        https://www.otterwp.io/
 * @since       Otterwp 1.0
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$desktop_mode  = get_option('otterwp_desktop_fullscreen');
?>
<div class="otterwp-loader-container <?php if (strlen($desktop_mode) === 0) {
	 echo 'otw-split';
   } else {
	echo 'otw-maximize';
   }
   ?>">
    <div class="mobile-header">
        <div class="mobile-img"></div>
        <div class="mobile-details">
            <span class="name"></span>
            <span class="about"></span>
        </div>
        <div class="line"></div>
    </div>
<div class="card">
    <div class="header">
      <div class="img"></div>
      <div class="details">
        <span class="name"></span>
        <span class="about"></span>
        <div class="line"></div>
      </div>
    </div>
    <div class="content">  
        <div class="btns">
            <div class="btn btn-1"></div>
            <div class="btn btn-2"></div>
        </div>
      <div class="line"></div>
      <div class="line line-3"></div>
      <div class="line"></div>
    </div>
    
    <div class="content-Related">
      <div class="img"></div>
      <div class="img"></div>
      <div class="img"></div>
      <div class="img"></div>     
  </div>
</div>
jQuery( document ).ready( function( $ ) {


// zoom product page
function zoomImage() {
	if ( $( 'html' ).hasClass( 'mobile' ) ) {
		$( '.js_zoom_wrap' ).on( 'touchstart', function() {
								$( 'html' ).addClass( 'overflow-hidden' );
								$( '.js_zoom_element' ).addClass( 'zoomOn' ).css({
									'background-image': 'url('+ $( '[data-zoom-img]:not(.d-none)' ).attr( 'data-zoom-img' ) +')',
								});
							}).on( 'touchend', function() {
								$( 'html' ).removeClass( 'overflow-hidden' );
								$( '.js_zoom_element' ).removeClass( 'zoomOn' );
							}).on( 'touchmove', function( e ) {
								$( 'html' ).addClass( 'overflow-hidden' );
								$( '.js_zoom_element' ).css({
									'background-position': ( ( e.touches[0].clientX - $( this ).offset().left ) / $( this ).width() ) * 100 + '% ' + ( ( e.touches[0].clientY - $( this ).offset().top ) / $( this ).height() ) * 100 +'%'
								});
							});
	} else {
		$( '.js_zoom_wrap' ).on( 'mouseover', function() {
								$( '.js_zoom_element' ).addClass( 'zoomOn' ).css({
									'background-image': 'url('+ $( '[data-zoom-img]:not(.d-none)' ).attr( 'data-zoom-img' ) +')',
								});
							}).on( 'mouseout', function() {
								$( '.js_zoom_element' ).removeClass( 'zoomOn' );
							}).on( 'mousemove', function( e ) {
								$( '.js_zoom_element' ).css({
									'background-position': ( ( e.pageX - $( this ).offset().left ) / $( this ).width() ) * 100 + '% ' + ( ( e.pageY - $( this ).offset().top ) / $( this ).height() ) * 100 +'%'
								});
							});
	}
}
zoomImage();


// switch main image by hover/click on thumbnail
$( document ).on( 'click mouseover', '.js_thumbnail:not(.is_active)', function ( e ) {
	e.preventDefault();
	var $this = $( this );
	var thumbnail_parent = $this.closest( '.js_wrap_img_thumbnails' );
	var mainImg = thumbnail_parent.find( '.js_main_img' );
	thumbnail_parent.find( '.js_main_img' ).addClass( 'main_loading' );
	thumbnail_parent.find( '.is_active' ).removeClass( 'is_active' );
	$this.addClass( 'is_active' );
	mainImg.find( 'source' ).attr( 'srcset', $this.find( 'source' ).attr( 'srcset' ) );
	mainImg.find( 'img' ).attr( 'srcset', $this.find( 'img' ).attr( 'srcset' ) );
	mainImg.find( 'img' ).attr( 'src', $this.find( 'img' ).attr( 'src' ) );
	mainImg.attr( 'data-zoom-img', $this.attr( 'data-zoom-img' ) );
	$( '.js_main_img img' ).on( 'load', function() {
		$( this ).closest( '.js_wrap_img_thumbnails' ).find( '.js_main_img' ).removeClass( 'main_loading' );
	});
});


// thumbnails carousel for main img
function initThumbnailMainImgCarousel() {
	var $this = $( '.js_thumbnail_carousel_main_img' );
	var prevArrow = $this.find( '.js_carousel_control_prev' );
	var nextArrow = $this.find( '.js_carousel_control_next' );
	$this.find( '.js_carousel' ).slick({
		prevArrow: prevArrow,
		nextArrow: nextArrow,
		touchThreshold: 40,
		infinite: false,
		slidesToScroll: 1,
		slidesToShow: 6,
		responsive: [
			{
				breakpoint: 1199,
				settings: { slidesToShow: 5 }
			},
			{
				breakpoint: 991,
				settings: { slidesToShow: 3 }
			}
		]
	});
}
initThumbnailMainImgCarousel();


// IMAGE MODAL
// set modal fullheight
function calcSizeImageModal( selector ) {
	var windowHeight = window.innerHeight;
	var modalHeaderHeight = selector.find( '.modal-header' ).outerHeight();
	var modalFooterHeight = selector.find( '.modal-footer' ).outerHeight();
	selector.find( '.js_main_img img' ).css( 'max-height', windowHeight - modalHeaderHeight -modalFooterHeight );
}
// init carousel
function initThumbnailModalCarousel() {
	var $this = $( '.js_thumbnail_carousel_modal' );
	var prevArrow = $this.find( '.js_carousel_control_prev' );
	var nextArrow = $this.find( '.js_carousel_control_next' );
	$this.find( '.js_carousel' ).slick({
		prevArrow: prevArrow,
		nextArrow: nextArrow,
		touchThreshold: 40,
		infinite: false,
		slidesToScroll: 1,
		slidesToShow: 6,
		responsive: [
			{
				breakpoint: 575,
				settings: { slidesToShow: 3 }
			}
		]
	});
}
// open modal
$( document ).on( 'shown.bs.modal', '.js_img_modal', function() {
	initThumbnailModalCarousel();
	calcSizeImageModal( $( '.js_img_modal.show' ) );
	$( '.js_comment_img_modal .slick-slide:first-child .js_thumbnail' ).addClass( 'is_active' );
	$( window ).resize( function() {
		if ( $( '.js_img_modal.show' ).hasClass( 'show' ) ) {
			calcSizeImageModal( $( '.js_img_modal.show' ) );
		}
	});
});
// hide modal
$( document ).on( 'hidden.bs.modal', '.js_img_modal', function() {
	$( '.js_thumbnail_carousel_modal .js_carousel' ).slick( 'unslick' );
})
// switch img by click on main image inside modal
$( document ).on( 'click', '.modal .js_main_img', function(e) {
	e.preventDefault();
	var modal = $( this ).closest( '.modal' );
	var activeSlide = modal.find( '.is_active' );
	activeSlide.closest( '.slick-slide' ).next().find( '.js_thumbnail' ).click();
});


// plus/minus product
$( document ).on( 'click', '.js_minus_count_btn_product', function( e ) {
	e.preventDefault();
	var parent = $( this ).closest( '.js_count_add_product' );
	var currentValue = +parent.find( 'input[type="number"]' ).val();
	if ( currentValue > 1 ) {
		var newCurrentValue = --currentValue;
		parent.find( 'input[type="number"]' ).val( newCurrentValue );
		$( '.js_add_to_cart_btn' ).attr( 'data-quantity', newCurrentValue );
	}
});
$( document ).on( 'click', '.js_plus_count_btn_product', function( e ) {
	e.preventDefault();
	var parent = $( this ).closest( '.js_count_add_product' );
	var currentValue = +parent.find( 'input[type="number"]' ).val();
	var newCurrentValue = ++currentValue;
	parent.find( 'input[type="number"]' ).val( newCurrentValue );
	$( '.js_add_to_cart_btn' ).attr( 'data-quantity', newCurrentValue );
});


})
<?php
/**
* Helper functions related to image lives here
* @since Education Booster 1.0.0
*/
if ( ! function_exists( 'educationbooster_get_image_sizes' ) ) :
/**
 * Get size information for all currently-registered image sizes.
 *
 * @since  Education Booster 1.0.0
 * @global $_wp_additional_image_sizes
 * @uses   get_intermediate_image_sizes()
 * @return array $sizes Data for all currently-registered image sizes.
 */
function educationbooster_get_image_sizes() {
	global $_wp_additional_image_sizes;

	$sizes = array();

	foreach ( get_intermediate_image_sizes() as $_size ) {
		if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
			$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
			$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
			$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
		} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
			$sizes[ $_size ] = array(
				'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
				'height' => $_wp_additional_image_sizes[ $_size ]['height'],
				'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
			);
		}
	}

	return $sizes;
}
endif;

if ( ! function_exists( 'educationbooster_get_image_size' ) ) :
/**
* Get size information for a specific image size.
*
* @since  Education Booster 1.0.0
* @uses   educationbooster_get_image_sizes()
* @param  string $size The image size for which to retrieve data.
* @return bool|array $size Size data about an image size or false if the size doesn't exist.
*/
function educationbooster_get_image_size( $size ) {
	$sizes = educationbooster_get_image_sizes();

	if ( isset( $sizes[ $size ] ) ) {
		return $sizes[ $size ];
	}

	return false;
}
endif;

if ( ! function_exists( 'educationbooster_get_image_width' ) ) :
/**
* Get the width of a specific image size.
*
* @since  Education Booster 1.0.0
* @uses   educationbooster_get_image_size()
* @param  string $size The image size for which to retrieve data.
* @return bool|string $size Width of an image size or false if the size doesn't exist.
*/
function educationbooster_get_image_width( $size ) {
	if ( ! $size = educationbooster_get_image_size( $size ) ) {
		return false;
	}

	if ( isset( $size['width'] ) ) {
		return $size['width'];
	}

	return false;
}
endif;

if ( ! function_exists( 'educationbooster_get_image_height' ) ) :
/**
* Get the height of a specific image size.
*
* @since  Education Booster 1.0.0
* @uses   educationbooster_get_image_size()
* @param  string $size The image size for which to retrieve data.
* @return bool|string $size Height of an image size or false if the size doesn't exist.
*/
function educationbooster_get_image_height( $size ) {
	if ( ! $size = educationbooster_get_image_size( $size ) ) {
		return false;
	}

	if ( isset( $size['height'] ) ) {
		return $size['height'];
	}

	return false;
}
endif;


if( ! function_exists( 'educationbooster_post_thumbnail' ) ):
/**
* Prints featured image or dummy image if no featured image for posts
*
* @since  Education Booster 1.0.0
* @param  array $args
* @param  bool $show_eye whether to show eye icon while hover. default: true.
* @return void
*/
function educationbooster_post_thumbnail( $args ){

	$defaults = array(
		'size'      => 'large',
		'dummy'     => true,
		'permalink' => true
	);

	$args = wp_parse_args( $args, $defaults );
	# Don't print even the div when no thumbnail and dummy is disabled
	if( '' == get_the_post_thumbnail() && !$args[ 'dummy' ] ){
		return;	
	} 
	?>
	<div class="post-thumb">
	    <figure>
    	<?php 
	    	if (  '' !== get_the_post_thumbnail() ){
	    		the_post_thumbnail( $args[ 'size' ] ); 
	    	}else{

	    		# Returns the placeholder image
	    		$feat_image_url = educationbooster_get_dummy_image( array(
	    			'size' => $args[ 'size' ]
	    		) );
	    		echo sprintf( '<img src="%s" >', esc_url( $feat_image_url ) ); 
	    	}
    	?>
    	<?php if( $args[ 'permalink' ] ): ?>
	        <a href="<?php the_permalink(); ?>"></a>
    	<?php endif; ?>
	    </figure>
	</div>
	<?php
}
endif;

if ( ! function_exists( 'educationbooster_get_dummy_image' ) ) :
/**
* Generates placeholder image url
*
* @since  Education Booster 1.0.0
* @param  string $size The image size for which to retrieve data.
* @return string Url of the dummy image. 
*/
function educationbooster_get_dummy_image( $args ) {
    
    $defaults = array(
        'size' => 'thumbnail',
    );

    $args = wp_parse_args( $args, $defaults );

    if( 'thumbnail' == $args[ 'size' ] ){
    	
    	$width = $height = '150';
    }else if( 'medium' == $args[ 'size' ] ){

    	$width = $height = '300';
    }else if( 'large' == $args[ 'size' ] ){

    	$width = $height = '1024';
	}else{

	    $width  = educationbooster_get_image_width( $args[ 'size' ] );
	    $height = educationbooster_get_image_height( $args[ 'size' ] );
    }

    $url = get_theme_file_uri( 'assets/images/placeholder/education-booster-' . $width . '-' . $height . '.png' );

    return apply_filters( 'educationbooster_dummy_image_url', $url, $args );
}
endif;

if( ! function_exists( 'educationbooster_get_thumbnail_url' ) ):
/**
* Gets the url of Featured Image if not a dummy url.
*
* @since Education Booster 1.0.0
* @return string | NULL
*/
function educationbooster_get_thumbnail_url( $args ){

	$defaults = array(
		'size'  => 'large',
		'dummy' => true
	);

	$args = wp_parse_args( $args, $defaults );
	$dummy = false;

	if( $args[ 'dummy' ] ){
		$dummy =  educationbooster_get_dummy_image( array(
	    	'size' => $args[ 'size' ],
	    ));
	}

	$url = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), $args[ 'size' ] ) : $dummy;
	
	return $url;
}
endif;

if( !function_exists( 'educationbooster_get_callback_banner_url' ) ):
/**
* Return banner image url for callback section
* @uses educationbooster_get_thumbnail_url
* @since Education Booster 1.0.0
*/
function educationbooster_get_callback_banner_url(){

	$image = educationbooster_get_thumbnail_url( array(
		'size'  => 'full',
		'dummy' => false
	));

	if( !$image ){
		$image = get_theme_file_uri( '/assets/images/placeholder/education-booster-banner-1920-650.jpg' );
	}

	return apply_filters( 'educationbooster_callback_banner_image', $image );
}
endif;
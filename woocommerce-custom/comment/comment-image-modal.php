<?php
/**
 * Image modal
 *
 * @package starter
 */

defined( 'ABSPATH' ) || exit;

$starter_comment            = get_comment( $starter_comment_id );
$starter_comment_author     = $starter_comment->comment_author;
$starter_comment_thumbnails = get_field( 'comment_image', $starter_comment );
$starter_comment_total_img  = count( $starter_comment_thumbnails );
?>

<div class="modal img_modal js_img_modal js_comment_img_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content js_wrap_img_thumbnails">
			<div class="modal-header">
				<h3 class="modal-title">
					<?php
						echo esc_html( $starter_comment_author );
						/* translators: count images of comment. */
						printf( esc_html( _n( ' Attached %s Photo', ' Attached %s Photos', $starter_comment_total_img, 'starter' ) ), esc_html( $starter_comment_total_img ) );
					?>
				</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="<?php esc_attr_e( 'Close', 'starter' ); ?>"><?php echo starter_get_svg( array( 'icon' => 'bi-remove' ) ); ?></button>
			</div>
			<div class="modal-body">
				<picture class="item_img js_main_img">
					<?php
						echo wp_kses(
							starter_img_func(
								array(
									'img_src'   => 'w1600',
									'img_sizes' => 'calc(100vw - 32px)',
									'img_id'    => $starter_comment_thumbnails[0],
								)
							),
							wp_kses_allowed_html( 'post' )
						);
						?>
				</picture>
			</div>
			<div class="modal-footer">
				<div class="wrap_carousel thumbnail_carousel object_fit js_thumbnail_carousel_modal">
					<div class="js_carousel">
						<?php foreach ( $starter_comment_thumbnails as $starter_key => $starter_comment_modal_img ) : ?>
							<div>
								<picture class="thumbnail js_thumbnail">
									<?php
										echo wp_kses(
											starter_img_func(
												array(
													'img_src'   => 'w200',
													'img_sizes' => '80px',
													'img_id'    => $starter_comment_modal_img,
												)
											),
											wp_kses_allowed_html( 'post' )
										);
									?>
								</picture>
							</div>
						<?php endforeach; ?>
					</div>
					<button class="btn carousel_control_prev js_carousel_control_prev" aria-label="Carousel scroll previous"><?php echo starter_get_svg( array( 'icon' => 'bi-chevron-left' ) ); ?></button>
					<button class="btn carousel_control_next js_carousel_control_next" aria-label="Carousel scroll next"><?php echo starter_get_svg( array( 'icon' => 'bi-chevron-left' ) ); ?></button>
				</div>
			</div>
		</div>
	</div>
</div>

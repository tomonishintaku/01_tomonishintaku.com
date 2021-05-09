<?php
/**
 * This file is used for your audio post entry
 * @package Thoughts WordPress Theme
 * @since 1.0
 * @author AJ Clarke : http://wpexplorer.com
 * @copyright Copyright (c) 2012, AJ Clarke
 * @link http://wpexplorer.com
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
?>

<?php wpex_hook_content_before(); ?>
<article <?php post_class('post-entry clearfix'); ?>>
<?php wpex_hook_content_top(); ?> 

	<?php
	// Show Featured Image
	if( has_post_thumbnail() ) { ?>
		<div class="post-entry-thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo aq_resize( wp_get_attachment_url( get_post_thumbnail_id(), 'full' ),  wpex_img( 'blog_width' ), wpex_img( 'blog_width' ), wpex_img( 'blog_crop' ) ); ?>" alt="<?php echo the_title(); ?>" /></a>
		 </div><!-- /blog-entry-thumbnail -->
	<?php }
	// Get Audio Meta
	$wpex_post_audio_mp3 = get_post_meta($post->ID, 'wpex_post_audio_mp3', true);
	$wpex_post_audio_ogg = get_post_meta($post->ID, 'wpex_post_audio_ogg', true);
	
	// Show Audio Player if the meta options aren't blank
	if($wpex_post_audio_mp3 || $wpex_post_audio_ogg) {
		
		// Get audio player scripts
		wp_enqueue_script('jplayer', get_template_directory_uri() .'/js/jquery.jplayer.min.js', array('jquery'), '2.1.0', true);
		wp_enqueue_style( 'wpex-audioplayer', WPEX_CSS_DIR .'/audioplayer.css' ); ?>
	
		<script type="text/javascript">
		jQuery(function($){
			jQuery(document).ready(function($){
				if( $().jPlayer ) {
					  $("#jquery_jplayer_<?php echo $post->ID; ?>").jPlayer({
						  ready: function () {
							  $(this).jPlayer("setMedia", {
									poster: "<?php echo wp_get_attachment_url( get_post_thumbnail_id(), 'full' ); ?>",
									mp3: "<?php echo $wpex_post_audio_mp3; ?>",
									oga: "<?php echo $wpex_post_audio_ogg; ?>"
							  });
							  },
						  cssSelectorAncestor: "#jp_interface_<?php echo $post->ID; ?>",
						  swfPath: "<?php echo get_template_directory_uri(); ?>/js",
						  supplied: "<?php if($wpex_post_audio_ogg) echo 'oga'; ?><?php if($wpex_post_audio_mp3 && $wpex_post_audio_ogg) echo','; ?><?php if($wpex_post_audio_mp3) echo 'mp3'; ?>"
					  });
				  
				  }
			  });
		  });
		</script>
		<div id="jquery_jplayer_<?php echo $post->ID; ?>" class="jp-jplayer"></div>
		<div id="jp_container_<?php echo $post->ID; ?>" class="jp-audio">
			<div id="jp_interface_<?php echo $post->ID; ?>" class="jp-gui jp-interface">
				<ul class="jp-controls">
					<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
					<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
					<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
					<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
				</ul>
				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div>
				</div>
				<div class="jp-volume-bar">
					<div class="jp-volume-bar-value"></div>
				</div>
			</div><!-- /jp_interface_<?php echo $post->ID; ?> -->
		</div><!-- .jp-jplayer -->
	<?php } ?>

	<?php
	/**
	 * Single Posts
	 * @since 1.0
	 */
	if ( is_singular() && is_main_query() ) { ?>
	
		<div class="post-entry-text clearfix">
			<header>
				<h1><?php the_title(); ?></h1>
				<ul class="post-entry-meta">
					<li><?php echo get_the_date(); ?></li>
					<li>By: <?php the_author_posts_link(); ?></li>
				</ul>
			</header>
			<div class="post-entry-content">
				<?php the_content(''); ?>
			</div><!-- /post-entry-content -->
			<footer class="post-entry-footer">
				<p><?php _e('Categorized','wpex'); ?>: <?php the_category(' - '); ?></p>
				<?php the_tags( '<p>'. __('Tagged','wpex') .': ',' - ', '</p>'); ?>
			</footer><!-- /post-entry-footer -->
			<?php comments_template(); ?>
		</div><!-- /post-entry-text -->
	
	<?php
	/**
	 * Entries
	 * @since 1.0
	 */
	} else { ?>
	
		<div class="post-entry-text clearfix">
			<header>
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<ul class="post-entry-meta">
					<li><?php echo get_the_date(); ?></li>
					<li>By: <?php the_author_posts_link(); ?></li>
				</ul>
			</header>
			<div class="post-entry-content">
				<?php if ( '1' == get_theme_mod( 'wpex_blog_excerpt', '1' ) ) {
					the_excerpt();
					} else {
						the_content('');
					} ?>
			</div><!-- /post-entry-content -->
			<footer class="post-entry-footer">
				<?php if(comments_open()) { ?><?php comments_popup_link(__('0 Comments', 'wpex'), __('1 Comment', 'wpex'), __('% Comments', 'wpex'), 'comments-link' ); ?><?php } ?><span class="wpex-icon-minus"></span><a href="<?php the_permalink(); ?>" title="<?php _e('read more','wpex'); ?>"><?php _e('read more','wpex'); ?> &rarr;</a>
			</footer><!-- /post-entry-footer -->
		</div><!-- /post-entry-text -->
		
	<?php } ?>
	
<?php wpex_hook_content_bottom(); ?>
</article><!-- /post-entry -->
<?php wpex_hook_content_after(); ?>
<?php //if ( !class_exists( 'skivvy_video_box' ) ) : class skivvy_video_box {







/*
**		REGISTER
**
*/
function register_video_box( $post_type ) {

	global $post;

	add_meta_box (
		'skivvy_video_box', // $id
		'Video Background', // $title
		'render_video_box', // $callback
		'skivvy_slider', // $post_type
		'normal', // $context
		'default' // $priority
		// $callback_args
	);

}
add_action('add_meta_boxes', 'register_video_box' );



function admin_scripts_video_box() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
}
add_action('admin_enqueue_scripts', 'admin_scripts_video_box');








/*
**		RENDER
**
*/
	function render_video_box () {

			global $post;
			$video_box_data = get_post_meta( $post->ID );

			// Add an nonce field so we can check for it later.
			wp_nonce_field( basename( __FILE__ ), 'skivvy_video_box_nonce' );

			?>
			<pre style="display:none;"><?php print_r($video_box_data)?></pre>
			<fieldset title="_video_bg_group" class="video-box-fieldset video_bg_group">
				<div>
					<label for="_video_bg_group">Video URL</label>
					<input type="text" class="video-box-url" id="_video_bg_url" name="_video_bg_url" value="<?php echo esc_attr( $video_box_data['_video_bg_url'][0] ); ?>" size="25">
					<input type="button" class="video-box-url-button" id="_video_bg_url_button"	name="_video_bg_url_button"	value="Upload" >
				</div>
				<script>jQuery(document).ready( function( $ ) {
					var _custom_media = true,
						_orig_send_attachment = wp.media.editor.send.attachment;

					$('#_video_bg_url_button').click(function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id').replace('_button', '');
						_custom_media = true;
						wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								$("#"+id).val(attachment.url);
							} else {
								return _orig_send_attachment.apply( this, [props, attachment] );
							};
					}

					wp.media.editor.open(button);
						return false;
					});

					$('.add_media').on('click', function(){
						_custom_media = false;
					});
				});</script>

			</fieldset>
			<div class="clear"></div>
			<?php
	}

/*
**		SAVE
**
*/
	function save_video_box ( $post_id, $post ) {
			$is_autosave = wp_is_post_autosave( $post_id );
			$is_revision = wp_is_post_revision( $post_id );
			$is_valid_nonce = ( isset( $_POST[ 'skivvy_video_box_nonce' ] ) && wp_verify_nonce( $_POST[ 'skivvy_video_box_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

			// Verify the nonce before proceeding.
			if ( $is_autosave || $is_revision || !$is_valid_nonce )
				return;

			//update_post_meta($post_id, $meta_key, $meta_value, $prev_value)
			update_post_meta( $post_id, "_video_bg_url", sanitize_text_field( $_POST["_video_bg_url"] ) );
	}
	add_action('save_post', 'save_video_box', 10, 2 );

















/* http://demosthenes.info/blog/777/Create-Fullscreen-HTML5-Page-Background-Video
// div style="position: fixed; z-index: -99; width: 100%; height: 100%">
//  <iframe frameborder="0" height="100%" width="100%"
//    src="https://youtube.com/embed/ID?autoplay=1&controls=0&showinfo=0&autohide=1" allowfullscreen volume="0">
//  </iframe>
// </div>
// https://productforums.google.com/forum/#!topic/youtube/XS5_P_9OXCo
// Well, the volume="0" no longer seems to work but the code below does:
 <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
    <div id="player"></div>
    <script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '195',
          width: '260',
          videoId: 'h3P1OR9gg2Y',
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
           event.target.setVolume(0);
       event.target.playVideo();
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
    //      setTimeout(stopVideo, 6000);
                  done = true;
        }
           event.target.setVolume(0);
      }
    </script>
*/




// } endif; ?>
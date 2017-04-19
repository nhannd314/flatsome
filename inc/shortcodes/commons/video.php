<?php if($video_mp4 || $video_webm || $video_ogg){ ?>
  <div class="video-overlay no-click fill hide-for-small"></div>
	<video class="video-bg fill hide-for-small" preload playsinline autoplay="true"
	<?php if($video_sound == 'false') echo 'muted'?>
	<?php if($video_loop !== 'false') echo 'loop'; ?>>
	    <?php if($video_mp4) { ?><source src="<?php echo $video_mp4; ?>" type="video/mp4"><?php } ?>
	    <?php if($video_webm) { ?><source src="<?php echo $video_webm; ?>" type="video/webm"><?php } ?>
	   <?php if($video_ogg) { ?><source src="<?php echo $video_ogg; ?>" type="video/ogg"><?php } ?>
	</video>
<?php } ?>
<?php if($youtube) { ?>
  <div class="video-overlay no-click fill"></div>
  <div id="ytplayer" class="ux-youtube fill object-fit hide-for-small"></div>
  <script>
      // Load the IFrame Player API code asynchronously.
      var tag = document.createElement('script');
      tag.src = "https://www.youtube.com/player_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
      // Replace the 'ytplayer' element with an <iframe> and
      // YouTube player after the API code downloads.
      var player;
      function onYouTubePlayerAPIReady() {
        player = new YT.Player('ytplayer', {
          height: '100%',
          width: '100%',
          playerVars: {html5: 1, autoplay: 1, controls: 0, rel: 0, modestbranding: 1, playsinline: 1, showinfo: 0, fs :0,
            loop: <?php if($video_loop !== 'false') {echo '1';} else{ echo '0';} ?>, el: 0, playlist: '<?php echo $youtube; ?>'},
          videoId: '<?php echo $youtube; ?>',
            events: {
              'onReady': onPlayerReady
            }
          }
        );
      }
      function onPlayerReady(event) {
          <?php if($video_sound == 'false') echo 'event.target.mute();'; ?>
      }
    </script>
<?php } ?>

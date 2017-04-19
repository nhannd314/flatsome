<?php
// [share]
function flatsome_share($atts, $content = null) {
	extract(shortcode_atts(array(
		'title'  => '',
		'size' => '',
		'align' => '',
		'scale' => '',
		'style' => '',
	), $atts));

	// Get Custom Share icons if set
	if(get_theme_mod('custom_share_icons')){
		return do_shortcode(get_theme_mod('custom_share_icons'));
	}

	global $post;
	if(!$post) return false;

	$permalink = get_permalink($post->ID);

	$featured_image =  wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
	$featured_image_2 = $featured_image['0'];
	$post_title = rawurlencode(get_the_title($post->ID));
	$whatsapp_text = rawurlencode($post_title.' - '.$permalink);

	if($title) $title = '<span class="share-icons-title">'.$title.'</span>';

	// Style default

	// Get Custom Theme Style
	if(!$style) $style = get_theme_mod('social_icons_style','outline');
	
	$classes = get_flatsome_icon_class($style);
	$classes = $classes.' tooltip';

	$share = get_theme_mod('social_icons', array('facebook','twitter','email','linkedin','googleplus','pinterest','whatsapp'));

	// Scale
	if($scale) $scale = 'style="font-size:'.$scale.'%"';

	// Align
	if($align) $align = 'full-width text-'.$align;
	
	// Fix old depricated
	if(!isset($share[0])){
		$fix_share = array();
		foreach ($share as $key => $value) {
			if($value == '1') $fix_share[] = $key;
		}
		$share = $fix_share;
	}

	ob_start();
	?>

	<div class="social-icons share-icons share-row relative icon-style-<?php echo $style; ?> <?php echo $align; ?>" <?php echo $scale;?>>
		  <?php echo $title; ?>
		  <?php if(in_array('whatsapp', $share)){ ?>
		  <a href="whatsapp://send?text=<?php echo $whatsapp_text; ?>" data-action="share/whatsapp/share" class="<?php echo $classes;?> whatsapp show-for-medium" title="<?php _e('Share on WhatsApp','flatsome'); ?>"><i class="icon-phone"></i></a>
		  <?php } if(in_array('facebook', $share)){ ?>
		  <a href="//www.facebook.com/sharer.php?u=<?php echo $permalink; ?>" data-label="Facebook" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="nofollow" target="_blank" class="<?php echo $classes;?> facebook" title="<?php _e('Share on Facebook','flatsome'); ?>"><?php echo get_flatsome_icon('icon-facebook'); ?></a>
		  <?php } if(in_array('twitter', $share)){ ?>
          <a href="//twitter.com/share?url=<?php echo $permalink; ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="nofollow" target="_blank" class="<?php echo $classes;?> twitter" title="<?php _e('Share on Twitter','flatsome'); ?>"><?php echo get_flatsome_icon('icon-twitter'); ?></a>
          <?php } if(in_array('email', $share)){ ?>
          <a href="mailto:enteryour@addresshere.com?subject=<?php echo $post_title; ?>&amp;body=Check%20this%20out:%20<?php echo $permalink; ?>" rel="nofollow" class="<?php echo $classes;?> email" title="<?php _e('Email to a Friend','flatsome'); ?>"><?php echo get_flatsome_icon('icon-envelop'); ?></a>
          <?php } if(in_array('pinterest', $share)){ ?>
          <a href="//pinterest.com/pin/create/button/?url=<?php echo $permalink; ?>&amp;media=<?php echo $featured_image_2; ?>&amp;description=<?php echo $post_title; ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="nofollow" target="_blank" class="<?php echo $classes;?> pinterest" title="<?php _e('Pin on Pinterest','flatsome'); ?>"><?php echo get_flatsome_icon('icon-pinterest'); ?></a>
          <?php } if(in_array('googleplus', $share)){ ?>
          <a href="//plus.google.com/share?url=<?php echo $permalink; ?>" target="_blank" class="<?php echo $classes;?> google-plus" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="nofollow" title="<?php _e('Share on Google+','flatsome'); ?>"><?php echo get_flatsome_icon('icon-google-plus'); ?></a>
          <?php } if(in_array('vk', $share)){ ?>
          <a href="//vkontakte.ru/share.php?url=<?php echo $permalink; ?>" target="_blank" class="<?php echo $classes;?> vk" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;" rel="nofollow" title="<?php _e('Share on VKontakte','flatsome'); ?>"><?php echo get_flatsome_icon('icon-vk'); ?></a>
          <?php } if(in_array('linkedin', $share)){ ?>
          <a href="//www.linkedin.com/shareArticle?mini=true&url=<?php echo $permalink; ?>&title=<?php echo $post_title; ?>" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" target="_blank" class="<?php echo $classes;?> linkedin" title="<?php _e('Share on LinkedIn','flatsome'); ?>"><?php echo get_flatsome_icon('icon-linkedin'); ?></a>
          <?php } if(in_array('tumblr', $share)){ ?>
          <a href="//tumblr.com/widgets/share/tool?canonicalUrl=<?php echo $permalink; ?>" target="_blank" class="<?php echo $classes;?> tumblr" onclick="window.open(this.href,this.title,'width=500,height=500,top=300px,left=300px');  return false;"  rel="nofollow" title="<?php _e('Share on Tumblr','flatsome'); ?>"><?php echo get_flatsome_icon('icon-tumblr'); ?></a>
          <?php } ?>
    </div>
    
    <?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
} 
add_shortcode('share','flatsome_share');


// [follow]
function flatsome_follow($atts, $content = null) {
	$sliderrandomid = rand();
	extract(shortcode_atts(array(
		'title' => '',
		'style' => 'outline',
		'align' => '',
		'scale' => '',
		'defaults' => '',
		'twitter' => '',
		'facebook' => '',
		'pinterest' => '',
		'email' => '',
		'googleplus' => '',
		'instagram' => '',
		'rss' => '',
		'linkedin' => '',
		'youtube' => '',
		'flickr' => '',
		'vkontakte' => '',
		'px500' => '',
		'snapchat' => '',

		// Depricated
		'size' => '',

	), $atts));
	ob_start();

	if($size == 'small') $style = 'small';

	// Get Defaults
	if($defaults){
		$twitter = get_theme_mod('follow_twitter'); 
		$facebook = get_theme_mod('follow_facebook'); 
		$instagram = get_theme_mod('follow_instagram');
		$snapchat = get_theme_mod('follow_snapchat');
		$youtube = get_theme_mod('follow_youtube');
		$pinterest = get_theme_mod('follow_pinterest');
		$googleplus = get_theme_mod('follow_google');
		$linkedin = get_theme_mod('follow_linkedin');
		$px500 = get_theme_mod('follow_500px');
		$vkontakte = get_theme_mod('follow_vk');
		$flickr = get_theme_mod('follow_flickr');
		$email = get_theme_mod('follow_email');
		$rss = get_theme_mod('follow_rss');
	}

	$style = get_flatsome_icon_class($style);

	// Scale
	if($scale) $scale = 'style="font-size:'.$scale.'%"';

	// Align
	if($align) $align = 'full-width text-'.$align;

	?>
    <div class="social-icons follow-icons <?php echo $align; ?>" <?php echo $scale;?>>
    	<?php if($title){?>
    	<span><?php echo $title; ?></span>
		<?php }?>
    	<?php if($facebook){?>
    	<a href="<?php echo $facebook; ?>" target="_blank" data-label="Facebook"  rel="nofollow" class="<?php echo $style; ?> facebook tooltip" title="<?php _e('Follow on Facebook','flatsome') ?>"><?php echo get_flatsome_icon('icon-facebook'); ?>
    	</a>
		<?php }?>
		<?php if($instagram){?>
		    <a href="<?php echo $instagram; ?>" target="_blank" rel="nofollow" data-label="Instagram" class="<?php echo $style; ?>  instagram tooltip" title="<?php _e('Follow on Instagram','flatsome')?>"><?php echo get_flatsome_icon('icon-instagram'); ?>
		   </a>
		<?php }?>
		<?php if($snapchat){?>
		    <a href="#" data-open="#follow-snapchat-lightbox" data-color="dark" data-pos="center" target="_blank" rel="nofollow" data-label="SnapChat" class="<?php echo $style; ?> snapchat tooltip" title="<?php _e('Follow on SnapChat','flatsome')?>"><?php echo get_flatsome_icon('icon-snapchat'); ?>
		   </a>
		   <div id="follow-snapchat-lightbox" class="mfp-hide">
		   		<div class="text-center">
			   		<?php echo do_shortcode(flatsome_get_image($snapchat)) ;?>
			   		<p><?php _e('Point the SnapChat camera at this to add us to SnapChat.','flatsome'); ?></p>
		   		</div>
		   </div>
		<?php }?>
		<?php if($twitter){?>
	       <a href="<?php echo $twitter; ?>" target="_blank"  data-label="Twitter"  rel="nofollow" class="<?php echo $style; ?>  twitter tooltip" title="<?php _e('Follow on Twitter','flatsome') ?>"><?php echo get_flatsome_icon('icon-twitter'); ?>
	       </a>
		<?php }?>
		<?php if($email){?>
		     <a href="mailto:<?php echo $email; ?>" target="_blank"  data-label="E-mail"  rel="nofollow" class="<?php echo $style; ?>  email tooltip" title="<?php _e('Send us an email','flatsome') ?>"><?php echo get_flatsome_icon('icon-envelop'); ?>
			</a>
		<?php }?>
		<?php if($pinterest){?>
		       <a href="<?php echo $pinterest; ?>" target="_blank" rel="nofollow"  data-label="Pinterest"  class="<?php echo $style; ?>  pinterest tooltip" title="<?php _e('Follow on Pinterest','flatsome') ?>"><?php echo get_flatsome_icon('icon-pinterest'); ?>
		       </a>
		<?php }?>
		<?php if($googleplus){?>
		       <a href="<?php echo $googleplus; ?>" target="_blank" rel="nofollow"  data-label="Google+"  class="<?php echo $style; ?>  google-plus tooltip" title="<?php _e('Follow on Google+','flatsome')?>"><?php echo get_flatsome_icon('icon-google-plus'); ?>
		       </a>
		<?php }?>
		<?php if($rss){?>
		       <a href="<?php echo $rss; ?>" target="_blank" rel="nofollow" data-label="RSS Feed" class="<?php echo $style; ?>  rss tooltip" title="<?php _e('Subscribe to RSS','flatsome') ?>"><?php echo get_flatsome_icon('icon-feed'); ?></a>
		<?php }?>
		<?php if($linkedin){?>
		       <a href="<?php echo $linkedin; ?>" target="_blank" rel="nofollow" data-label="LinkedIn" class="<?php echo $style; ?>  linkedin tooltip" title="<?php _e('Follow on LinkedIn','flatsome') ?>"><?php echo get_flatsome_icon('icon-linkedin'); ?></a>
		<?php }?>
		<?php if($youtube){?>
		       <a href="<?php echo $youtube; ?>" target="_blank" rel="nofollow" data-label="YouTube" class="<?php echo $style; ?>  youtube tooltip" title="<?php _e('Follow on YouTube','flatsome') ?>"><?php echo get_flatsome_icon('icon-youtube'); ?>
		       </a>
		<?php }?>
		<?php if($flickr){?>
		       <a href="<?php echo $flickr; ?>" target="_blank" data-label="Flickr" class="<?php echo $style; ?>  flickr tooltip" title="<?php _e('Flickr','flatsome') ?>"><?php echo get_flatsome_icon('icon-flickr'); ?>
		       </a>
		<?php }?>
		<?php if($px500){?>
		     <a href="<?php echo $px500; ?>" target="_blank"  data-label="500px"  rel="nofollow" class="<?php echo $style; ?> px500 tooltip" title="<?php _e('Follow on 500px','flatsome') ?>"><?php echo get_flatsome_icon('icon-500px'); ?>
			</a>
		<?php }?>
		<?php if($vkontakte){?>
		       <a href="<?php echo $vkontakte; ?>" target="_blank" data-label="VKontakte" rel="nofollow" class="<?php echo $style; ?> vk tooltip" title="<?php _e('Follow on VKontakte','flatsome') ?>"><?php echo get_flatsome_icon('icon-vk'); ?>
		       </a>
		<?php }?>
     </div>

	<?php
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode("follow", "flatsome_follow");
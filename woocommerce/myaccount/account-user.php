<div class="account-user circle">
	<span class="image mr-half inline-block">
	<?php 
	 	$current_user = wp_get_current_user();
	 	$user_id = $current_user->ID;
		echo get_avatar( $user_id, 70 );
	?>
		</span>
	<span class="user-name inline-block">
		<?php 
			echo $current_user->display_name;
		?>
		<em class="user-id op-5"><?php echo '#'.$user_id;?></em>
	</span>

	<?php do_action('flatsome_after_account_user'); ?>
</div>
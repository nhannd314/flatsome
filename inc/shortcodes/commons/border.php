<?php
 $border_class = array('is-border');
 if($border_style) $border_class[] = 'is-'.$border_style;
 if(isset($border_hover) && $border_hover) $border_class[] = 'hover-'.$border_hover;

 $border_style = array(
    array( 'attribute' => 'border-color', 'value' => $border_color ),
    array( 'attribute' => 'border-radius', 'value' => $border_radius, 'unit' => 'px' ),
    array( 'attribute' => 'border-width', 'value' => $border ),
    array( 'attribute' => 'margin', 'value' => $border_margin ),
  );
 
?>

<?php if($border) { ?>
	<div class="<?php echo implode(' ', $border_class); ?>"
		<?php echo get_shortcode_inline_css($border_style); ?>>
	</div>
<?php } ?>
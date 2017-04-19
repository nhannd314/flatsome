<?php
// [tabgroup]
function ux_tabgroup( $params, $content = null, $tag ) {
	$GLOBALS['tabs'] = array();
	$GLOBALS['tab_count'] = 0;
	$i = 1;

	extract(shortcode_atts(array(
		'title' => '',
		'style' => 'line',
		'align' => 'left',
		'type' => '', // horizontal, vertical
		'nav_style' => 'uppercase',
		'nav_size' => 'normal',
		'id' => 'panel-'.rand(),
		'history' => 'false',
	), $params));

	if($tag == 'tabgroup_vertical'){
		$type = 'vertical';
	}

	$content = flatsome_contentfix($content);

	$classes[] = 'nav';

	if($style) $classes[] = 'nav-'.$style;
	if($type == 'vertical') $classes[] = 'nav-vertical';
	if($nav_style) $classes[] = 'nav-'.$nav_style;
	if($nav_size) $classes[] = 'nav-size-'.$nav_size;
	if($align) $classes[] = 'nav-'.$align;

	$classes = implode(' ', $classes);

	if( is_array( $GLOBALS['tabs'] )){

		foreach( $GLOBALS['tabs'] as $key => $tab ){
			if($tab['title']) $id = flatsome_to_dashed($tab['title']);
			$active = $key == 0 ? ' active' : ''; // Set first tab active by default.
			$tabs[] = '<li class="tab'.$active.' has-icon"><a href="#tab_'.$id.'"><span>'.$tab['title'].'</span></a></li>';
			$panes[] = '<div class="panel'.$active.' entry-content" id="tab_'.$id.'">'.flatsome_contentfix($tab['content']).'</div>';
			$i++;
		}
			if($title) $title = '<h4 class="uppercase text-'.$align.'">'.$title.'</h4>';
			$return = '
		<div class="tabbed-content">
			'.$title.'
			<ul class="'.$classes.'">'.implode( "\n", $tabs ).'</ul><div class="tab-panels">'.implode( "\n", $panes ).'</div></div>';
	}


	return $return;
}

function ux_tab( $params, $content = null) {
	extract(shortcode_atts(array(
			'title' => '',
			'title_small' => ''
	), $params));

	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'content' =>  $content );
	$GLOBALS['tab_count']++;
}


add_shortcode('tabgroup', 'ux_tabgroup');
add_shortcode('tabgroup_vertical', 'ux_tabgroup');
add_shortcode('tab', 'ux_tab' );

<?php

function flatsome_sidebar_classes(){

   echo implode(' ',  apply_filters( 'flatsome_sidebar_class', array() ) );
}


function flatsome_add_sidebar_class($classes){
	//$classes[] = 'col-divided';
	//$classes[] = 'widgets-boxed';

	return $classes;
}

add_filter('flatsome_sidebar_class','flatsome_add_sidebar_class', 10);


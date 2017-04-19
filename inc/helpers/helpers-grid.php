<?php

function flatsome_get_grid_height($height, $id){

  $height_sm = null;
  $height_md = null;

  if(is_array($height)){
    $height_md = intval($height[1]);
    $height_sm = intval($height[2]);
    $height = intval($height[0]);
  } else {
    $height_md = intval($height)/1.5;
    $height_sm = intval($height)/1.5;
    $height = intval($height);
  }
  ?>
  <style scope="scope">
    #<?php echo $id;?> .grid-col-1{height: <?php echo $height; ?>px}
    #<?php echo $id;?> .grid-col-1-2{height: <?php echo $height / 2; ?>px}
    #<?php echo $id;?> .grid-col-1-3{height:<?php echo $height / 3; ?>px}
    #<?php echo $id;?> .grid-col-2-3{height: <?php echo $height / 3 *2; ?>px}
    #<?php echo $id;?> .grid-col-1-4{height: <?php echo $height / 4; ?>px}
    #<?php echo $id;?> .grid-col-3-4{height: <?php echo $height / 4 *3; ?>px}

    <?php if($height_sm) { ?>
    /* Mobile */
    @media (max-width: 550px){
      #<?php echo $id;?> .grid-col-1{height: <?php echo  $height_sm; ?>px}
      #<?php echo $id;?> .grid-col-1-2{height: <?php echo  $height_sm / 2; ?>px}
      #<?php echo $id;?> .grid-col-1-3{height:<?php echo  $height_sm / 3; ?>px}
      #<?php echo $id;?> .grid-col-2-3{height: <?php echo  $height_sm / 3 *2; ?>px}
      #<?php echo $id;?> .grid-col-1-4{height: <?php echo  $height_sm / 4; ?>px}
      #<?php echo $id;?> .grid-col-3-4{height: <?php echo  $height_sm / 4 *3; ?>px}
    }
    <?php } ?>

    <?php if($height_md) { ?>
    /* Mobile */
    @media (max-width: 850px){
      #<?php echo $id;?> .grid-col-1{height: <?php echo  $height_md; ?>px}
      #<?php echo $id;?> .grid-col-1-2{height: <?php echo  $height_md / 2; ?>px}
      #<?php echo $id;?> .grid-col-1-3{height:<?php echo  $height_md / 3; ?>px}
      #<?php echo $id;?> .grid-col-2-3{height: <?php echo  $height_md / 3 *2; ?>px}
      #<?php echo $id;?> .grid-col-1-4{height: <?php echo  $height_md / 4; ?>px}
      #<?php echo $id;?> .grid-col-3-4{height: <?php echo  $height_md / 4 *3; ?>px}
    }
    <?php } ?>
  </style>
  <?php
}

if( ! function_exists( 'flatsome_get_grid' ) ) {
  function flatsome_get_grid($grid = 1){

    $g = array();

    if($grid == '1'){
      $g = array(
        array('height' => '1','span' => '6', 'size' => 'medium','md' => '12'),
        array('height' => '1','span' => '3', 'size' => 'medium','md' => '6'),
        array('height' => '1-2','span' => '3', 'size' => 'thumbnail','md' => '6'),
        array('height' => '1-2','span' => '3', 'size' => 'thumbnail','md' => '6'),
      );
    }
    if($grid == '2'){
      $g = array(
          array('height' => '1','span' => '12', 'size' => 'large','md' => '12'),
          array('height' => '1-3','span' => '4','size' => 'medium','md' => '12'),
          array('height' => '1-3','span' => '4','size' => 'medium','md' => '12'),
          array('height' => '1-3','span' => '4','size' => 'medium','md' => '12'),
        );
    }

    if($grid == '3'){
      $g = array(
          array('height' => '1','span' => '6','size' => 'large','md' => '12'),
          array('height' => '1-2','span' => '6','size' => 'medium','md' => '6'),
          array('height' => '1-2','span' => '3','size' => 'thumbnail','md' => '6'),
        );
    }

    if($grid == '4'){
      $g = array(
         array('height' => '1','span' => '3','size' => 'large','md' => '6'),
      );
    }

    if($grid == '5'){
      $g = array(
         array('height' => '1','span' => '4','size' => 'large','md' => '6'),
      );
    }

    if($grid == '6'){
      $g = array(
          array('height' => '1','span' => '9','size' => 'large','md' => '12'),
          array('height' => '1-2','span' => '3','size' => 'thumbnail','md' => '6'),
          array('height' => '1-2','span' => '3','size' => 'thumbnail','md' => '6'),
        );
    }


    if($grid == '7'){
      $g = array(
         array('height' => '1','span' => '3','size' => 'medium', 'md' => '12'),
         array('height' => '1','span' => '6','size' => 'large','md' => '6'),
         array('height' => '1-2','span' => '3','size' => 'thumbnail','md' => '6'),
        );
    }

  if($grid == '8'){
      $g = array(
         array('height' => '1','span' => '3','size' => 'thumbnail','md' => '12'),
         array('height' => '1','span' => '6','size' => 'large','md' => '6'),
         array('height' => '1','span' => '3','size' => 'thumbnail','md' => '6'),
         array('height' => '1','span' => '3','size' => 'thumbnail','md' => '6'),
        );
    }

  if($grid == '9'){
      $g = array(
         array('height' => '1','span' => '6','size' => 'medium','md' => '12'),
         array('height' => '1','span' => '3','size' => 'thumbnail','md' => '6'),
        );
    }

  if($grid == '10'){
      $g = array(
          array('height' => '1','span' => '6','size' => 'large','md' => '12'),
          array('height' => '1-3','span' => '6','size' => 'medium','md' => '6'),
          array('height' => '1-3','span' => '3','size' => 'medium','md' => '6'),
          array('height' => '1-3','span' => '3','size' => 'medium','md' => '6'),
          array('height' => '1-3','span' => '6','size' => 'medium','md' => '6'),
        );
    }

   if($grid == '11'){
      $g = array(
          array('height' => '2-3','span' => '6','md' => '12','size' => 'large'),
          array('height' => '2-3','span' => '3','md' => '6','size' => 'medium'),
          array('height' => '1','span' => '3','md' => '6','size' => 'medium'),
          array('height' => '2-3','span' => '3','md' => '6','size' => 'medium'),
          array('height' => '1-3','span' => '6','md' => '12','size' => 'medium'),

        );
    }

    if($grid == '12'){
      $g = array(
          array('height' => '1-2','span' => '8','md' => '12','size' => 'medium'),
          array('height' => '1','span' => '4','md' => '6','size' => 'large',),
          array('height' => '1','span' => '4','md' => '6','size' => 'large',),
          array('height' => '1-2','span' => '8','md' => '6','size' => 'medium'),
          array('height' => '1-2','span' => '8','md' => '6','size' => 'medium'),
          array('height' => '1','span' => '4','md' => '6','size' => 'medium'),
        );
    }


    if($grid == '13'){
      $g = array(
          array('height' => '2-3','span' => '6','md' => '12','size' => 'medium'),
          array('height' => '1-2','span' => '3','md' => '6','size' => 'medium'),
          array('height' => '1','span' => '3','md' => '6','size' => 'medium'),
          array('height' => '1-2','span' => '3','md' => '6','size' => 'medium'),
          array('height' => '1-3','span' => '6','md' => '12','size' => 'medium'),
        );
    }

    if($grid == '14'){
      $g = array(
          array('height' => '1-2','span' => '8', 'md' => '12','size' => 'medium'),
          array('height' => '1','span' => '4', 'md' => '6','size' => 'medium'),
          array('height' => '1','span' => '4', 'md' => '6','size' => 'medium'),
          array('height' => '1','span' => '2','md' => '6','size' => 'medium'),
          array('height' => '1','span' => '2','md' => '6','size' => 'medium'),
          array('height' => '1-2','span' => '4','md' => '6','size' => 'medium'),
        );
     }

     return $g;
  }
}

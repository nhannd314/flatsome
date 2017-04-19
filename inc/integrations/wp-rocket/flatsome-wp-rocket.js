Flatsome.behavior('wp-rocket-lazy-load-sliders', {
  attach: function (context) {
     jQuery('.slider', context).each(function (index, element) {
        var $element = jQuery(element);
        var waypoint = $element.waypoint(function (direction) {
          if($element.hasClass('slider-lazy-load-active')) return;
          setTimeout(function(){
            $element.imagesLoaded( function() {
               if($element.flickity) $element.flickity('resize');
               $element.addClass('slider-lazy-load-active');
            });
          }, 300);
         }, { offset: '90%' });
      });
  }
});

Flatsome.behavior('wp-rocket-lazy-load-packery', {
  attach: function (context) {
       jQuery('.has-packery .lazy-load', context).waypoint(function (direction) {
          var $element = jQuery(this.element);
          $element.imagesLoaded( function() {
              jQuery('.has-packery').packery('layout');
          });
      }, { offset: '90%' });
  }
});

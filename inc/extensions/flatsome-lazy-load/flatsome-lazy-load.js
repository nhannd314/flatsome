Flatsome.behavior('lazy-load-images', {
  attach: function (context) {
    jQuery('.lazy-load', context).each(function (index, element) {
      var $element = jQuery(element);
      var waypoint = $element.waypoint(function (direction) {
          if($element.hasClass('lazy-load-active')) return;
          var src = $element.data('src');
          var srcset = $element.data('srcset');
          if(src) $element.attr('src', src);
          if(srcset) $element.attr('srcset', srcset);
          $element.imagesLoaded( function() {
            $element.addClass('lazy-load-active').removeClass('lazy-load');
          });
          //this.destroy();
      }, { offset: '140%' });
    });
  }
});

Flatsome.behavior('lazy-load-sliders', {
  attach: function (context) {
     jQuery('.slider', context).each(function (index, element) {
        var $element = jQuery(element);
        var waypoint = $element.waypoint(function (direction) {
          if($element.hasClass('slider-lazy-load-active')) return;
          $element.imagesLoaded( function() {
             if($element.hasClass('flickity-enabled')) $element.flickity('resize');
             $element.addClass('slider-lazy-load-active');
          });
         }, { offset: '100%' });
      });
  }
});

Flatsome.behavior('lazy-load-packery', {
  attach: function (context) {
       jQuery('.has-packery .lazy-load', context).waypoint(function (direction) {
          var $element = jQuery(this.element);
          $element.imagesLoaded( function() {
              jQuery('.has-packery').packery('layout');
          });
          //this.destroy();
      }, { offset: '100%' });
  }
});
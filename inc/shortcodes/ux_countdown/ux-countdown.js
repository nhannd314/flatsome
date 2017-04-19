Flatsome.behavior('ux-countdown', {
 attach: function (context) {
	jQuery('[data-countdown]', context).each(function () {
	 var $this = jQuery(this), finalDate = jQuery(this).data('countdown');

	 var t_hour = jQuery(this).data('text-hour'),
     t_min = jQuery(this).data('text-min'),
     t_week = jQuery(this).data('text-week'),
     t_day = jQuery(this).data('text-day'),
     t_sec = jQuery(this).data('text-sec'),
     t_min_p = jQuery(this).data('text-min-p'),
     t_hour_p = jQuery(this).data('text-hour-p'),
     t_week_p = jQuery(this).data('text-week-p'),
     t_day_p = jQuery(this).data('text-day-p'),
     t_sec_p = jQuery(this).data('text-sec-p'),
     t_plural = jQuery(this).data('text-plural');

     var hours_plural = t_hour+t_plural;
     var days_plural = t_day+t_plural;
     var weeks_plural = t_week+t_plural;
     var min_plural = t_min;
     var sec_plural = t_sec;

     if(t_hour_p) hours_plural = t_hour_p;
     if(t_min_p) min_plural = t_min_p;
     if(t_week_p) weeks_plural = t_week_p;
     if(t_day_p) days_plural = t_day_p;
     if(t_sec_p) sec_plural = t_sec_p;

		 $this.countdown(finalDate).on('update.countdown', function (event) {
		      var format = '<span>%-H<strong>%!H:'+t_hour+','+hours_plural+';</strong></span><span>%-M<strong>%!M:'+t_min+','+min_plural+';</strong></span><span>%-S<strong>%!S:'+t_sec+','+sec_plural+';</strong></span>';

          if(event.offset.days > 0) { format = '<span>%-d<strong>%!d:'+t_day+','+days_plural+';</strong></span>' + format; }
          if(event.offset.weeks > 0) { format = '<span>%-w<strong>%!w:'+t_week+','+weeks_plural+';</strong></span>' + format; }

			  jQuery(this).html(event.strftime(format));

		 }).on('finish.countdown', function (event) {
        var format = '<span>%-H<strong>%!H:'+t_hour+','+hours_plural+';</strong></span><span>%-M<strong>%!M:'+t_min+','+min_plural+';</strong></span><span>%-S<strong>%!S:'+t_sec+','+sec_plural+';</strong></span>';
        jQuery(this).html(event.strftime(format));
		 });
	});
 }
});

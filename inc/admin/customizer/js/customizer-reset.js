// Customizer Reset
jQuery(function ($) {
    $button = jQuery('#flatsome-customizer-reset');
    
    $button.on('click', function (event) {
        event.preventDefault();

        var data = {
            wp_customize: 'on',
            action: 'customizer_reset',
            nonce: _FlatsomeCustomizerReset.nonce.reset
        };

        var r = confirm(_FlatsomeCustomizerReset.confirm);

        if (!r) return;

        $button.attr('disabled', 'disabled');

        $.post(ajaxurl, data, function () {
            wp.customize.state('saved').set(true);
            location.reload();
        });
    });

});
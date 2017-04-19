<?php


function flatsome_contact_form_presets($args){
 	?>	
    <style>.metabox-holder .dev-cta{display:none!important;}</style>

    <div class="metabox-holder">
    <p style="font-size: 1.5em; background-color: rgba(0, 130, 0, 0.09); padding:15px;">
      Copy and paste a form preset into the 'Form' tab.
      <a href="#">Learn more here..</a>
    </p>

    <!-- Contact form -->
    <h3>Simple contact form</h3>
    <textarea style="width:100%;min-height: 100px;">
    <label>Your Name (required)</label>
    [text* your-name]

    <label>Your Email (required)</label>
    [email* your-email] </p>

    <label>Your Message (required)</label>
    [textarea your-message] </p>

    [submit class:button primary "Submit"]

    </textarea>

    <!-- Inline Newsletter signup -->
    <h3>Newsletter Form Horizontal</h3>
    <textarea style="width:100%;min-height: 100px;">
    <div class="flex-row form-flat medium-flex-wrap">
    <div class="flex-col flex-grow">
    	[email* your-email placeholder "Your Email (required)"]
    </div>
    <div class="flex-col ml-half">
    	[submit class:button primary "Sign Up"]
    </div>
    </div>
    </textarea>

    <!-- Inline Newsletter signup -->
    <h3>Newsletter Form Vertical</h3>
    <textarea style="width:100%;min-height: 100px;">
    <div class="form-flat">
      [email* your-email placeholder "Your Email (required)"]
      [submit class:button primary "Sign Up"]
    </div>
    </textarea>


    </div><!-- .metabox-holder -->
 	<?php
}

function flatsome_contact_form_presets_tab( $panels ) {
  $new_page = array(
    'Flatsome-Presets' => array(
      'title' => __( 'Presets', 'flatsome-admin' ),
      'callback' => 'flatsome_contact_form_presets'
    )
  );
  $panels = array_merge($new_page,$panels);
  return $panels;
}
add_filter( 'wpcf7_editor_panels', 'flatsome_contact_form_presets_tab' ,50);

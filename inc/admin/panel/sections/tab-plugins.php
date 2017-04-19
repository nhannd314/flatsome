<div id="tab-plugins" class="panel flatsome-panel">
<?php
    

  if ( isset( $_GET['flatsome-deactivate'] ) && 'deactivate-plugin' == $_GET['flatsome-deactivate'] ) {
    check_admin_referer( 'flatsome-deactivate', 'flatsome-deactivate-nonce' );

    $plugins = TGM_Plugin_Activation::$instance->plugins;

    foreach ( $plugins as $plugin ) {
      if ( $plugin['slug'] == $_GET['plugin'] ) {
        deactivate_plugins( $plugin['file_path'] );
      }
    }
  } if ( isset( $_GET['flatsome-activate'] ) && 'activate-plugin' == $_GET['flatsome-activate'] ) {
    check_admin_referer( 'flatsome-activate', 'flatsome-activate-nonce' );

    $plugins = TGM_Plugin_Activation::$instance->plugins;

    foreach ( $plugins as $plugin ) {
      if ( isset( $_GET['plugin'] ) && $plugin['slug'] == $_GET['plugin'] ) {
        activate_plugin( $plugin['file_path'] );
      }
    }
  }

function plugin_link( $item ) {
    $installed_plugins = get_plugins();

    $item['sanitized_plugin'] = $item['name'];

    $actions = array();

    // We have a repo plugin
    if ( ! $item['version'] ) {
      $item['version'] = TGM_Plugin_Activation::$instance->does_plugin_have_update( $item['slug'] );
    }

    /** We need to display the 'Install' hover link */
    if ( ! isset( $installed_plugins[$item['file_path']] ) ) {
      $actions = array(
        'install' => sprintf(
          '<a href="%1$s" class="button button-primary" title="Install %2$s">Install</a>',
          esc_url( wp_nonce_url(
            add_query_arg(
              array(
                'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
                'plugin'        => urlencode( $item['slug'] ),
                'plugin_name'   => urlencode( $item['sanitized_plugin'] ),
                'plugin_source' => urlencode( $item['source'] ),
                'tgmpa-install' => 'install-plugin',
                'return_url'    => 'flatsome-panel',
              ),
              TGM_Plugin_Activation::$instance->get_tgmpa_url()
            ),
            'tgmpa-install',
            'tgmpa-nonce'
          ) ),
          $item['sanitized_plugin']
        ),
      );
    }
    /** We need to display the 'Activate' hover link */
    elseif ( is_plugin_inactive( $item['file_path'] ) ) {
      $actions = array(
        'activate' => sprintf(
          '<a href="%1$s" class="button button-primary" title="Activate %2$s">Activate</a>',
          esc_url( add_query_arg(
            array(
              'plugin'               => urlencode( $item['slug'] ),
              'plugin_name'          => urlencode( $item['sanitized_plugin'] ),
              'plugin_source'        => urlencode( $item['source'] ),
              'flatsome-activate'       => 'activate-plugin',
              'flatsome-activate-nonce' => wp_create_nonce( 'flatsome-activate' ),
            ),
            admin_url( 'admin.php?page=flatsome-panel-plugins' )
          ) ),
          $item['sanitized_plugin']
        ),
      );
    }
    /** We need to display the 'Update' hover link */
    elseif ( version_compare( $installed_plugins[$item['file_path']]['Version'], $item['version'], '<' ) ) {
      $actions = array(
        'update' => sprintf(
          '<a href="%1$s" class="button button-primary" title="Install %2$s">Update</a>',
          wp_nonce_url(
            add_query_arg(
              array(
                'page'          => urlencode( TGM_Plugin_Activation::$instance->menu ),
                'plugin'        => urlencode( $item['slug'] ),
                'return_url'    => 'flatsome-panel',
                'tgmpa-update'  => 'update-plugin',
                'plugin_source' => urlencode( $item['source'] ),
                'version'       => urlencode( $item['version'] ),
              ),
              TGM_Plugin_Activation::$instance->get_tgmpa_url()
            ),
            'tgmpa-update',
            'tgmpa-nonce'
          ),
          $item['sanitized_plugin']
        ),
      );
    } elseif ( is_plugin_active( $item['file_path'] ) ) {
      $actions = array(
        'deactivate' => sprintf(
          '<a href="%1$s" class="button button-primary" title="Deactivate %2$s">Deactivate</a>',
          esc_url( add_query_arg(
            array(
              'plugin'                 => urlencode( $item['slug'] ),
              'plugin_name'            => urlencode( $item['sanitized_plugin'] ),
              'plugin_source'          => urlencode( $item['source'] ),
              'flatsome-deactivate'       => 'deactivate-plugin',
              'flatsome-deactivate-nonce' => wp_create_nonce( 'flatsome-deactivate' ),
            ),
            admin_url( 'admin.php?page=flatsome-panel-plugins' )
          ) ),
          $item['sanitized_plugin']
        ),
      );
    }

    return $actions;
  }


$flatsome_theme = wp_get_theme();
if ( $flatsome_theme->parent_theme ) {
  $template_dir = basename( get_template_directory() );
  $flatsome_theme  = wp_get_theme( $template_dir );
}
$plugins  = TGM_Plugin_Activation::$instance->plugins;

// Move plugins to top
$plugins = array('woocommerce' => $plugins['woocommerce']) + $plugins;

$installed_plugins = get_plugins();
?>
  <style>
  .theme-browser .theme .theme-screenshot:after{
    padding-top: 75%!important;
  }
  .theme-browser .theme .theme-name{
    font-size: 12px;
  }
  .theme-browser .theme {
    margin: 0 2% 2% 0!important;
    width: 32%!important;
    box-shadow: 1px 1px 5px 1px rgba(0,0,0,.1);
  }
  .theme-browser .theme:nth-child(3n){
    margin-right: 0!important;
  }
  .theme .plugin-info{position: absolute; bottom:0; width:100%; left:0; text-align: center; font-size: 11px; opacity: 0;} .theme:hover .plugin-info{opacity: 1}</style>
  <div class="flatsome-demo-themes flatsome-install-plugins" style="margin-top:35px;">
    <div class="theme-browser rendered">
      <?php foreach ( $plugins as $plugin ) : ?>
        <?php
        $class = '';
        $plugin_status = '';
        $file_path = $plugin['file_path'];
        $plugin_action = plugin_link( $plugin );
        if ( is_plugin_active( $file_path ) ) {
          $plugin_status = 'active';
          $class = 'active';
        }
        ?>
        <div class="theme <?php echo $class; ?>">
          <div class="theme-wrapper">
            <div class="theme-screenshot">
              <img src="<?php echo $plugin['image_url']; ?>" alt="" />
              <div class="plugin-info">
                <?php if ( isset( $installed_plugins[ $plugin['file_path'] ] ) ) : ?>
                  <?php printf( __( 'Version: %1s | <a href="%2s" target="_blank">%3s</a>', 'flatsome_admin' ), $installed_plugins[ $plugin['file_path'] ]['Version'], $installed_plugins[ $plugin['file_path'] ]['AuthorURI'], $installed_plugins[ $plugin['file_path'] ]['Author'] ); ?>
                <?php elseif ( 'bundled' == $plugin['source_type'] ) : ?>
                  <?php printf( esc_attr__( 'Available Version: %s', 'flatsome_admin' ), $plugin['version'] ); ?>
                <?php endif; ?>
              </div>
            </div>
            <h3 class="theme-name">
              <?php if ( 'active' == $plugin_status ) : ?>
                <span><?php printf( __( 'Active: %s', 'flatsome_admin' ), $plugin['name'] ); ?></span>
              <?php else : ?>
                <?php echo $plugin['name']; ?>
              <?php endif; ?>
            </h3>
            <div class="theme-actions">
              <?php foreach ( $plugin_action as $action ) { echo $action; } ?>
            </div>
            <?php if ( isset( $plugin_action['update'] ) && $plugin_action['update'] ) : ?>
              <div class="theme-update">
                <?php printf( __( 'Update Available: Version %s', 'flatsome_admin' ), $plugin['version'] ); ?>
              </div>
            <?php endif; ?>
            <?php if ( isset( $plugin['required'] ) && $plugin['required'] ) : ?>
              <div class="plugin-required">
                <?php esc_html_e( 'Required', 'flatsome_admin' ); ?>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
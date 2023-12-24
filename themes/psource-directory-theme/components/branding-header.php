<!-- start branding -->
<div id="branding">
    <div id="site-logo"><!-- start #site-logo -->
        <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php esc_attr_e('Home', THEME_TEXT_DOMAIN); ?>"><?php bloginfo('name'); ?></a>
    </div><!-- end #site-logo -->
    <div id="h-banner"><?php
        $options = get_option('dir_options');
        if (isset($options['ads_settings']['header_ad_code'])) {
            echo esc_html($options['ads_settings']['header_ad_code']);
        }
    ?></div>
    <div class="clear"></div>
</div>
<!-- end branding -->

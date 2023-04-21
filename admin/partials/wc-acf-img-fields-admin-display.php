<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://fiverr.com/iqbalmalik
 * @since      1.0.0
 *
 * @package    Wc_Acf_Img_Fields
 * @subpackage Wc_Acf_Img_Fields/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div>
    <div class = "wai-heading-container">
        <h1 class = "wai-admin-heading" >Woocommerce to ACF Image Sync</h1>
    </div>

    <div style="margin-top:20px;">
        <p style="margin-bottom:0px !important;">ACF Field 1</p>
        <select id="wai-acf-1-select" class="wai-acf-select">
            <option value="">Select One</option>
            <?php
                foreach ( $records as $record ) {
                    ?>
                        <option value="<?php echo esc_html( $record->post_excerpt ); ?>"><?php echo esc_html( $record->post_title ); ?></option>
                    <?php
                }
            ?>
        </select>
    </div>

    <div style="margin-top:20px;">
        <p style="margin-bottom:0px !important;">ACF Field 2</p>
        <select id="wai-acf-2-select" class="wai-acf-select">
            <option value="">Select One</option>
            <?php
                foreach ( $records as $record ) {
                    ?>
                        <option value="<?php echo esc_html( $record->post_excerpt ); ?>"><?php echo esc_html( $record->post_title ); ?></option>
                    <?php
                }
            ?>
        </select>
    </div>

    <div style="margin-top:20px;">
        <p style="margin-bottom:0px !important;">ACF Field 3</p>
        <select id="wai-acf-3-select" class="wai-acf-select">
            <option value="">Select One</option>
            <?php
                foreach ( $records as $record ) {
                    ?>
                        <option value="<?php echo esc_html( $record->post_excerpt ); ?>"><?php echo esc_html( $record->post_title ); ?></option>
                    <?php
                }
            ?>
        </select>
    </div>

    <div style="margin-top:20px;">
        <button type="button" class="button button-primary shadow-none" onclick="wai_start_syncing_process();">
            <span id="wai-btn-spinner" style="display:none;" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> 
            <span id="wai-btn-text">Start Sync</span>         
        </button>
    </div>
</div>
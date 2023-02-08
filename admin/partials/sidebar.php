
<div class="preview_box">
    <div class="preview_box_header">
        <h3><?php _e('Currently Active Theme','site-mode');?></h3>
    </div>
    <div class="preview_box_body">
        <div class="preview_box_body_content">
            <div class="preview_active_template" style="background-image: url('<?php echo plugin_dir_url( __DIR__ ) .'assets/img/template-1.jpg'; ?>)">    
                <div class="preview_active_template_link">        
                    <a href="<?php echo esc_url(home_url( '?site-mode-preview=true')); ?>" class="btn btn_sm btn_white" target="_blank">
                        <?php _e('Preview Active Theme','site-mode');?>
                    </a>
                </div>    
            </div>
        </div>       
    </div>    
</div>
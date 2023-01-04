<div class="wrap">
    <div class="site_mode__wrap-form">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <button class="button button-primary btn-export" id="btn-export"><?php _e('Export Button', 'site-mode');?></button>

        <form id="site-mode-import" method="post" enctype="multipart/form-data">
            <h2><?php _e('Upload File', 'site-mode');?></h2>
            <input type="file" name="json-file" id="fileSelect" accept=".json"><br><br>
            <input type="submit" name="submit" value="Upload"><br><br>
            <!-- name of the input fields are going to be used in our php script-->
            <div><?php _e('upload json file to import json into db', 'site-mode');?></div>
        </form>
    </div>
</div>


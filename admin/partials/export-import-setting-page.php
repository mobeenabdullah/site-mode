<div class="site_mode__wrap-form">    
    <form id="site-mode-import" method="post" enctype="multipart/form-data">
        <div class="option__row">
            <div class="option__row--label">
                <label for="btn-export" class="screen-reading-text"><?php _e('Export','site-mode');?></label>
            </div>
            <div class="option__row--field">
                <div class="button_wrapper">
                    <button class="btn btn_outline btn-export" id="btn-export"><?php _e('Export Button', 'site-mode');?></button>
                </div>
            </div>
        </div>
        <div class="option__row">
            <div class="option__row--label">
                <label for="fileSelect"><?php _e('Upload File', 'site-mode');?></label>
                <span class="info_text"><?php _e('upload json file to import json into db', 'site-mode');?></span>
            </div>
            <div class="option__row--field upload_file_wrapper">
                <div class="button_wrapper">
                    <label for="fileSelect" class="btn btn_outline choose-btn chooseBtn" id="chooseBtn"><?php _e('Choose', 'site-mode')?></label>
                    <input type="file" class="hiddenBtn" name="json-file" id="fileSelect" accept=".json">
                </div>
            </div>
        </div>   
        
        <div class="option__row submit_button">
            <div class="option__row--label">                
                <?php submit_button(); ?>
            </div>            
        </div>


        <!-- <div class="option__row">
            <div class="option__row--label">
                <label for="submit"><?php _e('submit', 'site-mode');?></label>
            </div>
            <div class="option__row--field">
                <input type="submit" name="submit" value="Submit">
            </div>
        </div> -->
    </form>
</div>

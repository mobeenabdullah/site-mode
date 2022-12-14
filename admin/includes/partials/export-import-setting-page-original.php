<div class="wrap">
    <div class="rex__wrap--cover-content-form">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <button class="button button-primary btn-export" id="btn-export">Export Button</button>

        <form id="rex-import" method="post" enctype="multipart/form-data">
            <h2>Upload File</h2>
            <input type="file" name="json-file" id="fileSelect" accept=".json"><br><br>
            <input type="submit" name="submit" value="Upload"><br><br>
            <!-- name of the input fields are going to be used in our php script-->
            <div> upload json file to import json into db</div>
        </form>
    </div>
</div>


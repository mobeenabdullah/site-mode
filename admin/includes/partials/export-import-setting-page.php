<div class="wrap">

    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <button class="button button-primary btn-export" id="btn-export">Export Button</button>
    <br>

<!--    <button class="button button-primary btn-import" id="btn-import">Import Button</button>-->

<!--    <form id="rex-import" enctype="multipart/form-data">-->
<!--        Select JSON file to upload:-->
<!--        <input type="file" name="rex-import-file" id="fileToUpload">-->
<!--        <input type="submit" value="Import CSV" name="submit">-->
<!--    </form>-->

    <form id="rex-import" method="post" enctype="multipart/form-data">
        <h2>Upload File</h2>
        <input type="file" name="json-file" id="fileSelect" accept=".json"><br><br>
        <input type="submit" name="submit" value="Upload"><br><br>
        <!-- name of the input fields are going to be used in our php script-->
        <div> upload json file to import json into db</div>
    </form>


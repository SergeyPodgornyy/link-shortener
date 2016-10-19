<?php
require_once('inc/utils.php');

$title = 'Main Page';
require_once('inc/header.php');
?>
    <div class="container main" data-page="main">
        <div class="row">
            <div class="col-xs-12">
                <div class="jumbotron jumbotron-fluid">
                    <p class="text-center">Welcome <span class="user-fullname"></span></p>
                    <br>
                    <div class="failer-action"></div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="Link" placeholder="Paste a link to shorten it" maxlength="255">
                        </div>
                        <div class="col-sm-3">
                            <button class="col-xs-12 btn btn-primary shorten">SHORTEN</button>
                        </div>
                    </div>
                    <br>
                    <div class="form-group" style="clear: both; margin-top: 20px">
                        <div class="col-sm-12 radio-btns">
                            <div class="switch">
                                <input type="radio" name="Type" id="public" class="switch-input form-control" value="public" checked>
                                <label for="public" class="switch-label">public</label>

                                <input type="radio" name="Type" id="private" class="switch-input form-control" value="private">
                                <label for="private" class="switch-label">private</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 result">
                <!--  -->
            </div>
        </div>
    </div>
<?php
require_once('inc/footer.php');
?>

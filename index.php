<!DOCTYPE html>
<html>
<head>
    <title>Webslesson Tutorial | Upload Multiple Image by Using PHP Ajax Jquery with Bootstrap Modal</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="loader-photos-object.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

</head>
<body>

<!-- Модальнок окон загрузки -->
<div id="uploadModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Загрузка фотографий</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="upload_form">
                    <label>Выберите до 10 фотографий в форматах .jpg, .jpeg, .png</label>
                    <input type="file" name="images[]" id="select_image" multiple />
                </form>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="zone-loader-photos">
        <div class="row">
            <div class="col-md-10 text-center" style="margin: 50px;">
                <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#uploadModal"><i class="fa fa-upload"></i>Загрузить фотографии</button>
            </div>
        </div>

        <!-- Здесь хранится порядок фотографий -->
        <input type="hidden" id="sort-position" value="">

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <!-- Сюда загружаются фото -->
                <ul id="gallery">

                    <!-- Специальная пустая фотография. Она нужна для обозначения главной фотографии -->
                    <img data-i="999" id="first" src="white_bg.jpg" ondrag="return false" ondragdrop="return false" ondragstart="return false" height="200px" width="300px" class="first-loader-img">

                    <?php
                    $images = glob("upload/*.*");
                    foreach($images as $image) {
                        $image_name = str_replace('upload/', '', $image);
                        $image_name = str_replace(['.jpg', '.jpeg', '.png', '.gif'], '', $image_name);
                        echo '<img src="' . $image .'" id="'.$image_name.'" class="img-in-zone-loader" data-src="'.$image.'" onmouseover="showDeleteMessage()" ondblclick="deletePhoto()">';
                    }
                    ?>
                </ul>
            </div>
        </div>

    </div>
</div>

<script src="sort-photos-object.js" type="text/javascript"></script>
<script src="loader-photos-object.js" type="text/javascript"></script>

</body>
</html>
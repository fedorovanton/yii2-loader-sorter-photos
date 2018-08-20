function showDeleteMessage() {
    $('img').hover(function() {
        // При наведении мыши на фото делать прозрачным (добавляется селектор CSS opacity-img)
        $( this ).addClass('opacity-img');
    }, function() {
        // Иначе обычная фотография (удаляется селектор CSS opacity-img)
        $( this ).removeClass('opacity-img');
    });
}

function deletePhoto() {
    $('.img-in-zone-loader').dblclick(function (event) {
        var src = $(this).attr('data-src');
        event.preventDefault();
        $.ajax({
            url: "actionAjaxDelete.php",
            method: "POST",
            data:'src=' + src,
            success:function(data){

                var sort_position = $("#sort-position").val(); // получить текущий порядок фото
                sort_position = sort_position.replace(src + ',', ''); // убрать из него удаляемую фотографию
                $("#sort-position").val(sort_position); // сохранить полученный порядок фото

                $('#' + data).hide("slow"); // плавно скрыть фотографию
                $('#' + data).remove(); // и затем удалить
            }
        });
    });
}

// При выборе фотографий срабатывает submit (функция описана ниже)
$('#select_image').change(function(){
    $('#upload_form').submit();
});

// Описание сабмита
$('#upload_form').on('submit', function(event){
    event.preventDefault(); // убрать состояние отправки

    $.ajax({
        url :"actionAjaxUpload.php",
        method:"POST",
        data:new FormData(this),
        contentType:false,
        processData:false,
        success:function(data){
            $('#select_image').val(''); // Очистить значения в input[type=file]
            $('#uploadModal').modal('hide'); // скрыть модальное окно добавления фото
            $('#gallery').html(data); // Отобразить загруженные фотографии в контейнере #gallery
            setPositionSort(); // сохранить текущий порядок
        }
    });

});

$( window ).load(function() {
    // При первом открытии страницы сохранить текущий порядок
    setPositionSort();
});

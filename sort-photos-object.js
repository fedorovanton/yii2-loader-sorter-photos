function sortable(rootEl, onUpdate){
    var dragEl;
    
    // Делаем всех детей перетаскиваемыми
    [].slice.call(rootEl.children).forEach(function (itemEl){
        itemEl.draggable = true;
    });
    
    // Фнукция отвечающая за сортировку
    function _onDragOver(evt){
        evt.preventDefault();
        evt.dataTransfer.dropEffect = 'move';
       
        var target = evt.target;
        if( target && target !== dragEl && target.nodeName == 'IMG' ){
            // Сортируем
            rootEl.insertBefore(dragEl, target.nextSibling || target);
        }
    }
    
    // Окончание сортировки
    function _onDragEnd(evt){
        evt.preventDefault();
       
        dragEl.classList.remove('ghost');
        rootEl.removeEventListener('dragover', _onDragOver, false);
        rootEl.removeEventListener('dragend', _onDragEnd, false);

        // Сообщаем об окончании сортировки
        onUpdate(dragEl);
    }
    
    // Начало сортировки
    rootEl.addEventListener('dragstart', function (evt){
        dragEl = evt.target; // Запоминаем элемент который будет перемещать
        
        // Ограничиваем тип перетаскивания
        evt.dataTransfer.effectAllowed = 'move';
        evt.dataTransfer.setData('Text', dragEl.textContent);

        // Пописываемся на события при dnd
        rootEl.addEventListener('dragover', _onDragOver, false);
        rootEl.addEventListener('dragend', _onDragEnd, false);

        setTimeout(function (){
            // Если выполнить данное действие без setTimeout, то
            // перетаскиваемый объект, будет иметь этот класс.
            dragEl.classList.add('ghost');
        }, 0)
    }, false);
}

function setPositionSort() {
    var sort_position = '';

    $('.img-in-zone-loader').each(function() {
        sort_position += $(this).attr('data-src') + ",";
    });

    sort_position = sort_position.replace("999,", "");
    // sort_position = sort_position.substring(0, sort_position.length - 1); // убрать последнюю запятую
    $("#sort-position").val(sort_position);
}

// Используем
sortable( document.getElementById('gallery'), function (item){
    setPositionSort();
});
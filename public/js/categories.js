$( document ).ready(function() {

    // recursive adding of parent select inputs

    function appendChildrenSelect(parentValue, triggerID) {
        $('#' + selectID).nextAll().remove();
        var selectID = parseInt(triggerID) + 1;
        $('#parent').val(parentValue);
        
        $.get('/categories/' + parentValue + '/children', function (data) {
            if(data) {
                $select = $('<select class="form-control" data-id="' + selectID + '"><option value="0">Bez rodzica</option></select>');
                $label = $('<label>Kategoria #' + selectID + ':</label>');
                
                $.each(data, function (i, value) {
                    $select.append($('<option>').text(value.name).attr('value', value.id));
                });
                
                $select.on('change', function(e) {
                    $('#parent').val($(this).val());
                    appendChildrenSelect($(this).val(), selectID);
                });

                $('#child-selects').append($label);
                $('#child-selects').append($select);
            } 
        });

    }

    $('[data-id="1"').on('change', function(e) {
        $(this).nextAll().remove();
        appendChildrenSelect(e.target.value, $(this).data('id'));
    });

    // end of parent select inputs

    // index population

    function getChildren(parentID) {
        $parent = $('li[data-id="' + parentID + '"]');
        
        $.get('/categories/' + parentID + '/children', function (data) {
            $childrenList = $('<ul class="categories-list" id="categories-list" data-parent="' + parentID + '"></ul>');                

            $.each(data, function(i, item) {
                var $button = $('<button type="button" class="btn btn-sm" data-type="toggle-children" data-id="' + item.id + '"><i class="fa fa-arrow-right"></i></button>');
                var $li = $('<li class="box category-top" data-id="' + item.id + '"><div class="box-header">'+
                    '<h3 class="box-title">'  + item.name + '</h3>' +
                    '<div class="pull-right box-tools">' +
                    '<a class="btn btn-sm" href="categories/edit/' + item.id + '"><i class="fa fa-pencil-square-o fa-2x"></i></a>' +
                    '<a class="btn btn-sm delete" data-id="' + item.id + '"><i class="fa fa-minus-square-o fa-2x"></i></a>' +
                    '</div></div></li>');
                $li.find('.box-header').prepend($button);
                $childrenList.append($li);
            });
            $parent.append($childrenList);
            var $btns = $('.categories-list[data-parent="' + parentID + '"]').find('button[data-type="toggle-children"]');
            $btns.on('click', function(e) {
                e.preventDefault();
                var id = $(this).data().id;

                var $childrenList = $('ul[data-parent="' + id +'"]');

                if ($childrenList[0]) {
                    $('ul[data-parent="' + id +'"]').toggle();
                    return;
                }

                getChildren(id);
            });
        });   
    }



    var $topCatButtons = $('#categories-list').find('button[data-type="toggle-children"]');

    $topCatButtons.each(function(e) {
        var id = $(this).data().id;
        
        $(this).on('click', function() {
            var $childrenList = $('ul[data-parent="' + id +'"]');

            if ($childrenList[0]) {
                $('ul[data-parent="' + id +'"]').toggle();
                return;
            }

            getChildren(id);
        });

    });

    //end of index population
    

// <label>Kategoria #1:</label>
// <select class="form-control" data-id="1">
//   <option value="0">Bez rodzica</option>
//   @foreach($topCategories as $topCategory)
//     <option value="{{$topCategory->id}}" data-test="{{$selected}}" @if($topCategory->id == $selected) selected @endif>{{$topCategory->name}}</option>
//   @endforeach
// </select>




    $editField = $('div#child-selects[data-type="edit"]');
    $rootItems = $editField.find('select[data-id="1"]').children();
    
    if($editField.length) {
        $.get('/categories/' + $editField.data('category') + '/ancestors', function (data) {
            if(data) {
                var max = Object.keys(data).length
                for (var i = 0; i < max; i++) {
                    if(i == 0) {
                        
                    }

                    var index = i+1;
                    var $select = $('select[data-id="' + index + '"]');
                    if($select.length) {
                        $select.val(data[i].id);     
                        $select.change();
                        console.log('select');
                        setTimeout(3000);
                    }
                    console.log('out of select');
                }
            }
        });
    }


    

    //
    


    $('.btn.btn-sm.delete').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        swal({
            title: "UWAGA",
            text: "Zamierzasz usunąć kategorię wraz z ewentualnymi podkategoriami. Tej akcji nie da się odwrócić. Czy kontynuować?",
            type: "error",
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Usuń",
            cancelButtonText: "Anuluj",
            showCancelButton: true,
        },
        function() {
            $.ajax({
                type: "POST",
                url: "/categories/delete/"+id,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    swal({
                        title: "Sukces!",
                        text: "Kategoria została usunięta",
                        type: "info",
                        showCancelButton: false,
                        closeOnConfirm: false,
                    },
                    function(){
                        window.location.href = "/categories";
                    });
                            
                    }         
            });
        });
    });



});
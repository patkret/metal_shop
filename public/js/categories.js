$( document ).ready(function() {

    var midCategories = $('.category-top>ul');

    var showMidButtons = $('button[data-type="toggle-mid"]').click(function () {
        var btnId = $(this).data('id');
        midCategories.each(function (){
            if ($(this).data('parent') === btnId) {
                $(this).toggle();  
            }
        }); 
    });
    
    var subCategories = $('.category-mid>ul');

    $('button[data-type="toggle-sub"]').click(function () {
        var btnId = $(this).data('id');
        subCategories.each(function (){
            if ($(this).data('parent') === btnId) {
                $(this).toggle();  
            }
        }); 
    });

    var subSubCategories = $('.category-sub>ul');

    $('button[data-type="toggle-sub-sub"]').click(function () {
        var btnId = $(this).data('id');
        console.log(btnId);
        subSubCategories.each(function (){
            if ($(this).data('parent') === btnId) {
                $(this).toggle();  
            }
        }); 
    });


    $('#parent-top').change(function() {
        $('#parent-mid').html('<option value="0">Bez rodzica</option>');
        $('#parent-sub').html('<option value="0">Bez rodzica</option>');
        $.get('/categories/'+ $(this).val() +'/children', function(data) {
            $.each(data, function(i, value) {
                
                $('#parent-mid').append($('<option>').text(value.name).attr('value', value.id));
            });
        })
    });

    $('#parent-mid').change(function() {
        $('#parent-sub').html('<option value="0">Bez rodzica</option>');
        $.get('/categories/'+ $(this).val() +'/children', function(data) {
            $.each(data, function(i, value) {
                $('#parent-sub').append($('<option>').text(value.name).attr('value', value.id));
            });
        })
    });

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
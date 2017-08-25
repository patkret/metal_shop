$( document ).ready(function() {
// CATEGORIES

    function makeSortable() {
        $("ul.categories-rows")
            .sortable({
                connectWith:'.categories-rows',
                update: function(event, ui) {
                    var $preceding = ui.item.prev().data('id') || 0;
                    var $following = ui.item.next().data('id') || 0;
                    var $category = ui.item.data('id');
                    $.get(window.location.origin + '/categories/move/' + $preceding + '/' + $category + '/' + $following, function (data) {
                       console.log(data);
                    });
                }
            })
            .disableSelection();
    }
    makeSortable();

    function getChildren(node) {
        var $category = $(node).closest('li');
        var $children = $category.children('ul'); //get children list if any

        if($children.length) {
            $children.toggle(); //if children list exists, toggle
        } else {
            $.get(window.location.origin + '/categories/' + $category.data('id') + '/children', function(data) {
                if(data.length) {
                    var $ul = '<ul class="list-group containers categories-rows"></ul>';
                    $category.append($ul);

                    $.each(data, function(i, el) {
                        $item = '<li class="list-group-item categories-rows" data-id="' + el.id + '">' +
                            '<span class="folder"><i class="fa fa-folder"></i></span>' +
                            '<span>[# ' + el.id + '] </span>' +
                            '<span class="box-title">' + el.name + '</span>' +
                            '<div class="pull-right">'+
                            '<a class="btn btn-sm" href="#"><i class="fa fa-level-down fa-2x"></i></a>' +
                            '<a class="btn btn-sm" href="categories/edit/' + el.id + '"><i class="fa fa-pencil-square-o fa-2x"></i></a>' +
                            '<a class="btn btn-sm delete" href="categories/delete/' + el.id + '"><i class="fa fa-minus-square-o fa-2x"></i></a>' +
                            '</div></li>';

                        $category.children('ul').append($item);
                    });

                    $category.children('ul').find('.folder').on('click', function (e) {
                        getChildren($(this));
                    });

                    $category.children('ul').find('.fa-level-down').on('click', function (e) {
                        enableAppending($(this));
                    });

                }
                makeSortable();
            });
        }
    }

    $('.folder').on('click', function(e) { //set listener on root categories
      getChildren($(this));
    });

    //alert before deleting a category
    $('.delete').on('click', function(e) {
       confirm('Usunięcie kategorii jest nieodwracalne. Kontynuować?') ? true : e.preventDefault();
    });

    function enableAppending(node) {
        var $parent = $(node).closest('li').prev();
        var $parentID = $parent.data('id') || 0;
        var $category = $(node).closest('li');
        var $categoryID = $category.data('id') || 0;

        $parent.append($category);

        $.get(window.location.origin + 'categories/' + $parentID + '/append/' + $categoryID, function(data) {
            console.log(data);
        });
    }

    //append inside preceding category
    $('.fa-level-down').on('click', function(e) {
        e.preventDefault();
        enableAppending($(this));
    });

    // COMMENT

    function selectAncestors(node) {
        $('#parent')[0].value = $(node).val() || $(node).prev().val(); //set parent value, or leave last correct parent

        $(node).nextAll().remove(); //clear next selects

        $.get(window.location.origin + '/categories/' + $(node).val() + '/children', function(data) {
            if(data.length) {
                $(node).parent().append('<select class="form-control ancestor"><option value="">Bez rodzica</option></select>');
                $.each(data, function(i, value) {
                    $(node).next('.ancestor').append('<option value="' + value.id + '">' + value.name + '</option>');
                });

                $(node).next('.ancestor').on('change', function(e) {
                    selectAncestors($(this));
                });
            }
        });
    }

    $('.ancestor').on('change', function(e) {
       selectAncestors($(this));
    });


// // PRODUCTS
    function productsByPhrase(node, draw) {
        var assigned = $('input[name=assigned]:checked').val();
        var available = $('#available')[0].checked ? 1 : 0;;
        var phrase = $('#search-box').val();

        var searchQuery = '/products/by-phrase/' + phrase +'/' + assigned + '/' + available;

        $(node).find('tbody').html('');
        $.get(window.location.origin + searchQuery, function (data) {
            if(data) {
                $.each(data, function(i, product) {
                    var $row = draw(product);
                    $(node).find('tbody').append($row);
                });
            }
        });
    }

    function productsByCategory(node, draw) {
        var parent = $('#parent')[0];
        var observer = new MutationObserver(function(mutation) {
            $(node).find('tbody').html('');
            $.get(window.location.origin + '/products/by-category/' + $(parent).val(), function (data) {
                if(data) {
                    $.each(data, function(i, product) {
                        var $row = draw(product);
                        $(node).find('tbody').append($row);
                    });
                }
            });
        });

        // pass in the target node, as well as the observer options
        observer.observe(parent, {attributes: true});
    }

    //helper functions for productsByCategory()
    function drawAssignRow(product) {
        return $('<tr><td>'+ product.id +'</td><td>'+ product.code +'</td><td>'+ product.name +
            '</td><td><input type="checkbox" data-type="unassign" value="'+ product.id +'"></td></tr>');
    }

    function drawEditRow(product) {
        var $toggle = $('<span class=" '+ (product.visible ? 'visible' : '') +'"><i class="fa fa-eye fa-2x"></i></span>');

        $toggle.on('click', function(e) {
            $.get(window.location.origin + '/products/toggle/' + product.id, function (data) {
                console.log(data);
            });

            $(this).toggleClass('visible');
        });

        var $row = $('<tr><td>'+ product.id +'</td><td>'+ product.code +'</td><td>'+ product.name +
            '</td><td><a href="' + window.location.origin + '/products/edit/' + product.id + '" class="btn btn-sm">'+
            '<i class="fa fa-pencil-square-o fa-2x"></i></a></td><td></td>' +
            '</tr>');

        $row.children().last().append($toggle);

        return $row;
    }

    function drawPriceEditRow(product) {
        var $edit = $('<span><i class="fa fa-pencil-square-o fa-2x"></i></span>');

        $edit.on('click', function(e) {
            $.get(window.location.origin + '/products/' + product.id + '/price', function (data) {
                var $form = $('#product-price');

                $form.find('#current-price')[0].value = data[data.price['price_basis']];
                $form.find('#price-type')[0].value = data.price['price_basis'];
                $form.find('#price-change')[0].value = data.price['factor'];
                $form.find('input:radio[value=' + data.price['show_missing'] +']').prop('checked', true);
            });

            $(this).toggleClass('visible');
        });

        var $row = $('<tr><td>'+ product.id +'</td><td>'+ product.code +'</td><td>'+ product.name +
            '<td></td></tr>');

        $row.children().last().append($edit);

        return $row;
    }

    $('#search-assignable').on('click', function(e) {
        productsByPhrase($('#assignable-products')[0], drawAssignRow);
    });
    $('#search-editable').on('click', function(e) {
        productsByPhrase($('#editable-products')[0], drawEditRow);
    });
    $('#search-editable-prices').on('click', function(e) {
        productsByPhrase($('#editable-products-price')[0], drawPriceEditRow);
    });

    productsByCategory($('#assigned-products')[0], drawAssignRow);
    productsByCategory($('#editable-products')[0], drawEditRow);
    productsByCategory($('#editable-products-price')[0], drawPriceEditRow);


    $('#assign').on('click', function(e) {
        //prepare request
        $selectedProducts = {
            selected: [],
            parent: $('#parent')[0].value
        };

        // fill ID's
        $('#queried-products').find('input[data-type="assign"]:checked').each(function(i, e) {
            $selectedProducts[i] = e.value;
            $selectedProducts['selected'].push(e.value);
        });

        $.ajax({
            type: "POST",
            url: "/products/assign",
            data : JSON.stringify($selectedProducts),
            data : $selectedProducts,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                console.log(data)
                $('#assigned-products > tbody').html('');
                $('#queried-products > tbody').html('');
                if(data) {
                    $.each(data, function(i, product) {
                      var $row = $('<tr><td>'+ product.id +'</td><td>'+ product.code +'</td><td>'+ product.name +'</td><td><input type="checkbox" data-type="unassign" value="'+ product.id +'"></td></tr>');
                    $('#assigned-products > tbody').append($row);
                    });
                }
            }
        });

    });

    $('#unassign').on('click', function(e) {
        $selectedProducts = {
            selected: [],
            parent: $('#parent')[0].value
        };

        $('#assigned-products').find('input[data-type="unassign"]:checked').each(function(i, e) {
            $selectedProducts[i] = e.value;
            $selectedProducts['selected'].push(e.value);
        });

        $.ajax({
            type: "POST",
            url: "/products/unassign",
            data : JSON.stringify($selectedProducts),
            data : $selectedProducts,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                console.log(data)
                }
        });

    });

    if($('#show-category-template')[0]) {
        $('#show-category-template').on('change', function(e) {
            $('#category-template').slideToggle();

        });
    }

// end of script
});
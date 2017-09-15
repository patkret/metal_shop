$( document ).ready(function() {
// CATEGORIES

    function makeSortable() {
        $("ul.categories-rows")
            .sortable({
                connectWith:'.categories-rows',
                update: function(event, ui) {
                    let $preceding = ui.item.prev().data('id') || 0;
                    let $following = ui.item.next().data('id') || 0;
                    let $category = ui.item.data('id');
                    $.get(window.location.origin + '/categories/move/' + $preceding + '/' + $category + '/' + $following, function (data) {
                       console.log(data);
                    });
                }
            })
            .disableSelection();
    }
    makeSortable();

    function getChildren(node) {
        let $category = $(node).closest('li');
        let $children = $category.children('ul'); //get children list if any

        if($children.length) {
            $children.toggle(); //if children list exists, toggle
        } else {
            $.get(window.location.origin + '/categories/' + $category.data('id') + '/children', function(data) {
                if(data.length) {
                    let $ul = '<ul class="list-group containers categories-rows"></ul>';
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
        let $parent = $(node).closest('li').prev();
        let $parentID = $parent.data('id') || 0;
        let $category = $(node).closest('li');
        let $categoryID = $category.data('id') || 0;

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
        let assigned = $('input[name=assigned]:checked').val();
        let available = $('#available')[0].checked ? 1 : 0;;
        let phrase = $('#search-box').val();

        let searchQuery = '/products/by-phrase/' + phrase +'/' + assigned + '/' + available;

        $(node).find('tbody').html('');
        $.get(window.location.origin + searchQuery, function (data) {
            if(data) {
                $.each(data, function(i, product) {
                    let $row = draw(product);
                    $(node).find('tbody').append($row);
                });
            }
        });
    }

    function productsByCategory(node, draw) {
        if(node) {
            let parent = $('#parent')[0];
            let observer = new MutationObserver(function(mutation) {
                $(node).find('tbody').html('');
                $.get(window.location.origin + '/products/by-category/' + $(parent).val(), function (data) {
                    if(data) {
                        $.each(data, function(i, product) {
                            let $row = draw(product);
                            $(node).find('tbody').append($row);
                        });
                    }
                });
            });

            // pass in the target node, as well as the observer options
            observer.observe(parent, {attributes: true});
        }
    }

    //helper functions for productsByCategory()
    function drawAssignRow(product) {
        return $('<tr><td>'+ product.id +'</td><td>'+ product.code +'</td><td>'+ product.name +
            '</td><td><input type="checkbox" data-type="assign" value="'+ product.id +'"></td></tr>');
    }

    function drawSetAssignRow(product) {
        return $('<tr><td>'+ product.id +'</td><td>'+ product.code +'</td><td>'+ product.name + '</td>'+
            '<td data-price="' + product[product.price_basis] +'">' + product[product.price_basis] + '</td><td>' + product.unit + '</td>'+
            '<td><input type="number" class="form-control" id="product-amount" name="product-amount" value="1"></td>'+
            '<td><input type="checkbox" data-type="assign" value="'+ product.id +'"></td></tr>');
    }

    function drawEditRow(product) {
        let $toggle = $('<span class=" '+ (product.visible ? 'visible' : '') +'"><i class="fa fa-eye fa-2x"></i></span>');

        $toggle.on('click', function(e) {
            $.get(window.location.origin + '/products/toggle/' + product.id, function (data) {
                console.log(data);
            });

            $(this).toggleClass('visible');
        });

        let $row = $('<tr><td>'+ product.id +'</td><td>'+ product.code +'</td><td>'+ product.name +
            '</td><td><a href="' + window.location.origin + '/products/edit/' + product.id + '" class="btn btn-sm">'+
            '<i class="fa fa-pencil-square-o fa-2x"></i></a></td><td></td>' +
            '</tr>');

        $row.children().last().append($toggle);

        return $row;
    }

    function drawPriceEditRow(product) {
        let $edit = $('<span><i class="fa fa-pencil-square-o fa-2x"></i></span>');

        $edit.on('click', function(e) {
            $.get(window.location.origin + '/products/show/' + product.id, function (data) {
                let $priceForm = $('#product-price');
                $priceForm[0].reset();
                console.log(data);

                //prices
                $priceForm.find('#current-price')[0].value = data[data.price_basis];
                $priceForm.find('#price-type option[value=' + data.price_basis +']').prop('selected','selected');
                $priceForm.find('input:radio[value=' + data.show_missing +']').prop('checked', true); //show missing

                $priceForm.find('#discounted-price')[0].value = data.custom_margin ? (data.avg_buy_price * (1 + data.custom_margin/100)).toFixed(2) : 0;
                $priceForm.find('#avg-buy-price')[0].value = data.avg_buy_price;
                $priceForm.find('#custom-margin')[0].value = data.custom_margin || 0;

                $priceForm.find('#value-discount')[0].value = data.value_discount;
                $priceForm.find('#vd-target')[0].value = data.vd_target;
                $priceForm.find('#amount-discount')[0].value = data.amount_discount;
                $priceForm.find('#ad-target')[0].value = data.ad_target;
                $priceForm.find('#amount-discount_2')[0].value = data.amount_discount_2;
                $priceForm.find('#ad-target_2')[0].value = data.ad_target_2;

            });

            $(this).toggleClass('visible');
        });

        let $row = $('<tr><td>'+ product.id +'</td><td>'+ product.code +'</td><td>'+ product.name +
            '<td></td></tr>');

        $row.children().last().append($edit);

        return $row;
    }

    $('#custom-margin').on('input', function(e) {
        let $priceForm = $('#product-price');

        $priceForm.find('#discounted-price')[0].value = ($priceForm.find('#avg-buy-price')[0].value * (1 + e.currentTarget.value/100)).toFixed(2);
    });


    $('#search-assignable').on('click', function(e) {
        productsByPhrase($('#assignable-products')[0], drawAssignRow);
    });
    productsByCategory($('#assigned-products')[0], drawAssignRow);

    $('#search-editable').on('click', function(e) {
        productsByPhrase($('#editable-products')[0], drawEditRow);
    });
    productsByCategory($('#editable-products')[0], drawEditRow);

    $('#search-editable-prices').on('click', function(e) {
        productsByPhrase($('#editable-products-price')[0], drawPriceEditRow);
    });
    productsByCategory($('#editable-products-price')[0], drawPriceEditRow);

    //set
    $('#search-set-assignable').on('click', function(e) {
        productsByPhrase($('#set-assignable-products')[0], drawSetAssignRow);
    });
    productsByCategory($('#set-assignable-products')[0], drawSetAssignRow);


    $('#assign').on('click', function(e) {
        //prepare request
        let $selectedProducts = {
            selected: [],
            parent: $('#parent')[0].value
        };

        // fill ID's
        $('#assignable-products').find('input[data-type="assign"]:checked').each(function(i, e) {
            $selectedProducts[i] = e.value;
            $selectedProducts['selected'].push(e.value);
        });
        console.log($selectedProducts);

        $.ajax({
            type: "POST",
            url: "/products/assign",
            data : JSON.stringify($selectedProducts),
            data : $selectedProducts,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                console.log(data)
                $('#assigned-products > tbody').html('');
                $('#assignable-products > tbody').html('');
                if(data) {
                    $.each(data, function(i, product) {
                      let $row = $('<tr><td>'+ product.id +'</td><td>'+ product.code +'</td><td>'+ product.name +'</td><td><input type="checkbox" data-type="unassign" value="'+ product.id +'"></td></tr>');
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

    $('#set-assign').on('click', function(e) {

        $('#set-assignable-products').find('input[data-type="assign"]:checked').each(function(i, e) {
            let $el = $(e).closest('tr').clone();
            $el.find('input').attr('data-type', 'unassign');
            $el.appendTo($('#set-assigned-products>tbody'));
            calcSetValue();
        });

    });

    $('#set-unassign').on('click', function(e) {

        $('#set-assigned-products').find('input[data-type="unassign"]:checked').each(function(i, e) {
            $(e).closest('tr').remove();
        });

    });

    if($('#show-category-template')[0]) {
        $('#show-category-template').on('change', function(e) {
            $('#category-template').slideToggle();

        });
    }

    // SETS

    function calcSetValue() {
        let setItemsPrice = 0;
        $('#set-assigned-products > tbody > tr').each(function(i, e) {
            let price = $(e).find('[data-price]').data('price');
            let $amount = $(e).find('#product-amount');
            setItemsPrice += Number(price * $amount.val());
            $amount.on('change', calcSetValue);
        });
        setItemsPrice = parseFloat(setItemsPrice).toFixed(2);
        console.log(setItemsPrice);
        $('#set-items-price').val(setItemsPrice);
        $('#set-savings').val(parseFloat($('#set-price').val() - setItemsPrice).toFixed(2));
    }

    if ($('#set-price')) {
        calcSetValue();
        $('#set-price').on('change', calcSetValue);
    }

// end of script


});
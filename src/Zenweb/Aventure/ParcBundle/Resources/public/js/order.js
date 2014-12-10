function ajouterCategorie($container, $table) {
    var $index = $('table tr').length;
    $index--;
    if ( $index > 0) {
        // get last index of collection
        $index = $('table tr:last td:nth-child(3) input').attr('name').substr(34,1);
        $index++;
    }
    var $prototype = $($container.attr('data-prototype')//.replace(/__name__label__/g, 'Activité n°' + (index + 1))
        .replace(/__name__/g, $index));
    ajouterLienSuppression($prototype);
    $table.append($prototype);
    addChangePriceListener($prototype);
    $("select").select2({
        minimumResultsForSearch: -1
    });
}

function ajouterCategorieExtra($container, $table) {
    var $index = $('table tr').length;
    $index--;
    if ( $index > 0) {
        // get last index of collection
        $index = $('table tr:last td:nth-child(2) input').attr('name').substr(32,1);
        $index++;
    }
    $('.extras-quantity').show();
    var $prototype = $($container.attr('data-prototype')//.replace(/__name__label__/g, 'Activité n°' + (index + 1))
        .replace(/__name__/g, $index));
    ajouterFakePrice($prototype);
    ajouterLienSuppression($prototype);
    $table.append($prototype);
    addChangePriceExtraListener($prototype);
    $("select").select2({
        minimumResultsForSearch: -1
    });
}

function ajouterFakePrice($prototype) {
    $prototype.append('<td class="priceLine">0 €</td>');
}


function ajouterLienSuppression($prototype) {
    $lienSuppression = $('<td><a href="#" class="btn btn-danger">Supprimer</a></td>');
    $prototype.append($lienSuppression);
    $lienSuppression.click(function (e) {
        $prototype.remove();
        e.preventDefault(); // évite qu'un # apparaisse dans l'URL
        return false;
    });
}

function addChangePriceListener($prototype) {
    $prototype.find("select:first").change(function () {
            getTimeSlots($(this).val(), $(this).parent().next().find('select'));
        }

    );
    $prototype.find("input:first").parent().prev().find('select').change(function () {
            getPrices($(this).val(), $(this).parent().parent().find('select:last'), $(this).parent().parent().find('input:first').val());
        }

    );
    $prototype.find("input:first").blur(function () {
            getPrices($(this).parent().prev().find('select').val(), $(this).parent().parent().find('select:last'), $(this).val());
        }

    );
    /**
     * @todo set total in js
     */
}

function addChangePriceExtraListener($prototype) {
    $prototype.find("select:first").change(function () {
            getPricesExtra($(this).val(), $(this).parent().parent().find('.priceLine'), $(this).parent().parent().find('input:first').val());
        }

    );
    $prototype.find("input:first").blur(function () {
            getPricesExtra($(this).parent().parent().find('select:first').val(), $(this).parent().parent().find('.priceLine'), $(this).val());
        }

    );
    /**
     * @todo set total in js
     */
}

$(document).ready(function () {
    var $container = $('div#createOrderActivity_order_items');
    if ($container.length) {
        var $table = $('table#activity_items > tbody');
        var $lienAjout = $('<button class="btn btn-info" id="ajout_item"><i class="icon-white icon-plus"></i> Ajouter une activité</button>');
        $('#add_item_contener').append($lienAjout);
        $lienAjout.click(function (e) {
            ajouterCategorie($container, $table);
            e.preventDefault(); // évite qu'un # apparaisse dans l'URL
            return false;
        });
        index = $container.find(':input').length;
        if (index == 0 && $('table tbody tr').length == 0) {
            ajouterCategorie($container, $table);
        } else {
            $container.children('div').each(function () {
                ajouterLienSuppression($(this));
            });
        }
    }


    var $container2 = $('div#createOrderExtra_order_extras');
    if ($container2.length) {
        var $show = $('table tbody tr').length;
        if(!$show) {
            $('.extras-quantity').hide();
        }
        var $table = $('table#extras_items > tbody');
        var $lienAjout = $('<button class="btn btn-info" id="ajout_item"><i class="icon-white icon-plus"></i> Ajouter une option</button>');

        // add click action on button extra
        $('.row.extra button').each(function( key, value ) {
            $(this).click(function(e) {
                ajouterCategorieExtra($container2, $table);
                e.preventDefault(); // évite qu'un # apparaisse dans l'URL

                //auto select input
                //$.find('select:last option[value="'+$(this).attr('id-select')+'"]').prop('selected', true);
                $('select:last option[value="'+$(this).attr('id-select')+'"]').attr('selected', true);

                $("select").select2({
                    minimumResultsForSearch: -1
                });
                return false;
            });
        });

        $container2.append($lienAjout);
        $lienAjout.click(function (e) {
            ajouterCategorieExtra($container2, $table);
            e.preventDefault(); // évite qu'un # apparaisse dans l'URL
            return false;
        });
        index = $container2.find(':input').length;
        if (index != 0) {
            $container2.children('div').each(function () {
                ajouterLienSuppression($(this));
            });
        }
        $( "select option:selected" ).each(function() {
            var to = $(this).parent().parent().parent().find('td:nth-child(2) input').val();
            getPricesExtra($(this).val(), $(this).parent().parent().parent().find('.priceLine'), $(this).parent().parent().parent().find('td:nth-child(2) input').val());
        });
    }


    $("td a.btn-danger").click(function (e) {
        $(this).parent().parent().remove();
        e.preventDefault(); // évite qu'un # apparaisse dans l'URL
        var $index = $('table tr').length;
        $index--;
        if ( $index == 0) {
            $('table').hide();
        }
        return false;
    });
});
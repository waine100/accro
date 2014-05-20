function ajouterCategorie($container, $table) {
    var $prototype = $($container.attr('data-prototype')//.replace(/__name__label__/g, 'Activité n°' + (index + 1))
        .replace(/__name__/g, index));
    ajouterLienSuppression($prototype);
    $table.append($prototype);
    addChangePriceListener($prototype);
    index++;
}

function ajouterCategorieExtra($container, $table) {
    var $prototype = $($container.attr('data-prototype')//.replace(/__name__label__/g, 'Activité n°' + (index + 1))
        .replace(/__name__/g, index));
    ajouterFakePrice($prototype);
    ajouterLienSuppression($prototype);
    $table.append($prototype);
    addChangePriceExtraListener($prototype);
    index++;
}

function ajouterFakePrice($prototype) {
    $prototype.append('<td class="priceLine">0 €</td>');
}


function ajouterLienSuppression($prototype) {
    $lienSuppression = $('<a href="#" class="btn btn-danger">Supprimer</a>');
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
        var $lienAjout = $('<a href="#" id="ajout_item" class="btn">Ajouter une activité</a>');
        $container.append($lienAjout);
        $lienAjout.click(function (e) {
            ajouterCategorie($container, $table);
            e.preventDefault(); // évite qu'un # apparaisse dans l'URL
            return false;
        });
        index = $container.find(':input').length;
        if (index == 0) {
            ajouterCategorie($container, $table);
        } else {
            $container.children('div').each(function () {
                ajouterLienSuppression($(this));
            });
        }
    }


    var $container2 = $('div#createOrderExtra_order_extras');
    if ($container2.length) {
        var $table = $('table#extras_items > tbody');
        var $lienAjout = $('<a href="#" id="ajout_item" class="btn">Ajouter une option</a>');
        $container2.append($lienAjout);
        $lienAjout.click(function (e) {
            ajouterCategorieExtra($container2, $table);
            e.preventDefault(); // évite qu'un # apparaisse dans l'URL
            return false;
        });
        index = $container2.find(':input').length;
        if (index == 0) {
            ajouterCategorieExtra($container2, $table);
        } else {
            $container2.children('div').each(function () {
                ajouterLienSuppression($(this));
            });
        }
    }
});
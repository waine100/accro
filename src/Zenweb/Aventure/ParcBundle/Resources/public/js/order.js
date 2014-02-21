function ajouterCategorie($container, $table) {
    var $prototype = $($container.attr('data-prototype')//.replace(/__name__label__/g, 'Activité n°' + (index + 1))
        .replace(/__name__/g, index));
    ajouterLienSuppression($prototype);
    $table.append($prototype);
    addChangePriceListener($prototype);
    index++;
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
            getPrices($(this).val(), $(this).parent().parent().find('select:last'), $(this).parent().parent().find('input:first').val());
        }

    );
    $prototype.find("input:first").blur(function () {
            getPrices($(this).parent().parent().find('select:first').val(), $(this).parent().parent().find('select:last'), $(this).val());
        }

    );
    /**
     * @todo set total in js
     */
}

$(document).ready(function () {
    var $container = $('div#createOrderActivity_items');
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
});
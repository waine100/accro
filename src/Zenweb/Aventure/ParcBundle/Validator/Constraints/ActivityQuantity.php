<?php
/**
 * Created by PhpStorm.
 * User: Rogal
 * Date: 16/02/14
 * Time: 19:27
 */

namespace Zenweb\Aventure\ParcBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\MissingOptionsException;

class ActivityQuantity extends Constraint {
    public $message = 'Il ne reste que {{ limit }} places disponibles pour {{ timeSlot }} .';
    public $tooMuchMessage = 'La quantité maximale saisissable est de {{ max }} pour {{ timeSlot }}';
    public $tooLessMessage = 'La quantité minimale saisissable est de {{ min }} pour {{ timeSlot }}';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }

    public function validatedBy()
    {
        return 'zenweb_aventure_parc_activity_quantity'; // Ici, on fait appel à l'alias du service
    }
} 
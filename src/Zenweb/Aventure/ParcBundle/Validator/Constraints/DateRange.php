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

class DateRange extends Constraint {
    public $minMessage = 'La date doit être supérieur au {{ limit }}.';
    public $invalidMessage = 'La date n\'est pas valide.';
    public $min;

    public function __construct($options = null)
    {
        parent::__construct($options);

        if (null === $this->min) {
            throw new MissingOptionsException('Either option "min" or "max" must be given for constraint ' . __CLASS__, array('min', 'max'));
        }

        if (null !== $this->min) {
            $this->min = new \DateTime($this->min);
        }

    }
} 
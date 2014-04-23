<?php
/**
 * Created by PhpStorm.
 * User: f.chantelot
 * Date: 22/04/14
 * Time: 14:29
 */

namespace Zenweb\Aventure\ParcBundle\Form;

use Zenweb\Aventure\ParcBundle\Entity\SalesFlatOrder;

class CreateOrder
{

    public $order;

    public $addUser = 1;

    public function __construct()
    {
        $this->order = new SalesFlatOrder();
    }
} 
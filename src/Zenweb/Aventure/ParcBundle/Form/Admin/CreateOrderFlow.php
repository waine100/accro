<?php
/**
 * Created by PhpStorm.
 * User: Rogal
 * Date: 04/02/14
 * Time: 21:19
 */
namespace Zenweb\Aventure\ParcBundle\Form\Admin;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

class CreateOrderFlow extends FormFlow{

    public function getName() {
        return 'createOrder';
    }

    protected function loadStepsConfig() {
        return array(
            array(
                'label' => 'Choose a parc',
                'type' => new CreateOrderParcForm(),
            ),
            array(
                'label' => 'Choose a date',
                'type' => new CreateOrderDateForm(),
            ),
            array(
                'label' => 'Choose your activities and options',
            ),
            array(
                'label' => 'Choose your customer or create a new one',
            ),
            array(
                'label' => 'confirmation',
            ),
        );
    }
} 
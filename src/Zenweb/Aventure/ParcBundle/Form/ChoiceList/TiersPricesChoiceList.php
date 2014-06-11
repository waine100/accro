<?php
/**
 * Created by PhpStorm.
 * User: f.chantelot
 * Date: 10/06/14
 * Time: 18:26
 */

namespace Zenweb\Aventure\ParcBundle\Form\ChoiceList;

use Symfony\Component\Form\Extension\Core\ChoiceList\LazyChoiceList;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;

class TiersPricesChoiceList extends LazyChoiceList
{
    private $em;
    private $userId;
    private $idTimeSlot;
    private $qty;

    public function __construct(EntityManager $em, $userId, $idTimeSlot, $qty)
    {
        $this->em         = $em;
        $this->userId     = $userId;
        $this->idTimeSlot = $idTimeSlot;
        $this->qty        = $qty;
    }

    protected function loadChoiceList()
    {
        $choices = array();
        $labels  = array();

        if (!empty($this->userId) && !empty($this->idTimeSlot) && !empty($this->qty)) {
            if ($this->userId != -1) { //Exist already
                /**
                 * First get the group of the User
                 */
                $user     = $this->em
                    ->getRepository('ZenwebAventureParcBundle:User')
                    ->find($this->userId);
                $groupsId = $user->getGroupsId();
            } else { // New user. Get the default group
                $groupsId[] = $this->getDoctrine()->getRepository('ZenwebAventureParcBundle:Group')->findOneByName('Particulier')->getId();
            }
            $prices = $this->em->getRepository('ZenwebAventureParcBundle:Price')
                ->getAvailablePrices($groupsId, $this->idTimeSlot, $this->qty);

            foreach ($prices as $price) {
                $choices[$price['id']] = $price['name'];
            }
        }
        return new SimpleChoiceList($choices);

    }
} 
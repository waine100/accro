<?php
/**
 * Created by PhpStorm.
 * User: Rogal
 * Date: 12/02/14
 * Time: 21:30
 */

namespace Zenweb\Aventure\ParcBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zenweb\Aventure\ParcBundle\Entity\Group;

class LoadGroupData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     * php app/console doctrine:fixtures:load (--append)
     */
    public function load(ObjectManager $manager)
    {
        $groupParticulier = new Group('Particulier', array('ROLE_USER'));
        $groupEntreprise = new Group('Entreprise', array('ROLE_USER'));
        $groupScolaires = new Group('Scolaires', array('ROLE_USER'));
        $groupCentre = new Group('Centres de loisirs', array('ROLE_USER'));
        $groupCE = new Group('CE', array('ROLE_USER'));

        $manager->persist($groupParticulier);
        $manager->persist($groupEntreprise);
        $manager->persist($groupScolaires);
        $manager->persist($groupCentre);
        $manager->persist($groupCE);

        $manager->flush();
    }

} 
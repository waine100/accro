<?php
namespace Zenweb\Aventure\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;

/**
 * Description
 *
 * @category Zenweb
 * @package  Zenweb_Aventure
 *
 * @author   Flavien Chantelot <flavien@zenweb.fr>
 */
class User extends BaseUser
{
    /**
     * Constructor
     *
     * @return User
     *
     * @author  Flavien Chantelot <flavien@zenweb.fr>
     */
    public function __construct()
    {
        parent::__construct();
        /**
         * TODO
         */
    }
    /**
     * @var integer
     */
    protected  $id;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}

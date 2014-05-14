<?php

namespace Zenweb\Aventure\UserBundle\Controller;

/**
 * This class is inspired from the FOS Profile Controller, except :
 *   - only twig is supported
 *   - separation of the user authentication form with the profile form
 */
use Sonata\UserBundle\Controller\ProfileFOSUser1Controller as BaseController;

class ProfileFOSUser1Controller extends BaseController
{
    /**
     * @return Response
     *
     * @throws AccessDeniedException
     */
    public function showAction()
    {
        return $this->editProfileAction();
    }
}

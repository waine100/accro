<?php
/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Zenweb\Aventure\UserBundle\Controller;
use FOS\UserBundle\Controller\SecurityController as BaseController;

class CheckoutSecurityController extends BaseController
{
    protected function renderLogin(array $data)
    {
        $template = sprintf('ZenwebAventureUserBundle:Security:checkout_login.html.twig');

        return $this->container->get('templating')->renderResponse($template, $data);
    }
}
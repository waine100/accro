<?php

namespace Zenweb\Aventure\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ZenwebAventureUserBundle extends Bundle
{
    public function getParent()
    {
        return 'SonataUserBundle';
    }
}

<?php

namespace iList\BackendBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class iListBackendBundle extends Bundle
{
	public function getParent()
    {
        return 'FOSUserBundle';
    }
}
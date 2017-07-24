<?php

namespace FS\ExposeBundle;

use FS\ExposeBundle\DependencyInjection\Compiler\AddIntrusionHandlerCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class FSExposeBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new AddIntrusionHandlerCompilerPass());
    }

}

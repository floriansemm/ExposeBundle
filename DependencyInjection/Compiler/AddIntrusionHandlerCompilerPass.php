<?php

namespace FS\ExposeBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class AddIntrusionHandlerCompilerPass implements CompilerPassInterface
{
    const SERVICE_TAG_NAME = 'expose.intrusion_handler';

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $tags = $container->findTaggedServiceIds(self::SERVICE_TAG_NAME);

        if (count($tags) > 0) {
            $definition = $container->getDefinition('expose.request_listener');

            foreach ($tags as $alias => $taggedService) {
                $definition->addMethodCall('addHandler', [new Reference($alias)]);
            }
        }
    }

}
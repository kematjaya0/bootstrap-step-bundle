<?php

/**
 * This file is part of the cash-in.
 */

namespace Kematjaya\StepBundle\CompilerPass;

use Kematjaya\StepBundle\Step\StepInterface;
use Kematjaya\StepBundle\Builder\StepBuilderInterface;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * @package App\CompilerPass
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class StepCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container) 
    {
        $definition = $container->findDefinition(StepBuilderInterface::class);
        $taggedServices = $container->findTaggedServiceIds(StepInterface::TAG_NAME);
        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addStep', [new Reference($id)]);
        }
    }
}

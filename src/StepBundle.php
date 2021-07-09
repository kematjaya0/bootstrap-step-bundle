<?php

/**
 * This file is part of the step-bundle.
 */

namespace Kematjaya\StepBundle;

use Kematjaya\StepBundle\CompilerPass\StepCompilerPass;
use Kematjaya\StepBundle\Step\StepInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @package Kematjaya\StepBundle
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class StepBundle extends Bundle
{
    public function build(ContainerBuilder $container) 
    {
        $container->registerForAutoconfiguration(StepInterface::class)
                ->addTag(StepInterface::TAG_NAME);
        
        $container->addCompilerPass(new StepCompilerPass());
        
        parent::build($container);
    }
}

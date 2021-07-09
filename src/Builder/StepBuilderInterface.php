<?php

/**
 * This file is part of the step-bundle.
 */

namespace Kematjaya\StepBundle\Builder;

use Kematjaya\StepBundle\Step\StepInterface;
use Doctrine\Common\Collections\Collection;

/**
 * @package Kematjaya\StepBundle\Builder
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface StepBuilderInterface 
{
    
    public function addStep(StepInterface $subscriber): self;
    
    public function getSteps():Collection;
}

<?php

/**
 * This file is part of the step-bundle.
 */

namespace Kematjaya\StepBundle\Step;

/**
 * @package Kematjaya\StepBundle\Step
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
interface RoleSupportedStepInterface 
{
    public function getRoles():array;
}

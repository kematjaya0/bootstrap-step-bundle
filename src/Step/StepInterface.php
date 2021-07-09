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
interface StepInterface 
{
    const TAG_NAME = 'kematjaya.step';
    
    public function getSequence():int;
    
    public function getStatus():bool;
    
    public function getTitle():string;
    
    public function getDescription():?string;
    
    public function getLink():?string;
    
    public function getCode():string;
    
    public function getNext():?StepInterface;
    
    public function setNext(StepInterface $next);
}

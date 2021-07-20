<?php

/**
 * This file is part of the step-bundle.
 */

namespace Kematjaya\StepBundle\Builder;

use Kematjaya\StepBundle\Step\StepInterface;
use Kematjaya\StepBundle\Step\ActivatedStepInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @package Kematjaya\StepBundle\Builder
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class StepBuilder implements StepBuilderInterface
{
    /**
     * 
     * @var Collection
     */
    protected $subscribers;
    
    public function __construct() 
    {
        $this->subscribers = new ArrayCollection();
    }
    
    public function addStep(StepInterface $subscriber): StepBuilderInterface 
    {
        if (!$this->subscribers->contains($subscriber)) {
            $this->subscribers->add($subscriber);
        }
        
        return $this;
    }

    public function getSteps(): Collection 
    {
        $iterator = $this->subscribers->getIterator();
        $iterator->uasort(function (StepInterface $stepA, StepInterface $stepB) {
            return $stepA->getSequence() > $stepB->getSequence() ? 1 : -1;
        });
        
        $result = $this->setActive(
            $this->setNext(
                new ArrayCollection(iterator_to_array($iterator))
            )
        );
        
        return $result;
    }

    protected function setNext(Collection $result): Collection
    {
        $result->map(function (StepInterface $step) use ($result) {
            $nexts = $result->filter(function (StepInterface $x) use ($step) {
                
                return $x->getSequence() > $step->getSequence();
            });
            if ($nexts->isEmpty()) {
                
                return;
            }
            
            $step->setNext($nexts->first());
        });
        
        return $result;
    }
    
    public function setActive(Collection $result): Collection
    {
        $dones = $result->filter(function (StepInterface $step) {
            return $step->getStatus();
        });
        
        $result->map(function (StepInterface $step) use ($dones) {
            if (!$step instanceof ActivatedStepInterface) {
                
                return;
            }
            
            if (!$dones->last()) {
                $step->setActive(true);
                return;
            }
            
            if ($step->getStatus()) {
                return;
            }
            
            $step->setActive(true);
            return;
        });
        
        return $result;
    }
}

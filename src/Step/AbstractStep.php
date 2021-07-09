<?php

/**
 * This file is part of the step-bundle.
 */

namespace Kematjaya\StepBundle\Step;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @package Kematjaya\StepBundle\Step
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
abstract class AbstractStep implements StepInterface, ActivatedStepInterface
{
    /**
     * 
     * @var UrlGeneratorInterface
     */
    protected $urlGenerator;
    
    /**
     * 
     * @var TranslatorInterface
     */
    protected $translator;
    
    /**
     * 
     * @var StepInterface
     */
    private $next;
    
    /**
     * 
     * @var bool
     */
    private $active;
    
    public function __construct(UrlGeneratorInterface $urlGenerator, TranslatorInterface $translator) 
    {
        $this->urlGenerator = $urlGenerator;
        $this->translator = $translator;
        $this->active = false;
    }
    
    public function getCode(): string 
    {
        $title = $this->getTitle();
        
        return strtolower(
            str_replace(" ", "_", $title)
        );
    }
    
    public function getNext():?StepInterface
    {
        return $this->next;
    }
    
    public function setNext(StepInterface $next)
    {
        $this->next = $next;
        
        return $this;
    }
    
    public function isActive():bool
    {
        return $this->active;
    }
    
    public function setActive(bool $active): ActivatedStepInterface
    {
        $this->active = $active;
        
        return $this;
    }
}

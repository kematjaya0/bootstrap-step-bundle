<?php

/**
 * This file is part of the step-bundle.
 */

namespace Kematjaya\StepBundle\Twig;

use Kematjaya\StepBundle\Builder\StepBuilderInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Twig\Environment;

/**
 * @package Kematjaya\StepBundle\Twig
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class StepExtension extends AbstractExtension
{
    /**
     * 
     * @var Environment
     */
    private $twig;
    
    /**
     * 
     * @var StepBuilderInterface
     */
    private $builder;
    
    public function __construct(Environment $twig, StepBuilderInterface $builder) 
    {
        $this->twig = $twig;
        $this->builder = $builder;
    }
    
    public function getFunctions()
    {
        return [
            new TwigFunction('step',[$this, 'render'], ['is_safe' => ['html']])
        ];
    }
    
    public function render():?string
    {
        $steps = $this->builder->getSteps();
        if ($steps->isEmpty()) {
            
            return null;
        }
        
        return $this->twig->render('@Step/step.html.twig', [
            'steps' => $steps
        ]);
    }
}

<?php

/**
 * This file is part of the step-bundle.
 */

namespace Kematjaya\StepBundle\Builder;

use Kematjaya\StepBundle\Step\StepInterface;
use Kematjaya\StepBundle\Step\RoleSupportedStepInterface;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @package Kematjaya\StepBundle\Builder
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class RoleStepBuilder extends StepBuilder 
{
    /**
     * 
     * @var TokenStorageInterface
     */
    private $tokenStorage;
    
    public function __construct(TokenStorageInterface $tokenStorage) 
    {
        $this->tokenStorage = $tokenStorage;
        
        parent::__construct();
    }
    
    public function getSteps(): Collection
    {
        $steps = parent::getSteps();
        
        return $steps->filter(function (StepInterface $step) {
            if ($step instanceof RoleSupportedStepInterface) {
                $supportedRoles = $step->getRoles();
                
                foreach ($this->tokenStorage->getToken()->getRoleNames() as $role) {
                    if (in_array($role, $supportedRoles)) {
                        return true;
                    }
                }
                
                return false;
            }
            
            return true;
        });
    }
}

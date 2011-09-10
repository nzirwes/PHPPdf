<?php

/*
 * Copyright 2011 Piotr Śliwa <peter.pl7@gmail.com>
 *
 * License information is in LICENSE file
 */

namespace PHPPdf\Node\Behaviour;

use PHPPdf\Exception\Exception,
    PHPPdf\Node\Manager;

/**
 * @author Piotr Śliwa <peter.pl7@gmail.com>
 */
class Factory
{
    private $nodeManager;
    
    public function setNodeManager(Manager $manager)
    {
        $this->nodeManager = $manager;
    }
    
    /**
     * @return Behaviour
     */
    public function create($name, $arg)
    {
        switch($name)
        {
            case 'href':
                return new GoToUrl($arg);
            case 'ref':
                return new GoToInternal($this->nodeManager->get($arg));
            case 'bookmark':
                return new Bookmark($arg);
            case 'note':
                return new StickyNote($arg);
            default:
                throw new Exception(sprintf('Behaviour "%s" dosn\'t exist.', $name));
        }
    }

    public function getSupportedBehaviourNames()
    {
        return array('href', 'ref', 'bookmark', 'note');
    }
}
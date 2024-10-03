<?php

namespace WonderWp\Component\Hook;

use WonderWp\Component\DependencyInjection\Container;
use WonderWp\Component\PluginSkeleton\AbstractManager;
use WonderWp\Component\Service\AbstractService;

abstract class AbstractHookService extends AbstractService implements HookServiceInterface
{
    /** @var HookManager */
    private $hookManager;

    /**
     * @inheritDoc
     */
    public function __construct(AbstractManager $manager = null)
    {
        parent::__construct($manager);
        $this->hookManager = Container::getInstance()->offsetGet('wwp.hook.manager');

        return $this;
    }

    public function addAction($tag, $function_to_add, $priority = 10, $accepted_args = 1)
    {
        return $this->hookManager->addAction($tag, $function_to_add, $priority, $accepted_args);
    }

    public function addFilter($tag, $function_to_add, $priority = 10, $accepted_args = 1)
    {
        return $this->hookManager->addFilter($tag, $function_to_add, $priority, $accepted_args);
    }

    public function removeFilter($tag, $function_to_remove, $priority = 10)
    {
        return $this->hookManager->removeFilter($tag, $function_to_remove, $priority = 10);
    }

}

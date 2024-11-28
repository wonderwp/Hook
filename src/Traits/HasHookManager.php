<?php

namespace WonderWp\Component\Hook\Traits;

use WonderWp\Component\Hook\HookManagerInterface;

trait HasHookManager
{
    protected HookManagerInterface $hookManager;

    public function setHookManager(HookManagerInterface $hookManager): static
    {
        $this->hookManager = $hookManager;
        return $this;
    }

    public function getHookManager(): HookManagerInterface
    {
        return $this->hookManager;
    }

    public function addAction($tag, $function_to_add, $priority = 10, $accepted_args = 1)
    {
        return $this->hookManager->addAction($tag, $function_to_add, $priority, $accepted_args);
    }

    public function removeAction($tag, $function_to_remove, $priority = 10)
    {
        return $this->hookManager->removeAction($tag, $function_to_remove, $priority);
    }

    public function addFilter($tag, $function_to_add, $priority = 10, $accepted_args = 1)
    {
        return $this->hookManager->addFilter($tag, $function_to_add, $priority, $accepted_args);
    }

    public function removeFilter($tag, $function_to_remove, $priority = 10)
    {
        return $this->hookManager->removeFilter($tag, $function_to_remove, $priority);
    }
}

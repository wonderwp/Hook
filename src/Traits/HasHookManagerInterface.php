<?php

namespace WonderWp\Component\Hook\Traits;

use WonderWp\Component\Hook\HookManagerInterface;

interface HasHookManagerInterface
{
    public function setHookManager(HookManagerInterface $hookManager): static;
    public function getHookManager(): HookManagerInterface;
    public function addAction($tag, $function_to_add, $priority = 10, $accepted_args = 1);
    public function removeAction($tag, $function_to_remove, $priority = 10);
    public function addFilter($tag, $function_to_add, $priority = 10, $accepted_args = 1);
    public function removeFilter($tag, $function_to_remove, $priority = 10);
}

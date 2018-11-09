<?php

namespace WonderWp\Component\Hook;

class HookManager implements HookManagerInterface
{

    /** @inheritdoc */
    public function addAction($tag, $function_to_add, $priority = 10, $accepted_args = 1)
    {
        return add_action($tag, $function_to_add, $priority, $accepted_args);
    }

    /** @inheritdoc */
    public function addFilter($tag, $function_to_add, $priority = 10, $accepted_args = 1)
    {
        return add_filter($tag, $function_to_add, $priority, $accepted_args);
    }

    /** @inheritdoc */
    public function removeFilter($tag, $function_to_remove, $priority = 10)
    {
        return remove_filter($tag, $function_to_remove, $priority = 10);
    }

}

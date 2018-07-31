<?php

namespace WonderWp\Component\Hook;

class HookManager implements HookManagerInterface
{


    public function addAction($tag, $function_to_add, $priority = 10, $accepted_args = 1)
    {
        return add_action($tag, $function_to_add, $priority, $accepted_args);
    }

    public function addFilter($tag, $function_to_add, $priority = 10, $accepted_args = 1)
    {
        return add_filter($tag, $function_to_add, $priority, $accepted_args);
    }

}

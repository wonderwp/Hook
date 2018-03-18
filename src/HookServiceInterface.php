<?php

namespace WonderWp\Component\Hook;

interface HookServiceInterface
{
    /**
     * Typically where you'll have all your add_action and add_filter calls
     * @return static
     */
    public function run();
}

<?php

declare(strict_types=1);

namespace {
    if (!function_exists('add_action')) {
        function add_action($hook, $callback, $priority = 10, $accepted_args = 1)
        {
            $GLOBALS['wwp_test_actions'][$hook][] = compact('callback', 'priority', 'accepted_args');

            return true;
        }
    }

    if (!function_exists('remove_action')) {
        function remove_action($hook, $callback, $priority = 10)
        {
            return true;
        }
    }

    if (!function_exists('add_filter')) {
        function add_filter($hook, $callback, $priority = 10, $accepted_args = 1)
        {
            $GLOBALS['wwp_test_filters'][$hook][] = compact('callback', 'priority', 'accepted_args');

            return true;
        }
    }

    if (!function_exists('remove_filter')) {
        function remove_filter($hook, $callback, $priority = 10)
        {
            return true;
        }
    }
}

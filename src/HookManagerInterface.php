<?php

namespace WonderWp\Component\Hook;

interface HookManagerInterface
{

    /**
     * Hooks a function on to a specific action.
     *
     * Actions are the hooks that the WordPress core launches at specific points
     * during execution, or when specific events occur. Plugins can specify that
     * one or more of its PHP functions are executed at these points, using the
     * Action API.
     *
     * @since 1.2.0
     *
     * @param string   $tag             The name of the action to which the $function_to_add is hooked.
     * @param callable $function_to_add The name of the function you wish to be called.
     * @param int      $priority        Optional. Used to specify the order in which the functions
     *                                  associated with a particular action are executed. Default 10.
     *                                  Lower numbers correspond with earlier execution,
     *                                  and functions with the same priority are executed
     *                                  in the order in which they were added to the action.
     * @param int      $accepted_args   Optional. The number of arguments the function accepts. Default 1.
     *
     * @return true Will always return true.
     */
    public function addAction($tag, $function_to_add, $priority = 10, $accepted_args = 1);

    /**
     * Hook a function or method to a specific filter action.
     *
     * WordPress offers filter hooks to allow plugins to modify
     * various types of internal data at runtime.
     *
     * A plugin can modify data by binding a callback to a filter hook. When the filter
     * is later applied, each bound callback is run in order of priority, and given
     * the opportunity to modify a value by returning a new value.
     *
     * The following example shows how a callback function is bound to a filter hook.
     *
     * Note that `$example` is passed to the callback, (maybe) modified, then returned:
     *
     *     function example_callback( $example ) {
     *         // Maybe modify $example in some way.
     *         return $example;
     *     }
     *     add_filter( 'example_filter', 'example_callback' );
     *
     * Bound callbacks can accept from none to the total number of arguments passed as parameters
     * in the corresponding apply_filters() call.
     *
     * In other words, if an apply_filters() call passes four total arguments, callbacks bound to
     * it can accept none (the same as 1) of the arguments or up to four. The important part is that
     * the `$accepted_args` value must reflect the number of arguments the bound callback *actually*
     * opted to accept. If no arguments were accepted by the callback that is considered to be the
     * same as accepting 1 argument. For example:
     *
     *     // Filter call.
     *     $value = apply_filters( 'hook', $value, $arg2, $arg3 );
     *
     *     // Accepting zero/one arguments.
     *     function example_callback() {
     *         ...
     *         return 'some value';
     *     }
     *     add_filter( 'hook', 'example_callback' ); // Where $priority is default 10, $accepted_args is default 1.
     *
     *     // Accepting two arguments (three possible).
     *     function example_callback( $value, $arg2 ) {
     *         ...
     *         return $maybe_modified_value;
     *     }
     *     add_filter( 'hook', 'example_callback', 10, 2 ); // Where $priority is 10, $accepted_args is 2.
     *
     * *Note:* The function will return true whether or not the callback is valid.
     * It is up to you to take care. This is done for optimization purposes, so
     * everything is as quick as possible.
     *
     * @since 0.71
     *
     * @global array   $wp_filter       A multidimensional array of all hooks and the callbacks hooked to them.
     *
     * @param string   $tag             The name of the filter to hook the $function_to_add callback to.
     * @param callable $function_to_add The callback to be run when the filter is applied.
     * @param int      $priority        Optional. Used to specify the order in which the functions
     *                                  associated with a particular action are executed. Default 10.
     *                                  Lower numbers correspond with earlier execution,
     *                                  and functions with the same priority are executed
     *                                  in the order in which they were added to the action.
     * @param int      $accepted_args   Optional. The number of arguments the function accepts. Default 1.
     *
     * @return true
     */
    function addFilter($tag, $function_to_add, $priority = 10, $accepted_args = 1);

}

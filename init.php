<?php

use WonderWp\Component\Hook\HookManager;
use WonderWp\Component\Hook\HookService;
use WonderWp\Component\PluginSkeleton\Exception\ServiceNotFoundException;
use WonderWp\Component\PluginSkeleton\ManagerAwareInterface;
use WonderWp\Component\Service\ServiceInterface;
use WonderWp\Component\PluginSkeleton\ManagerInterface;
use WonderWp\Component\DependencyInjection\Container;
use WonderWp\Component\Hook\HookServiceInterface;

add_action('wonderwp.loader.load', 'wwp_register_hook_definitions_towards_container', 10, 2);
add_action('wwp.abstract_manager.run', 'wwp_register_hook_service_towards_manager', 10, 2);

function wwp_register_hook_definitions_towards_container(Container $container)
{
    $container['wwp.hook.manager'] = function () {
        return new HookManager();
    };
    
    $container['wwp.hook.defaultService'] = $container->factory(function () {
        return new HookService();
    });
}

function wwp_register_hook_service_towards_manager(ManagerInterface $manager, Container $container)
{
    // Hooks
    try {
        $hookService = $manager->getService(ServiceInterface::HOOK_SERVICE_NAME);
        if ($hookService instanceof HookServiceInterface) {
            $hookService->register();
        }
    } catch (ServiceNotFoundException $e) {
        if ($e->getServiceType() === ServiceInterface::HOOK_SERVICE_NAME) {
            //No hook service defined, use the default one instead
            $hookService = $container['wwp.hook.defaultService'];
            if ($hookService instanceof HookServiceInterface) {
                if($hookService instanceof ManagerAwareInterface){
                    $hookService->setManager($manager);
                }
                $hookService->register();
            }
        } else {
            throw $e;
        }
    }
}

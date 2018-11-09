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

    /**
     * @param string $domain
     * @param string $locale
     * @param string $languageDir
     *
     * @return bool
     */
    public function loadTextdomain($domain = '', $locale = '', $languageDir = '')
    {
        $domain      = $domain ?: $this->manager->getConfig('textDomain');
        $locale      = $locale ?: apply_filters('plugin_locale', get_locale(), $domain);
        $languageDir = $languageDir ?: $this->manager->getConfig('path.base') . '/languages/';
        $container   = Container::getInstance();
        $moBase      = $container->offsetExists('wwp.path.defaultlanguagedir.plugins') ? $container['wwp.path.defaultlanguagedir.plugins'] : '';

        // wp-content/languages/plugins/plugin-name-de_DE.mo
        $genericLoaded = load_textdomain($domain, $moBase . $domain . '-' . $locale . '.mo');
        // wp-content/plugins/plugin-name/languages/plugin-name-de_DE.mo
        $specificLoaded = load_plugin_textdomain($domain, false, $languageDir);

        return $genericLoaded || $specificLoaded;
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

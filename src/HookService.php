<?php

namespace WonderWp\Component\Hook;

use WonderWp\Component\DependencyInjection\Container;
use WonderWp\Component\PluginSkeleton\Service\RegistrableInterface;

class HookService extends AbstractHookService
{
    public function register()
    {
        $this->autoload();
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
        $domain = $domain ?: $this->manager->getConfig('textDomain');
        $locale = $locale ?: apply_filters('plugin_locale', get_locale(), $domain);
        $languageDir = $languageDir ?: $this->manager->getConfig('path.base') . '/languages/';
        $container = Container::getInstance();
        $moBase = $container->offsetExists('wwp.path.defaultlanguagedir.plugins') ? $container['wwp.path.defaultlanguagedir.plugins'] : '';

        // wp-content/languages/plugins/plugin-name-de_DE.mo
        $genericLoaded = load_textdomain($domain, $moBase . $domain . '-' . $locale . '.mo');
        // wp-content/plugins/plugin-name/languages/plugin-name-de_DE.mo
        $specificLoaded = load_plugin_textdomain($domain, false, $languageDir);

        return $genericLoaded || $specificLoaded;
    }

    public function autoload(array $classNameFromFiles = [], array $discoveryPaths = [], callable $successCallback = null): array
    {
        $defaultPaths = [
            'hooks' => $this->manager->getConfig('path.root') . 'includes' . DIRECTORY_SEPARATOR . 'Hooks',
        ];
        $discoveryPaths = array_merge($defaultPaths, $discoveryPaths);
        return parent::autoload($classNameFromFiles, $discoveryPaths, $successCallback);
    }


}

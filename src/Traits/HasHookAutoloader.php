<?php

namespace WonderWp\Component\Hook\Traits;

trait HasHookAutoloader
{
    public function autoload(array $classNameFromFiles = [], array $discoveryPaths = [], callable $successCallback = null, array $excludedClasses=[]): array
    {
        $discoveryPathsRoots = $this->manager->getConfig('discoveryPathsRoots', [
            'hooks' => rtrim($this->manager->getConfig('path.root') ?? '', DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR
        ]);
        $discoverFolderSuffix = $this->manager->getConfig('cptservice.discoverFolderSuffix', 'Hooks');
        $defaultPaths = $this->deductDefaultDiscoveryPaths($discoveryPathsRoots, $discoverFolderSuffix);
        $discoveryPaths = array_merge($defaultPaths, $discoveryPaths);

        return parent::autoload($classNameFromFiles, $discoveryPaths, $successCallback);
    }
}

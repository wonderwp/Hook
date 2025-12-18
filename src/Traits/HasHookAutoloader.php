<?php

namespace WonderWp\Component\Hook\Traits;

trait HasHookAutoloader
{
    /**
     * Customize discovery paths for hooks.
     *
     * @param array $discoveryPaths
     * @return array
     */
    protected function resolveDiscoveryPaths(array $discoveryPaths): array
    {
        $discoveryPathsRoots = $this->manager->getConfig('discoveryPathsRoots', [
            'hooks' => rtrim($this->manager->getConfig('path.root') ?? '', DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR,
        ]);

        $discoverFolderSuffix = $this->manager->getConfig('cptservice.discoverFolderSuffix', 'Hooks');
        $defaultPaths         = $this->deductDefaultDiscoveryPaths($discoveryPathsRoots, $discoverFolderSuffix);

        return array_merge($defaultPaths, $discoveryPaths);
    }
}

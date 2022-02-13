<?php

declare (strict_types=1);
namespace RectorPrefix20220209;

return static function (\Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator $containerConfigurator) : void {
    $containerConfigurator->import(__DIR__ . '/../config.php');
    $services = $containerConfigurator->services();
    $services->set(\Rector\Composer\Rector\ChangePackageVersionComposerRector::class)->configure($composerExtensions);
};
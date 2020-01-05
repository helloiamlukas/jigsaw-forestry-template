<?php namespace App\Listeners;

use Illuminate\Support\Arr;
use Symfony\Component\Yaml\Yaml;
use TightenCo\Jigsaw\Jigsaw;

class InjectConfiguration
{
    public function handle(Jigsaw $jigsaw)
    {
        $configFilepath = $jigsaw->getSourcePath() . '/config.yml';
        $config = collect(Yaml::parseFile($configFilepath));
        $jigsaw->setConfig('config', $config);
    }
}
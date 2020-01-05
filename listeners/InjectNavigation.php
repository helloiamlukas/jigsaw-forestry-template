<?php namespace App\Listeners;

use Illuminate\Support\Arr;
use Symfony\Component\Yaml\Yaml;
use TightenCo\Jigsaw\Jigsaw;

class InjectNavigation
{
    public function handle(Jigsaw $jigsaw)
    {
        $navigationFilepath = $jigsaw->getSourcePath() . '/navigation.yml';
        $navigation = collect(Yaml::parseFile($navigationFilepath));
        $jigsaw->setConfig('menu', $navigation->map(function ($item) {
            if (Arr::has($item, 'page')) {
                $item['page'] = '/' . pathinfo($item['page'])['filename'];
            }
            return $item;
        }));
    }
}
<?php

namespace Oodle\KrumoBundle\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    public function setKrumoConfig($config)
    {
        require_once(__DIR__ . '/../../../../../krumo/class.krumo.php');
        \krumo::setConfig($config);
    }

    public function getName()
    {
        return 'oodle_krumo_twig_extension';
    }

    public function krumo($obj, $cascade = [])
    {
        ob_start();
        require_once(__DIR__ . '/../../../../../krumo/class.krumo.php');
        if ($cascade) {
            \krumo::cascade($cascade);
        }

        krumo($obj);
        if ($cascade) {
            \krumo::cascade(null);
        }

        return ob_get_clean();
    }


    public function getFilters()
    {
        return [
            new TwigFilter('krumo', [$this, 'krumo'], ['is_safe' => ['html']])
        ];
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('krumo', [$this, 'krumo'], ['is_safe' => ['html']])
        ];
    }
}
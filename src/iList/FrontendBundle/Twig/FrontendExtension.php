<?php

namespace iList\FrontendBundle\Twig;

class FrontendExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('price', array($this, 'priceFilter')),
        );
    }

    public function priceFilter($number, $decimals = 2, $decPoint = ',', $thousandsSep = '.')
    {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = 'R$ '.$price;

        return $price;
    }

    public function getName()
    {
        return 'frontend_extension';
    }
}
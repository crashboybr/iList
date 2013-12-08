<?php
namespace iList\BackendBundle\Helper;

// Correct use statements here ...

class SlugHelper {

    public function modifySlug($text) {
        $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿ??';
		$b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';

		$string = utf8_decode($text);
		$string = strtr($string, utf8_decode($a), $b);
		// $string = str_replace('', $type,$string);
		$text = strtolower($string);


		// replace non letter or digits by -
		$text = preg_replace('~[^\\pL\d]+~u', '-', $text);

		// trim
		$text = trim($text, '-');

		// transliterate
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		// lowercase
		$text = strtolower($text);

		// remove unwanted characters
		$text = preg_replace('~[^-\w]+~', '', $text);

		if (empty($text))
		{
			return 'n-a';
		}
		return $text;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 10/12/18
 * Time: 11:22
 */

namespace App\Service;


class Slugify
{
   public function generate(string $input) : string
   {

       $input = iconv('UTF-8', 'US-ASCII//TRANSLIT', $input);
       $unwantedChars = array(',', '!', '?', '\''); // create array with unwanted chars
       $input = str_replace($unwantedChars, '', $input); // remove them
       $input = strtolower($input);
       $input = trim($input);
       $input = str_replace(" ", "-", $input);
       return $input;
     //  return $input = str_replace(' ',"-", $input);
   }
}
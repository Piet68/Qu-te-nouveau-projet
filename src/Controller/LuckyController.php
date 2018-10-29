<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 29/10/18
 * Time: 15:31
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class LuckyController extends AbstractController
{
    /**
     * @return Response
     * @throws \Exception
     * @Annotation\Route("/lucky/number")
     */

    public function number()

    {
        $number = random_int(0, 100);

        //return new Response(
           // '<html><body>Lucky number: '.$number.'</body></html>'
        return $this->render('lucky/number.html.twig',['number' => $number,

        ]);
    }

}
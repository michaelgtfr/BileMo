<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 06/04/2020
 * Time: 07:23
 */

namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomepageController
{
    /**
     * API home page
     *
     * @Route("/", name="app_homepage")
     *
     * @param Request $request
     * @param Environment $twig
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function homepage(Request $request, Environment $twig)
    {
        $render = $twig->render('homepage.html.twig', [
            'host' => $request->headers->get('host'),
        ]);

        return new Response($render);
    }
}
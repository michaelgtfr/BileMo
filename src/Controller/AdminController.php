<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 01/04/2020
 * Time: 18:58
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class AdminController extends AbstractController
{
    /**
     * @Route( "admin/{username}&{token}", name="app_admin")
     * @param $username
     * @param $token
     * @param Environment $twig
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function admin($username, $token, Environment $twig)
    {
        $render = $twig->render('security/admin.html.twig', [
        'username' => $username,
        'token' => $token ]);

        return new Response($render);
    }
}
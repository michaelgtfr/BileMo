<?php
/**
 * User: michaelgt
 * Date: 01/04/2020
 */

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class AdminController
{
    /**
     * client administration page, allows recovery of the token (page in html format).
     * the request can be made in json in POST format, link '/api/login'
     *
     * @Route( "admin/{username}&{token}", name="app_admin")
     * @param $username
     * @param $token
     * @param Environment $twig
     * @param Request $request
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function admin($username, $token, Environment $twig, Request $request)
    {
        $render = $twig->render('security/admin.html.twig', [
            'username' => $username,
            'token' => $token,
            'host' => $request->headers->get('host')
        ]);

        return new Response($render);
    }
}

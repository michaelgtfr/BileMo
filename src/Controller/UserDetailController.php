<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 03/04/2020
 * Time: 17:31
 */

namespace App\Controller;


use App\Entity\User;
use App\Exception\NoFoundAppException;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Security\Core\User\UserInterface;

class UserDetailController
{
    /**
     * @Rest\Get(
     *     path = "api/user/{id}",
     *     name = "app_user_detail",
     *     requirements = {"id"="\d+"}
     * )
     * @Rest\View(
     *     statusCode=200,
     *     serializerGroups={"detailUser"}
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Get the details an user.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=User::class, groups={"detailUser"}))
     *     )
     * )
     * @SWG\Tag(name="Users")
     * @SWG\Parameter(
     *  name="Authorization",
     *  in="header",
     *  required=true,
     *  default="BEARER TOKEN",
     *  type="string",
     *  description="Bearer token",
     * )
     * @Security(name="Bearer")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserInterface $client
     * @return object|null
     * @throws NoFoundAppException
     */
    public function userDetail(Request $request, EntityManagerInterface $em, UserInterface $client)
    {
        $user = $em->getRepository(User::class)
            ->detailUserOfClient($request->get('id'), $client->getId());

        if ($user == null) {
            $message = 'Desoler mais l\'utilisateur demandé n\'existe pas';
            throw new NoFoundAppException($message);
        }

        return $user;
    }
}
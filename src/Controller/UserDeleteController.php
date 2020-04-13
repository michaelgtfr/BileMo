<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 04/04/2020
 * Time: 15:22
 */

namespace App\Controller;

use App\Entity\User;
use App\Representation\MessageOfDeleteUser;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class UserDeleteController
{
    /**
     * allows client to delete one of it's user
     *
     * @Rest\Delete(
     *     path = "api/delete/{id}",
     *     name = "app_user_delete",
     *     requirements = {"id"="\d+"}
     * )
     *
     * @Rest\View(
     *     statusCode=202,
     *     serializerGroups={"deleteUser"}
     * )
     *
     * @SWG\Response(
     *     response=202,
     *     description="Delete a user.",
     * )
     *
     * @SWG\Tag(name="Users")
     * @SWG\Parameter(
     *  name="Authorization",
     *  in="header",
     *  required=true,
     *  default="BEARER TOKEN",
     *  type="string",
     *  description="Bearer token",
     * )
     *
     * @Security(name="Bearer")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param UserInterface $client
     * @return MessageOfDeleteUser
     */
    public function userDelete(Request $request, EntityManagerInterface $em, UserInterface $client)
    {
        $user = $em->getRepository(User::class)
            ->detailUserOfClient($request->get('id'), $client->getId());

        $em->remove($user);
        $em->flush();
        
        return new MessageOfDeleteUser($user);
    }

}

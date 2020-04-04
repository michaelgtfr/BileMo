<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 03/04/2020
 * Time: 19:08
 */

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Swagger\Annotations as SWG;

class CreateUserController
{
    /**
     * @Rest\Post(
     *    path = "api/user",
     *    name = "app_user_create"
     * )
     *
     * @Rest\View(StatusCode = 201,
     *     serializerGroups={"detailUser"}
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Create a new user by the client.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=User::class, groups={"detailUser"}))
     *     )
     * )
     *
     * @RequestParam(
     *     name="name",
     *     requirements="[a-zA-Z0-9]",
     *     default=null,
     *     description="name of user"
     * )
     *
     * @RequestParam(
     *     name="firstname",
     *     requirements="[a-zA-Z0-9]",
     *     default=null,
     *     description="firstname of user"
     * )
     *
     * @RequestParam(
     *     name="country",
     *     requirements="[a-zA-Z0-9]",
     *     default=null,
     *     description="country of user"
     * )
     *
     * @RequestParam(
     *     name="address",
     *     requirements="[a-zA-Z0-9]",
     *     default=null,
     *     description="Search query to look for articles"
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
     * @ParamConverter("user", converter="fos_rest.request_body")
     * @param User $user
     * @param EntityManagerInterface $em
     * @param UserInterface $client
     * @param UrlGeneratorInterface $generatorURL
     * @return View
     */
    public function createUser(User $user, EntityManagerInterface $em, UserInterface $client,
                               UrlGeneratorInterface $generatorURL)
    {
        $user->setClient($client);
        $em->persist($user);
        $em->flush();

        return View::create(
            $user,
            Response::HTTP_CREATED, [
                'Location' => $generatorURL->generate('app_user_detail', [
                    'id' => $user->getId(), $generatorURL::ABSOLUTE_URL]
                )]
        );
    }
}
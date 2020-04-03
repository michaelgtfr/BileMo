<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 03/04/2020
 * Time: 11:00
 */

namespace App\Controller;

use App\Entity\User;
use App\Exception\NoFoundAppException;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Security\Core\User\UserInterface;

class UsersListController
{

    /**
     * @Rest\Get(
     *     path = "/api/users",
     *     name = "app_users_list",
     *)
     * @View(
     *     statusCode=200,
     *     serializerGroups={"listUsers"}
     * )
     * @SWG\Response(
     *     response=200,
     *     description="Get list my users.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=User::class, groups={"listUsers"}))
     *     )
     * )
     * @Rest\QueryParam(
     *     name="keyword",
     *     requirements="[a-zA-Z0-9]",
     *     nullable=true,
     *     description="The keyword to search for."
     * )
     * @Rest\QueryParam(
     *     name="order",
     *     requirements="asc|desc",
     *     default="asc",
     *     description="Sort order (asc or desc)"
     * )
     * @Rest\QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     default="15",
     *     description="Max number of movies per page."
     * )
     * @Rest\QueryParam(
     *     name="offset",
     *     requirements="\d+",
     *     default="0",
     *     description="The pagination offset"
     * )
     * @SWG\Tag(name="listUsers")
     * @SWG\Parameter(
     *  name="Authorization",
     *  in="header",
     *  required=true,
     *  default="BEARER TOKEN",
     *  type="string",
     *  description="Bearer token",
     * )
     * @Security(name="Bearer")
     * @param ParamFetcherInterface $paramFetcher
     * @param EntityManagerInterface $em
     * @param UserInterface $client
     * @return \App\Representation\Users
     * @throws NoFoundAppException
     */
    public function usersList(ParamFetcherInterface $paramFetcher, EntityManagerInterface $em, UserInterface $client)
    {
        $pager = $em->getRepository(User::class)->searchListByClient(
            $paramFetcher->get('keyword'),
            $paramFetcher->get('order'),
            $paramFetcher->get('limit'),
            $paramFetcher->get('offset'),
            $client->getId()
        );

        if($pager == null)
        {
            $message = 'desoler mais il n\'y a pas d\'article';

            throw new NoFoundAppException($message);
        }

        return new \App\Representation\Users($pager);
    }
}
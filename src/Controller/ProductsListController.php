<?php
/**
 * Created by PhpStorm.
 * User: mickd
 * Date: 04/03/2020
 * Time: 20:29
 */

namespace App\Controller;


use App\Entity\Products;
use App\Exception\NoFoundAppException;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\Annotations as Rest;

class ProductsListController
{
    /**
     * @Rest\Get(
     *     path = "/api/products",
     *     name = "app_products_list",
     *)
     * @View(
     *     statusCode=200,
     *     serializerGroups={"list"}
     * )
     *
     * @SWG\Response(
     *     response=200,
     *     description="Get list of Products.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Products::class, groups={"list"}))
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
     * @SWG\Tag(name="Products")
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
     * @return \App\Representation\Products
     * @throws NoFoundAppException
     */

    public function productsList(ParamFetcherInterface $paramFetcher, EntityManagerInterface $em)
    {
        $pager = $em->getRepository(Products::class)->search(
                $paramFetcher->get('keyword'),
                $paramFetcher->get('order'),
                $paramFetcher->get('limit'),
                $paramFetcher->get('offset')
            );

        if($pager == null)
        {
            $message = 'desoler mais il n\'y a pas d\'article';

            throw new NoFoundAppException($message);
        }

        return new \App\Representation\Products($pager);
    }
}
<?php

namespace App\Controller;

use App\Entity\ClientUser;
use App\Entity\Product;
use App\Repository\ProductRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Response;

class ApiProductController extends AbstractFOSRestController
{

    /**
     * @var ProductRepository $repository
     */
    private $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Rest\Get(
     *  "/client/{ref}",
     *  name="client_show",
     *  requirements={"ref"="^([\w]+)_([\w]+)-([\d]+)$"}
     * )
     * @View(serializerGroups={"client:read"})
     */
    public function show(ClientUser $product)
    {
        return $this->view($product, Response::HTTP_OK);
    }

    /**
     * @Rest\Get(
     *  "/product/{ref}",
     *  name="product_post",
     *  requirements={"ref"="^([\w]+)_([\w]+)-([\d]+)$"}
     * )
     * @View(serializerGroups={"product:read"})
     */
    public function post(Product $product)
    {
        return $this->view($product, Response::HTTP_OK);
    }

    /**
     * @Rest\Get(
     *  "/product",
     *  name="product_list",
     * )
     * @View(serializerGroups={"product:list"})
     */
    public function all()
    {
        return $this->view($this->repository->findAll(), Response::HTTP_OK);
    }

}

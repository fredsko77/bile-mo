<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Request;
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
     *  "/api/product/{ref}",
     *  name="api_product_show",
     *  requirements={"ref"="^([\w]+)_([\w]+)-([\d]+)$"}
     * )
     * @View(serializerGroups={"product:read"})
     */
    public function show(Product $product)
    {
        return $this->view($product, Response::HTTP_OK);
    }

    /**
     * @Rest\Get(
     *  "/api/product",
     *  name="api_product_list",
     * )
     * @View(serializerGroups={"product:list"})
     */
    public function all()
    {
        return $this->view($this->repository->findAllAvailable(), Response::HTTP_OK);
    }

    /**
     * @Rest\Get(
     *  "/api/product",
     *  name="api_product_paginate",
     * )
     * @View(serializerGroups={"product:list"})
     */
    public function paginate(Request $request)
    {
        $page = $request->query->get('page') ?? 0;
        $items_per_page = $request->query->get('items_per_page') ?? 40;

        return $this->view(
            $this->repository->paginate((int) $page, (int) $items_per_page),
            Response::HTTP_OK
        );
    }

    /**
     * @Rest\Get(
     *  "/api/product",
     *  name="api_product_paginate",
     * )
     * @View(serializerGroups={"product:list"})
     */
    public function search(Request $request)
    {
        $fullname = $request->query->get('q') ?? '';

        return $this->view(
            $this->repository->findByFullname((string) $fullname),
            Response::HTTP_OK
        );
    }

}

<?php

namespace App\Controller;

use App\Entity\ClientUser;
use App\Entity\Product;
use App\Repository\ClientUserRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientUserController extends AbstractFOSRestController
{

    /**
     * @var ClientUserRepository $repository
     */
    private $repository;

    public function __construct(ClientUserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Rest\Get(
     * "/api/client_user/{ref}",
     *  name="api_product_show",
     *  requirements={"ref"="^([\w]+)_([\w]+)-([\d]+)$"}
     * )
     * @View(serializerGroups={"client:read"})
     */
    public function show(ClientUser $client)
    {
        // if() {

        // }
        return $this->view('Unauthorized', Response::HTTP_UNAUTHORIZED);
    }

    public function create(Request $request)
    {
        return $this->view([], Response::HTTP_OK);
    }

    /**
     * @Rest\Get(
     *  "/api/client_user",
     *  "api_client_user_list"
     * )
     * @View(serializerGroups={"client:list"})
     */
    function list() {
        return $this->view($this->getUser()->getClientUsers());
    }

}

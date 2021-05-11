<?php

namespace App\Controller;

use App\Repository\UserRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends AbstractFOSRestController
{

    /**
     * @var UserRepository $repository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Rest\Get(
     *  "/api/auth/profile",
     *  name="api_auth_profile",
     * )
     * @View(serializerGroups={"user:read"})
     */
    public function profile(Request $request)
    {
        return $this->view($this->getUser(), Response::HTTP_OK);
    }

}

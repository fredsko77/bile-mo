<?php

namespace App\Controller;

use App\Entity\ClientUser;
use App\Repository\ClientUserRepository;
use Doctrine\ORM\EntityManagerInterface;
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

    /**
     * @var EntityManagerInterface $manager
     */
    private $manager;

    public function __construct(ClientUserRepository $repository, EntityManagerInterface $manager)
    {
        $this->repository = $repository;
        $this->manager = $manager;
    }

    /**
     * @Rest\Get(
     *  "/api/client_user/{ref}",
     *  name="api_client_user_show",
     *  requirements={"ref"="^([\w]+)_([\w]+)-([\d]+)$"}
     * )
     * @View(serializerGroups={"client:read"})
     */
    public function show(ClientUser $client)
    {
        if ($client->getUser()->getId() === $this->getUser()->getId()) {

            return $this->view($client);
        }

        return $this->view('Unauthorized', Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @Rest\Post()
     * @View
     */
    public function create(Request $request)
    {
        // TO DO create a new User Client
        return $this->view([], Response::HTTP_OK);
    }

    /**
     * @Rest\Get(
     *  "/api/client_user",
     *  "api_client_user_list"
     * )
     * @View(serializerGroups={"client:list"})
     */
    public function listClient()
    {
        return $this->view($this->getUser()->getClientUsers());
    }

    /**
     * @Rest\Delete(
     *  "/api/client_user/{ref}",
     *  name="api_client_user_delete",
     *  requirements={"ref"="^([\w]+)_([\w]+)-([\d]+)$"}
     * )
     * @View(serializerGroups={"client:read"})
     */
    public function delete(ClientUser $client)
    {
        if ($client->getUser()->getId() === $this->getUser()->getId()) {

            $this->manager->remove($client);
            $this->manager->flush();

            return $this->view('Content Deleted', Response::HTTP_OK);
        }

        return $this->view('Unauthorized', Response::HTTP_UNAUTHORIZED);
    }

}

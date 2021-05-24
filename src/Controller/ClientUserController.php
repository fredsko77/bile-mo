<?php

namespace App\Controller;

use App\Entity\ClientUser;
use App\Repository\ClientUserRepository;
use App\Services\ClientUserServicesInterface;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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

    /**
     * @var ClientUserServicesInterface $service
     */
    private $service;

    public function __construct(ClientUserRepository $repository, EntityManagerInterface $manager, ClientUserServicesInterface $service, UrlGeneratorInterface $router)
    {
        $this->repository = $repository;
        $this->manager = $manager;
        $this->service = $service;
        $this->router = $router;
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
        $this->denyAccessUnlessGranted('client_user_show', $client);

        return $this->view($client);
    }

    /**
     * @Rest\Post(
     *  "/api/client_user",
     *  name="api_client_create"
     * )
     * @View
     */
    public function create(Request $request)
    {
        //  Accès gérer par défaut avec lexik-jwt-bundle 
        $this->denyAccessUnlessGranted('client_user_create');

        $response = $this->service->store($request);
        return $this->view($response->data, $response->status);
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
     * @Rest\Put(
     *  "/api/client_user/{ref}",
     *  name="api_client_user_update",
     *  requirements={"ref"="^([\w]+)_([\w]+)-([\d]+)$"}
     * )
     * @View
     */
    public function update(ClientUser $client, Request $request)
    {
        $this->denyAccessUnlessGranted('client_user_update', $client);

        $response = $this->service->update($client, $request);
        return $this->view($response->data, $response->status);

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
        $this->denyAccessUnlessGranted('client_user_delete', $client);

        $this->manager->remove($client);
        $this->manager->flush();

        return $this->view('Client User Deleted', Response::HTTP_OK);
    }

}

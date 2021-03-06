<?php
namespace App\Services;

use App\Entity\ClientUser;
use App\Services\ClientUserServicesInterface;
use App\Traits\ServicesTrait;
use Doctrine\ORM\EntityManagerInterface;
use stdClass;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class ClientUserServices implements ClientUserServicesInterface
{

    use ServicesTrait;

    /**
     * @var Security $security
     */
    private $security;

    /**
     * @var ValidatorInterface $validator
     */
    private $validator;

    /**
     * @var UrlGeneratorInterface $router
     */
    private $router;

    /**
     * @var EntityManagerInterface $manager
     */
    private $manager;

    /**
     * @var SerializerInterface $serializer
     */
    private $serializer;

    /**
     * @param SerializerInterface $serializer
     * @param EntityManagerInterface $manager
     * @param ValidatorInterface $validator
     * @param UrlGeneratorInterface $router
     * @param Security $security
     */
    public function __construct(
        Security $security,
        SerializerInterface $serializer,
        EntityManagerInterface $manager,
        ValidatorInterface $validator,
        UrlGeneratorInterface $router
    ) {
        $this->security = $security;
        $this->serializer = $serializer;
        $this->manager = $manager;
        $this->validator = $validator;
        $this->router = $router;
    }

    /**
     * @param Request $request
     *
     * @return object $response
     */
    public function store(Request $request): object
    {
        $data = $request->getContent();
        $client = $this->serializer->deserialize($data, ClientUser::class, 'json');
        $user = $this->security->getUser();

        $response = new stdClass;
        $response->status = Response::HTTP_BAD_REQUEST;

        $errors = $this->validator->validate($client);

        if ($this->sendErrors($errors, $response)) {
            return $this->sendErrors($errors, $response);
        }

        $client->setCreatedAt($this->now())
            ->setRef($this->generateIdentifier("CLT"))
            ->setUser($user)
            ->setCompany($user->getCompany())
        ;

        $this->manager->persist($client);
        $this->manager->flush();

        $response->data = [
            'data' => $client,
            'link' => $this->router->generate('api_client_user_show', [
                'ref' => $client->getRef(),
            ]),
        ];
        $response->status = Response::HTTP_CREATED;

        return $response;
    }

    public function update(ClientUser $client, Request $request): object
    {
        $data = (array) json_decode($request->getContent(), true);

        $client->setEmail($data['email'])
            ->setFirstname($data['firstname'])
            ->setLastname($data['lastname'])
        ;

        $response = new stdClass;
        $response->status = Response::HTTP_BAD_REQUEST;

        $errors = $this->validator->validate($client);

        if ($this->sendErrors($errors, $response)) {
            return $this->sendErrors($errors, $response);
        }

        $client->setUpdatedAt($this->now());

        $this->manager->persist($client);
        $this->manager->flush();

        $response->data = $client;
        $response->status = Response::HTTP_OK;

        return $response;
    }

}

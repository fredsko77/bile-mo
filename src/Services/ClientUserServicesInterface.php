<?php
namespace App\Services;

use App\Entity\ClientUser;
use Symfony\Component\HttpFoundation\Request;

interface ClientUserServicesInterface
{

    /**
     * @param Request $request
     *
     * @return object $response
     */
    public function store(Request $request): object;

    /**
     * @param ClientUser $client
     * @param Request $request
     *
     * @return object $response
     */
    public function update(ClientUser $client, Request $request): object;

}

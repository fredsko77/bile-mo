<?php
namespace App\Services;

use Symfony\Component\HttpFoundation\Request;

interface ClientUserServicesInterface
{

    public function store(Request $request): object;

}

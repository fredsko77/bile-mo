<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocumentationController extends AbstractController
{

    /**
     * @Route("/documentation",name="api_documentation", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('documentation/index.html.twig');
    }

}

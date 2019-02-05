<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SuccessController extends AbstractController 
{
    /**
     * @Route("/success",
     *      name="success",
     *      methods="GET"
     * )
     */
    public function success() {
        return $this->render("success.html.twig");
    }
}
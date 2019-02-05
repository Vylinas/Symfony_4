<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin", name="admin")
 */
class AdminInterfaceController extends AbstractController
{
    /**
     * @Route("/",
     *      name    = "admin",
     *      methods = {"GET"}
     * )
     */
    public function adminInterface() 
    {
        return $this->render('admin/index.html.twig');
    }
}
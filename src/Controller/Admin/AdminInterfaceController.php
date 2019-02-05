<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
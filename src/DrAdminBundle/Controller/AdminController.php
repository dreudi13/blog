<?php

namespace DrAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function homeAction()
    {
        return $this->render('DrAdminBundle:Admin:home.html.twig');
    }
}

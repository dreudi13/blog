<?php

namespace DrAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('DrAdminBundle:Default:index.html.twig');
    }
}

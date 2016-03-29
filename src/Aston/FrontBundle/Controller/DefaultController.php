<?php

namespace Aston\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AstonFrontBundle:Default:index.html.twig');
    }

    public function contactAction(Request $req)
    {
        $fb = $this->createFormBuilder();
        return $this->render('AstonFrontBundle:Default:contact.html.twig');
    }
}

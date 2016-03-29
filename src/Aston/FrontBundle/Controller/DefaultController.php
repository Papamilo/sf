<?php

namespace Aston\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AstonFrontBundle:Default:index.html.twig');
    }

    public function contactAction(Request $req)
    {
        $fb = $this->createFormBuilder(new \Aston\FrontBundle\Entity\Contact);
        $fb->add('name', TextType::class, ['required' => true])
           ->add('email', EmailType::class)
           ->add('phone', TextType::class)
           ->add('message', TextareaType::class)
           ->add('submit', SubmitType::class, ['label' => 'Envoyer']);

        $form = $fb->getForm();
        $form->handleRequest($req);

        // Validation du formulaire.
        if ($form->isSubmitted() && $form->isValid()) {
            // ici on enregistre en base de données
            $m = $this->getDoctrine()->getManager();
            $m->persist($form->getData());
            $m->flush();

            return $this->redirect($this->generateUrl('aston_front_homepage'));
        }

        // Passage du formulaire à la vue.
        return $this->render('AstonFrontBundle:Default:contact.html.twig', array(
            'formContact' => $form->createView()
        ));
    }
}

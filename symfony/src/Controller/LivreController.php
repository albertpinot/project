<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Livre;
use App\Form\LivreFormType;

class LivreController extends AbstractController
{
    /**
     * @Route("/livre", name="livre")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $livre = new Livre();
        $form = $this->createForm(LivreFormType::class, $livre);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($livre);
            $em->flush();
        }

        return $this->render('livre/livreForm.html.twig', [
            'livreForm' => $form->createView(),
        ]);
    }
}

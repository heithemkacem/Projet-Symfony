<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Plat;
use App\Form\PlatType;

class PlatController extends AbstractController
{
    /**
     * @Route("/plat/add", name="plat_add")
     */
    public function add(Request $request): Response
    {
        $plat = new Plat();
        $form = $this->createForm(PlatType::class, $plat);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($plat);
            $entityManager->flush();

            return $this->redirectToRoute('plat_show', ['id' => $plat->getId()]);
        }

        return $this->render('./add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/plat/{id}", name="plat_show")
     */
    public function show(Plat $plat): Response
    {
        return $this->render('./show.html.twig', [
            'plat' => $plat,
        ]);
    }
}

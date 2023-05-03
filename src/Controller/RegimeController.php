<?php

namespace App\Controller;

use App\Entity\Regime;
use App\Form\RegimeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegimeController extends AbstractController
{
    /**
     * @Route("/regime", name="regime_index", methods={"GET"})
     */
    public function index(): Response
    {
        $regimes = $this->getDoctrine()
            ->getRepository(Regime::class)
            ->findAll();

        return $this->render('./index.html.twig', [
            'regimes' => $regimes,
        ]);
    }

    /**
     * @Route("/regime/new", name="regime_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $regime = new Regime();
        $form = $this->createForm(RegimeType::class, $regime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($regime);
            $entityManager->flush();

            return $this->redirectToRoute('regime_index');
        }

        return $this->render('./new.html.twig', [
            'regime' => $regime,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/regime/{id}", name="regime_show", methods={"GET"})
     */
    public function show(Regime $regime): Response
    {
        return $this->render('./showRegime.html.twig', [
            'regime' => $regime,
        ]);
    }

    /**
     * @Route("/regime/{id}/edit", name="regime_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Regime $regime): Response
    {
        $form = $this->createForm(RegimeType::class, $regime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('regime_index');
        }

        return $this->render('./edit.html.twig', [
            'regime' => $regime,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/regime/{id}", name="regime_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Regime $regime): Response
    {
        if ($this->isCsrfTokenValid('delete'.$regime->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($regime);
            $entityManager->flush();
        }

        return $this->redirectToRoute('regime_index');
    }
}

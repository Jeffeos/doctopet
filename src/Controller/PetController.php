<?php

namespace App\Controller;

use App\Entity\Pet;
use App\Form\PetType;
use App\Repository\PetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pet")
 */
class PetController extends AbstractController
{
    /**
     * @Route("/{id}", name="pet_index", methods={"GET"})
     */
    public function index(Pet $pet, PetRepository $petRepository): Response
    {
        return $this->render('pet/index.html.twig', [
            'pet' => $pet,
        ]);
    }

    /**
     * @Route("/new", name="pet_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pet = new Pet();
        $form = $this->createForm(PetType::class, $pet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pet);
            $entityManager->flush();

            return $this->redirectToRoute('pet_index');
        }

        return $this->render('pet/new.html.twig', [
            'pet' => $pet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pet_show", methods={"GET"})
     */
    public function show(Pet $pet): Response
    {
        return $this->render('pet/show.html.twig', [
            'pet' => $pet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pet $pet): Response
    {
        $form = $this->createForm(PetType::class, $pet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pet_index');
        }

        return $this->render('pet/edit.html.twig', [
            'pet' => $pet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pet_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pet $pet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pet_index');
    }

    /**
     * @Route("/{id}/addPill", name="pet_addPills", methods={"GET"})
     */
    public function addPill(Pet $pet): Response
    {
        $pet->setHasPills(true);
        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('pet_index', ['id' => 1] );
    }

    /**
     * @Route("/{id}/takePill", name="pet_takePills", methods={"GET"})
     */
    public function takePill(Pet $pet): Response
    {
        $pet->setHasPills(false);
        $pet->setHealth($pet->getHealth()+20);
        $pet->setHasBamboo($pet->getHasBamboo()+5);

        $this->getDoctrine()->getManager()->flush();

        return $this->redirectToRoute('pet_index', ['id' => 1] );
    }

    /**
     * @Route("/{id}/feed", name="pet_feed", methods={"GET","POST"})
     */
    public function feed(Pet $pet, Request $request): Response
    {
        $pet->setHasBamboo($pet->getHasBamboo()-1);
        if ($pet->getHappiness() < 90) {
            $pet->setHappiness($pet->getHappiness() + 10);
        }
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse([
            'bamboo' => $pet->getHasBamboo(),
            'happiness' => (int) $pet->getHappiness(),
        ]);

    }
}

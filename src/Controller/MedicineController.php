<?php

namespace App\Controller;

use App\Entity\Medicine;
use App\Entity\User;
use App\Form\MedicineType;
use App\Repository\MedicineRepository;
use App\Repository\UserRepository;
use App\service\NotificationManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/medicine")
 */
class MedicineController extends AbstractController
{
    /**
     * @Route("/", name="medicine_index", methods={"GET","POST"})
     */
    public function index(MedicineRepository $medicineRepository, UserRepository $userRepository, Request $request): Response
    {
        $user = $userRepository->findOneBy([]);
        $medicine = new Medicine();
        $form = $this->createForm(MedicineType::class, $medicine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $medicine->setUser($user);
            $entityManager->persist($medicine);
            $entityManager->flush();

            return $this->redirectToRoute('medicine_index');
        }

        return $this->render('medicine/index.html.twig', [
            'medicines' => $medicineRepository->findAll(),
            'medicine' => $medicine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="medicine_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $medicine = new Medicine();
        $form = $this->createForm(MedicineType::class, $medicine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($medicine);
            $entityManager->flush();

            return $this->redirectToRoute('medicine_index');
        }

        return $this->render('medicine/new.html.twig', [
            'medicine' => $medicine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/send", name="medicine_send")
     * @param NotificationManager $notificationManager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function send(MedicineRepository $medicineRepository, NotificationManager $notificationManager)
    {
        $medicineRepository->findOneBy([]);

        $response = $notificationManager->sendMessage();
        $return["allresponses"] = $response;
        $return = json_encode($return);

        print("\n\nJSON received:\n");
        print($return);
        print("\n");

        return $this->redirectToRoute('medicine_index');
    }

    /**
     * @Route("/{id}", name="medicine_show", methods={"GET"})
     */
    public function show(Medicine $medicine): Response
    {
        return $this->render('medicine/show.html.twig', [
            'medicine' => $medicine,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="medicine_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Medicine $medicine): Response
    {
        $form = $this->createForm(MedicineType::class, $medicine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('medicine_index');
        }

        return $this->render('medicine/edit.html.twig', [
            'medicine' => $medicine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="medicine_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Medicine $medicine): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medicine->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($medicine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('medicine_index');
    }

}

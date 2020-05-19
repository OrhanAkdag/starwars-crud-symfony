<?php

namespace App\Controller;

use App\Entity\Resident;
use App\Form\ResidentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ResidentController extends AbstractController
{
     // Equivalent du get all
    /**
     * @Route("/resident-list", name="resident-list")
     */
    public function index()
    {
        $residents = $this->getDoctrine()->getRepository(Resident::class)->findAll();


        return $this->render('resident/resident-list.html.twig',
            [
                'residents'=> $residents
            ]
        );
    }

    // Ajout d'un resident
    /**
     * @Route("/add-resident", name="add-resident")
     */
    public function addResident(Request $request)
    {
        $form = $this->createForm(ResidentType::class, new Resident());

        $form->handleRequest($request);

       if($form->isSubmitted() and $form->isValid()){
           $resident = $form->getData();
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($resident);
           $entityManager->flush();
           return $this->redirectToRoute('resident-list');
       } else {

           return $this->render('resident/add-resident.html.twig',
               [
                   'form'=> $form->createView()
               ]);
       }
    }

    // Equivalent get one
    /**
     * @Route("/detail-resident/{resident}", name="detail-resident")
     */
    public function detailResident(Resident $resident)
    {

        return $this->render('resident/detail-resident.html.twig', ['resident'=>$resident]);
    }

    // Equivalent du update
    /**
     * @Route("/edit-resident/{resident}", name="edit-resident")
     */
    public function updateResident(Resident $resident, Request $request)
    {

        $form = $this->createForm(ResidentType::class, $resident);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $resident = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('resident');
        } else {
            return $this->render('resident/edit-resident.html.twig',
                [
                    'form'=> $form->createView()
                ]);
        }

    }

    // Equivalent du delete
    /**
     * @Route("/delete-resident/{resident}", name="delete-resident")
     */
    public function deleteResident(Resident $resident)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($resident);
        $entityManager->flush();
        return $this->redirectToRoute('resident-list');
    }

}

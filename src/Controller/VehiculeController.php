<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\PlaneteType;
use App\Form\VehiculeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VehiculeController extends AbstractController
{
    // Equivalent du get all
    /**
     * @Route("/vehicule-list", name="vehicule-list")
     */
    public function index()
    {
        $vehicules = $this->getDoctrine()->getRepository(Vehicule::class)->findAll();


        return $this->render('vehicule/vehicule-list.html.twig',
            [
                'vehicules'=> $vehicules
            ]
        );
    }

    // Ajout d'un vehicule
    /**
     * @Route("/add-vehicule", name="add-vehicule")
     */
    public function addVehicule(Request $request)
    {
        $form = $this->createForm(VehiculeType::class, new Vehicule());

        $form->handleRequest($request);

       if($form->isSubmitted() and $form->isValid()){
           $vehicule = $form->getData();
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($vehicule);
           $entityManager->flush();
           return $this->redirectToRoute('vehicule-list');
       } else {

           return $this->render('vehicule/add-vehicule.html.twig',
               [
                   'form'=> $form->createView()
               ]);
       }
    }

    // Equivalent get one
    /**
     * @Route("/detail-vehicule/{vehicule}", name="detail-vehicule")
     */
    public function detailVehicule(Vehicule $vehicule)
    {

        return $this->render('vehicule/detail-vehicule.html.twig', ['vehicule'=>$vehicule]);
    }

    // Equivalent du update
    /**
     * @Route("/edit-vehicule/{vehicule}", name="edit-vehicule")
     */
    public function updateVehicule(Vehicule $vehicule, Request $request)
    {

        $form = $this->createForm(VehiculeType::class, $vehicule);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $vehicule = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('vehicule');
        } else {
            return $this->render('vehicule/edit-vehicule.html.twig',
                [
                    'form'=> $form->createView()
                ]);
        }

    }

    // Equivalent du delete
    /**
     * @Route("/delete-vehicule/{vehicule}", name="delete-vehicule")
     */
    public function deleteVehicule(Vehicule $vehicule)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($vehicule);
        $entityManager->flush();
        return $this->redirectToRoute('vehicule-list');
    }

}

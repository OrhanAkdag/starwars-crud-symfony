<?php

namespace App\Controller;

use App\Entity\Planete;
use App\Form\PlaneteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PlanetteController extends AbstractController
{
    // Equivalent du get all
    /**
     * @Route("/{_locale}", name="planette")
     */
    public function index()
    {
        $plannettes = $this->getDoctrine()->getRepository(Planete::class)->findAll();


        return $this->render('planette/index.html.twig',
            [
                'planettes'=> $plannettes
            ]
        );
    }

    // Ajout d'une planète
    /**
     * @Route("/{_locale}/add", name="add_planette")
     */
    public function addPlanette(Request $request)
    {
        $form = $this->createForm(PlaneteType::class, new Planete());

        $form->handleRequest($request);

       if($form->isSubmitted() and $form->isValid()){
           $planete = $form->getData();
           $entityManager = $this->getDoctrine()->getManager();
           $entityManager->persist($planete);
           $entityManager->flush();
           return $this->redirectToRoute('planette');
       } else {

           return $this->render('planette/add.html.twig',
               [
                   'form'=> $form->createView()
               ]);
       }
    }

    // Equivalent get one
    /**
     * @Route("/{_locale}/detail/{planette}", name="detail_planette")
     */
    public function detailPlanet(Planete $planette)
    {


        return $this->render('planette/detail.html.twig', ['planette'=>$planette]);
    }

    // Equivalent du update
    /**
     * @Route("/{_locale}/update/{planette}", name="update_planet")
     */
    public function updatePlanet(Planete $planette, Request $request)
    {

        $form = $this->createForm(PlaneteType::class, $planette);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $planette = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('planette');
        } else {
            return $this->render('planette/edit.html.twig',
                [
                    'form'=> $form->createView()
                ]);
        }


/*        $planette->setAllegiance('Une autre allegiance');
        $planette->setNom('Un autre nom');

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();*/


        return $this->render('planette/edit.html.twig', [
            'planette'=> $planette,
            'form'=> $form->createView()
        ]);
    }

    // Equivalent du delete
    /**
     * @Route("/{_locale}/delete/{planette}", name="delete_planet")
     */
    public function deletePlanet(Planete $planette)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($planette);
        $entityManager->flush();
        return $this->redirectToRoute('planette');
    }

    // Equivalent du get all
    /**
     * @Route("/{_locale}/planette-distance/{distance}", name="planette_distance")
     */
    public function getPlanetDistance($distance)
    {

        $plannettes = $this->getDoctrine()->getRepository(Planete::class)->findDistanceInferieur($distance);

        return $this->render('planette/index.html.twig',
            [
                'planettes'=> $plannettes
            ]
        );
    }

    /**
     * @Route("/{_locale}/search-string/{string}", name="planette_search_string")
     */
    public function searchByString($string){
        $plannettes = $this->getDoctrine()->getRepository(Planete::class)->findSearchSting($string);

        return $this->render('planette/index.html.twig',
            [
                'planettes'=> $plannettes
            ]
        );
    }


}

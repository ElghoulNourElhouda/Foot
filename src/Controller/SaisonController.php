<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Saison;
use App\Form\SaisonType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;

class SaisonController extends AbstractController
{
    private $security;
    public function __construct(Security $security)
   {
       $this->security = $security;
   }


   //Pour ajouter saison
    /**
     * @Route("/saison/ajoutersaison", name="ajoutersaison")
     * @Method({"POST"})
     */
    public function ajoutersaison(Request $request, ManagerRegistry $doctrine):Response
    {
        
        $saison= new Saison();
        $forms =$this->createForm(SaisonType::class, $saison);
        $forms->handleRequest($request);
        $user = $this->getUser();
              if ($forms->isSubmitted() && $forms->isValid()) 
              {   
                  $Equipe =$forms->getData();
                   // cette méthode renvoie le gestionnaire d'entité par défaut
                  $entityManger = $doctrine->getManager();
                   // insertion des données dans un BD
                  $entityManger->persist($saison);
                   // Actualiser le BD
                  $entityManger->flush();
                  return $this->redirectToRoute('showsaison');
              }
              return $this->render('saison/ajoutersaison.html.twig', [
                'forms' => $forms->createView()
        ]);
    }


    //Pour afficher la liste des saisons
    /**
     * @Route("/saison/showsaison", name="showsaison")
     * @Method({"GET"})
     */
    public function showsaison(ManagerRegistry $doctrine)
    {
        $user = $this->security->getUser();
         //Récupèrer un référentiel géré par le gestionnaire d'entité "Equipe"
        $saison = $doctrine->getRepository(Saison::class)->findAll();
         //rendre un modèle avec un paramètre
        return $this->render('saison/showsaison.html.twig', array ('saison' => $saison));

    }
}

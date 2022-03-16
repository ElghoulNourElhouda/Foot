<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Equipe;
use App\Form\EquipeType;
use App\Entity\Joueur;
use App\Entity\Saison;
use App\Entity\Users;
use App\Entity\Statistique;
use App\Form\EditequipeType;
use App\Form\SearchdateType;
use App\Form\SaisonType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;



class EquipeController extends AbstractController
{
    private $security;
    public function __construct(Security $security)
   {
       $this->security = $security;
   }

    //Pour Ajouter une équipe

    /**
     * @Route("/equipe/ajouterequipe", name="ajouterequipe")
     * @Method({"POST"})
     */
    public function ajouterequipe(Request $request, ManagerRegistry $doctrine):Response
    {
        //initialisation
        $Equipe= new Equipe();

        $forms =$this->createForm(EquipeType::class, $Equipe);
        $forms->handleRequest($request);
        $user = $this->getUser();
              if ($forms->isSubmitted() && $forms->isValid()) 
              {   
                  $Equipe =$forms->getData();
                  // cette méthode renvoie le gestionnaire d'entité par défaut
                  $entityManger = $doctrine->getManager();
                  // insertion des données dans un BD
                  $entityManger->persist($Equipe);
                  // Actualiser le BD
                  $entityManger->flush();
                 //redirige vers la route "show_Equipe"
                  return $this->redirectToRoute('show_Equipe');
              }
              //rendre un modèle
              return $this->render('equipe/ajouterequipe.html.twig', [
                'forms' => $forms->createView()
        ]);
    }
    
      //Pour afficher la liste des équipes

    /**
     * @Route("/equipe/showEquipe", name="show_Equipe")
     * @Method({"GET"})
     */
    public function showEquipe(ManagerRegistry $doctrine)
    {
        $user = $this->security->getUser();
        //Récupèrer un référentiel géré par le gestionnaire d'entité "Equipe"
        $Equipe = $doctrine->getRepository(Equipe::class)->findAll();
        //rendre un modèle avec un paramètre
        return $this->render('equipe/showEquipe.html.twig', array ('cols' => $Equipe));

    }

    //Pour afficher la liste des joueurs d'une équipe pour une saison donnée
    /**
     * @Route("/equipe/showstatequipe/{id}", name="showstatequipe")
     * @Method({"POST"})
     */
    public function showstatequipe(Request $request, $id , ManagerRegistry $doctrine):Response
    {
        //Récupèrer un référentiel géré par le gestionnaire d'entité "Saison"
        $saisons=$doctrine->getRepository(Saison::class)->findALL();
        $saison=$request->request->get('saisonselect')??'2021/2022';
        //trouver une équipe par id
        $equipe = $doctrine->getRepository(Equipe::class)->find($id);
        //trouver une saison par date
        $objsaison=$doctrine->getRepository(Saison::class)->findOneby(['date'=>$saison]);
        //trouver le statistique par id equipe et date de saison
        $statjoueurs=$doctrine->getRepository(Statistique::class)->findby(['saison'=>$objsaison ,'equipe'=>$equipe]);
          //rendre un modèle avec plusieurs paramètres
              return $this->render('equipe/showstatequipe.html.twig', [ 
                'statjoueurs'=> $statjoueurs,
                'id'=>$id,
                'equipe'=>$equipe,
               'saisons'=>$saisons,
               'saison'=> $saison
        ]);
    }


}

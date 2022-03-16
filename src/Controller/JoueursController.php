<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Equipe;
use App\Entity\Joueur;
use App\Entity\Users;
use App\Entity\Saison;
use App\Entity\Statistique;
use App\Form\JoueurType;
use App\Form\StatType;
use App\Form\EditjoueurType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
 

class JoueursController extends AbstractController
{
    private $security;
    public function __construct(Security $security)
   {
       $this->security = $security;
   }

    
    //Pour ajouter un nouveau joueur
    
     /**
     * @Route("/joueurs/ajouterjoueurs", name="ajouterjoueurs")
     * @Method({"POST"})
     */
    public function ajouterjoueurs(Request $request, ManagerRegistry $doctrine):Response
    {
        //initialisation
        $joueurs= new Joueur();
        $user=new Users();
        $forms =$this->createForm(JoueurType::class, $joueurs);
        $forms->handleRequest($request);
        $user = $this->getUser();
              if ($forms->isSubmitted() && $forms->isValid()) 
              {   
                  //contient les valeurs soumises
                  $Equipe =$forms->getData();
                   // cette méthode renvoie le gestionnaire d'entités par défaut
                  $entityManger = $doctrine->getManager();
                   // insertion des données dans un BD
                  $entityManger->persist($joueurs);
                   // Actualiser le BD
                  $entityManger->flush();
                   //redirige vers la route "show_joueurs"
                  return $this->redirectToRoute('show_joueurs');
              }
              // renders templates joueurs/ajouterjoueur.html.twig
              return $this->render('joueurs/ajouterjoueur.html.twig', [
                'forms' => $forms->createView()
        ]);
    }
    
  //pour afficher la liste des joueurs
    /**
     * @Route("/joueurs/showjoueurs", name="show_joueurs")
     * @Method({"GET"})
     */
    public function showjoueurs(ManagerRegistry $doctrine)
    {
        $user = $this->security->getUser();
         //Récupèrer un référentiel géré par le gestionnaire d'entité "Joueur"
        $joueur = $doctrine->getRepository(Joueur::class)->findAll();
        return $this->render('joueurs/showjoueurs.html.twig', array ('joueur' => $joueur));

    }
   
    //pour ajouter une statistique à un joueur  
    
     /**
     * @Route("/joueurs/statiquejoueur/{id}", name="statiquejoueur")
     * @Method({"POST"})
     */
    public function statiquejoueur(Request $request, $id , ManagerRegistry $doctrine):Response
    {
        
        
        $saissn= new statistique();
        $user=new Users();
        //trouver un joueur par son id 
        $joueur = $doctrine->getRepository(Joueur::class)->find($id);
       //creation de formulaire
        $forms =$this->createForm(StatType::class, $saissn);
        $forms->handleRequest($request);
        $user = $this->getUser();
              if ($forms->isSubmitted() && $forms->isValid()) 
              {   
                  $saissn =$forms->getData();
                  // get session
                  $s=$saissn->getSaison();
                  //trouver le statistique par id joueur et saison
                  $exist=$doctrine->getRepository(Statistique::class)->findby(['joueur'=>$joueur,'saison'=>$s]);

                  if(count($exist)<1){
                $saissn->setJoueur($joueur);
                  $entityManger = $doctrine->getManager();
                  // insertion des données dans un BD
                  $entityManger->persist($saissn);
                 // Actualiser le BD
                  $entityManger->flush();
                //redirige vers la route "show_joueurs"
                  return $this->redirectToRoute('show_joueurs');
                }else{
                    $this->addFlash(
                        'error',
                        'Statistique déjà existe!'
                    );
                }

              }
               //rendre un page twig  
              return $this->render('joueurs/statiquejoueur.html.twig', [
                'forms' => $forms->createView(),
                'joueur'=>$joueur,
                
        ]);
    }
   
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Users;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Form\EditusersType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;


class SecurityController extends AbstractController
{private $security;
    public function __construct(Security $security)
   {
       $this->security = $security;
   }
    
    

    /**
     * @Route("/",name="page_acceuil")
     * @Method({"GET"})
     */
  
    public function index(): Response
    {
         //redirige vers la route "app_login"
        return $this->redirectToRoute('app_login');
    }
     
    /**
     * @Route("/Dash_admin",name="Dash_admin")
     * @Method({"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function Dash_admin(Request $request): Response
    {
       
             //redirige vers la route "Dash_admin"
        return $this->render('security/Dash_admin.html.twig');
    }
   
    
   
}

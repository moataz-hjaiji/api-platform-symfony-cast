<?php

namespace App\Controller;

use ApiPlatform\Api\IriConverterInterface;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login',methods: ['POST'])]
    public function index(IriConverterInterface $iriConverter,#[CurrentUser] User $user = null): Response
    {
        if(!$user){
            return $this->json([
               'error'=>"not found user with this credential"
            ],401);
        }

//        return $this->json([
//            'user'=> $user?$user:null,
//        ]);
        return new Response(null,204,[
            "location"=>$iriConverter->getIriFromResource($user)
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
    }
}

<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MainController extends AbstractController
{
    /**
     * @throws ExceptionInterface
     */
    #[Route('/')]
    public function homepage(NormalizerInterface $normalizable,#[CurrentUser] User $user = null): Response
    {
        return $this->render('main/homepage.html.twig',[
            "userData"=>$normalizable->normalize($user,"jsonld",[
                "groups"=>['user:read']
            ]),
        ]);
    }
}

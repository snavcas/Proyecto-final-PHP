<?php

namespace App\Controller;

use App\Entity\Wine;
use App\Form\WineType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class WinesController extends AbstractController
{

    #[Route("/wine/{id}",name: "showWine")]
    public function showWine(EntityManagerInterface $doctrine, $id)
    {
        $repositorio=$doctrine->getRepository(Wine::class);
        $wine=$repositorio->find($id);
        return $this->render("wines/showWines.html.twig", ["wine" => $wine]);
    }

    #[Route("/wines", name:"listWine")]
    public function listWines(EntityManagerInterface $doctrine)
    {
        $repositorio=$doctrine->getRepository(Wine::class);
        $wines=$repositorio->findAll();
        return $this->render("wines/listWines.html.twig", ["wines" => $wines]);
    }

    #[Route("/home", name:"home")]
    public function home()
    {
        return $this->render("wines/home.html.twig");
    }
    
    #[Route("/set/wine", name:"setWine")]
    public function setWine(Request $request, EntityManagerInterface $doctrine)
    {
        $form = $this-> createForm(WineType::class);
        $form->handleRequest($request);
        if ($form-> isSubmitted() && $form->isValid()){
            $wine = $form-> getData();
            $doctrine->persist($wine);
            $doctrine->flush();
            return $this->redirectToRoute("listWine");
        }
        return $this->renderForm("wines/setWine.html.twig", [
            "wineForm"=>$form
        ]);
    }

    #[Route("/edit/wine/{id}", name:"editWine")]
    public function editWine(Request $request, EntityManagerInterface $doctrine, $id)
    {
        $repositorio=$doctrine->getRepository(Wine::class);
        $wine=$repositorio->find($id);
        
        $form = $this-> createForm(WineType::class, $wine);
        $form->handleRequest($request);
        if ($form-> isSubmitted() && $form->isValid()){
            $wine = $form-> getData();
            $doctrine->persist($wine);
            $doctrine->flush();
            return $this->redirectToRoute("listWine");
        }
        return $this->renderForm("wines/setWine.html.twig", [
            "wineForm"=>$form
        ]);
    }
    #[Route("/delete/wine/{id}",name: "deleteWine")]
    public function deleteWine(EntityManagerInterface $doctrine, $id)
    {
        $repositorio=$doctrine->getRepository(Wine::class);
        $wine=$repositorio->find($id);
        $doctrine->remove($wine);
        $doctrine->flush();
        return $this->redirectToRoute("listWine");
    }
    
};

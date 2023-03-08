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
    /*#[Route("/new/wine")]
    public function newWine(EntityManagerInterface $doctrine)
    {
        $wine1= new Wine();
        $wine1 -> setNombre("do ferreiro");
        $wine1 -> setDO("Rias Bixas");
        $wine1 -> setFicha("Color amarillo verdoso. Aroma fresco, fruta madura , flor blanco, recuerdo a iodo. En boca la acidez está bien integrada, sedoso en su paso, salino. Final largo");
        $wine1 -> setMaridaje("Excelente para tomar durante el aperitivo, así como acompañamiento a platos principales de pescado y carnes blancas. SERVICIO: Se recomienda su servicio a bajas temperaturas alrededor de los 7ºC y 10ºC.");
        $wine1 -> setImagen("https://esenciadelmar.es/wp-content/uploads/2021/01/albarin%CC%83o-do-ferreiro.png");


        $wine2= new Wine();
        $wine2 -> setNombre("Pago de Carrovejas");
        $wine2 -> setDO("Ribera del Duero");
        $wine2-> setFicha("Rojo púrpura con ribetes del mismo color. Frutas maduras, lácteos, notas balsámicas y especiados dulces. En boca, equilibrado, franco y persistente");
        $wine2 -> setMaridaje("Con todo tipo de carnes rojas y asados. También es ideal para acompañar a quesos curados");
        $wine2 -> setImagen("https://static1.aporvino.com/14464-thickbox_default/pago-de-carraovejas-2020.jpg");

        $wine3= new Wine();
        $wine3 -> setNombre("La Planta");
        $wine3 -> setDO("Ribera del Duero");
        $wine3-> setFicha("Limpio, brillante, de alta intensidad y de color rojo cereza con ribete cardenalicio");
        $wine3 -> setMaridaje("CPescados fritos y en salsa, embutido, carnes blancas, aves asadas, arroces de mar y montaña, quesos
        suaves o poco curados. Temperatura óptima de consumo entre 14ºC y 16ºC.");
        $wine3 -> setImagen("https://arzuaganavarro.com/templates/yootheme/cache/plantaHOME-41acab8d.png");

        $wine4= new Wine();
        $wine4 -> setNombre("Hacienda López de Haro");
        $wine4 -> setDO("Rioja");
        $wine4-> setFicha("Suave y aterciopelado, con tanino dulce y maduro. Amable y fácil de beber. Largo postgusto.");
        $wine4 -> setMaridaje("Puede acompañar arroces de carne, embutidos, patés, huevos fritos con jamón, pasta con salsa de carne, quesos semicurados, carnes blancas con salsa.");
        $wine4 -> setImagen("https://www.haciendalopezdeharo.com/wp-content/uploads/2016/12/HLH-2019.png");

        $wine5= new Wine();
        $wine5 -> setNombre("Habla del Silencio");
        $wine5 -> setDO("Extremadura");
        $wine5-> setFicha("Es un vino goloso, fresco y carnoso a la vez, con abundantes notas frutales y bombón de licor de cerezas.");
        $wine5 -> setMaridaje("Guisos, carnes y embutidos.");
        $wine5 -> setImagen("https://cdn.vinissimus.com/img/unsafe/p385x/plain/local:///prfmtgrande/vi/hsiln21_anv800.png");

        $wine6= new Wine();
        $wine6 -> setNombre("El Pícaro");
        $wine6 -> setDO("Toro");
        $wine6-> setFicha("Boca intensa y potente, con una entrada muy agradable gracias a su carácter dulce.");
        $wine6 -> setMaridaje("Con todo tipo de carnes, quesos y embutidos.");
        $wine6 -> setImagen("https://www.enotecum.com/wp-content/uploads/2018/03/enotecum-vino-el-picaro-toro-1.png");


        $doctrine->persist($wine1);
        $doctrine->persist($wine2);
        $doctrine->persist($wine3);
        $doctrine->persist($wine4);
        $doctrine->persist($wine5);
        $doctrine->persist($wine6);

        $doctrine->flush();
        return new Response ("Vinos añadidos correctamente ");
     
     
    }*/
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
};

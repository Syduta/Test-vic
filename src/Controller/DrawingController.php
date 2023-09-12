<?php

namespace App\Controller;

use App\Repository\DrawingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class DrawingController extends AbstractController
{
    public function index(){}

    #[Route('/drawing/{id}', name:'drawing')]
    public function showDrawing($id, DrawingRepository $drawingRepository){
        $drawing = $drawingRepository->find($id);
        return $this->render('drawing.html.twig',['drawing'=>$drawing]);
    }

    #[Route('/drawings', name:'drawings')]
    public function showDrawings(DrawingRepository $drawingRepository){
        $drawings = $drawingRepository->findAll();
        return $this->render('drawings.html.twig',['drawings'=>$drawings]);
    }
}
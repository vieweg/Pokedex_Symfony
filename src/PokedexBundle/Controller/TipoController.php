<?php

namespace PokedexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PokedexBundle\Entity\Tipo;
use PokedexBundle\Form\TipoType;

class TipoController extends Controller{    
    
    function listarAction() {
        $tipos = $this->getDoctrine()->getRepository('PokedexBundle:Tipo')->findAll();
        return $this->render('Tipo/tipos.html.twig', ['tipos' => $tipos]);
    }
    
    function criarAction(Request $request) {
        $tipo = new Tipo();
        $form = $this->createForm(TipoType::class, $tipo);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($tipo);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('notice', 'Você tem um novo tipo de Pokemon');
            return $this->redirectToRoute('listarTipos');
        }
        return $this->render('Tipo/form.html.twig', ['form' => $form->createView()]);
    }
    
    function atualizarAction(Request $request, $id) {
        $tipo = $this->getDoctrine()->getRepository('PokedexBundle:Tipo')->find($id);
        $form = $this->createForm(TipoType::class, $tipo);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('listarTipos');
        }
        return $this->render('Tipo/form.html.twig', [
            'tipo' => $tipo,
            'form' => $form->createView()
        ]);
    }
    
    function deletarAction($id) {
        $tipo = $this->getDoctrine()->getRepository('PokedexBundle:Tipo')->find($id);
        $this->getDoctrine()->getManager()->remove($tipo);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('listarTipo');
    }
        
}

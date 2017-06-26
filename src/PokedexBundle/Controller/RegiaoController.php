<?php

namespace PokedexBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Monolog\Logger;
use PokedexBundle\Entity\Regiao;
use PokedexBundle\Form\RegiaoType;

/**
 * Description of RegiaoController
 *
 * @author jhony
 */
class RegiaoController extends Controller {
    
    function listarAction(Request $request) {
        $qb = $this->getDoctrine()
            ->getManager()->createQueryBuilder();
        $qb->select('r')->from('PokedexBundle:Regiao', 'r')
                ->where('r.id > 0');
        if ($request->query->has('clima')) {
            $qb->andWhere('r.clima = :clima');
            $qb->setParameter('clima', 
                    $request->query->get('clima'));
        }
        if ($request->query->has('nome')) {
            $qb->andWhere('r.nome LIKE :nome');
            $qb->setParameter('nome', '%' . 
                    $request->query->get('nome') . '%');
        }
        $regioes = $qb->getQuery()->getResult();
        return $this->render('Regiao/regioes.html.twig', ['regioes' => $regioes]);
    }
    
    function criarAction(Request $request) {
        $regiao = new Regiao();
        $form = $this->createForm(RegiaoType::class, $regiao);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->persist($regiao);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('notice', 'Região criada');
            return $this->redirectToRoute('listarRegioes');
        }
        return $this->render('Regiao/form.html.twig', ['form' => $form->createView()]);
    }
    
    function atualizarAction(Request $request, $id) {
        $regiao = $this->getDoctrine()->getRepository('PokedexBundle:Regiao')->find($id);
        $form = $this->createForm(RegiaoType::class, $regiao);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('listarRegioes');
        }
        return $this->render('Regiao/form.html.twig', [
            'regiao' => $regiao,
            'form' => $form->createView()
        ]);
    }
    
    function deletarAction($id) {
        $regiao = $this->getDoctrine()->getRepository('PokedexBundle:Regiao')->find($id);
        $this->getDoctrine()->getManager()->remove($regiao);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('listarRegioes');
    }
    
}

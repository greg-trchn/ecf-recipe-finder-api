<?php

namespace App\Controller;

use App\Repository\AlimentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlimentController extends AbstractController
{
    /**
     * @Route("/aliment", name="aliment", methods={"GET"})
     * @param AlimentRepository $repository
     * @return Response
     */
    public function index(AlimentRepository $repository): Response
    {
        return $this->json($repository->findAll(), Response::HTTP_OK, [], ['groups' => 'public']);
    }

    /**
     * @Route("/aliment/{value}", name="aliment_find_by_like", methods={"GET"})
     * @param AlimentRepository $repository
     * @return Response
     */
    public function findByLike(AlimentRepository $repository, $value): Response{
        return $this->json($repository->findByLike($value), Response::HTTP_OK, [], ['groups' => 'public']);
    }
}

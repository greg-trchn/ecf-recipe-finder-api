<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Service\UserService;
use Doctrine\DBAL\Exception\NotNullConstraintViolationException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use InvalidArgumentException;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/register", methods={"POST"})
     *
     * @param Request $request
     * @param UserService $userService
     * @return Response
     */
    public function register(
        Request $request,
        UserService $userService): Response
    {
        try {
            $user = new User();
            $request->request->add(['user' => json_decode($request->getContent(), true)]);
            $form = $this->createForm(UserType::class, $user)->handleRequest($request);
            return $this->json($userService->new($form, $user), Response::HTTP_CREATED, [], ['groups' => ['public', 'private']]);
        } catch (UniqueConstraintViolationException $e) {
            return $this->json(['error' => 'Conflict'], Response::HTTP_CONFLICT, [], ['groups' => 'public']);
        } catch (NotNullConstraintViolationException | InvalidArgumentException $e) {
            return $this->json(['error' => 'Bad Request'], Response::HTTP_BAD_REQUEST, [], ['groups' => 'public']);
        }
    }

    /**
     * @Route("/login", methods={"POST"})
     *
     * @param Request $request
     * @param UserService $userService
     * @return Response
     */
    public function login(
        Request $request,
        UserService $userService): Response
    {
        try {
            $user = new User();
            $request->request->add(['user' => json_decode($request->getContent(), true)]);
            $form = $this->createForm(UserType::class, $user)->handleRequest($request);
            return $this->json($userService->login($form, $user), Response::HTTP_OK, [], ['groups' => ['public', 'private']]);
        } catch (RuntimeException $e) {
            return $this->json(['error' => 'Not Found'], Response::HTTP_NOT_FOUND, [], ['groups' => 'public']);
        } catch (InvalidArgumentException $e) {
            return $this->json(['error' => 'Bad Request'], Response::HTTP_BAD_REQUEST, [], ['groups' => 'public']);
        }
    }
}

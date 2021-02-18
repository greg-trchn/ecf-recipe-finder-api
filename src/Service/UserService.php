<?php


namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use InvalidArgumentException;
use RuntimeException;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserService
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * @param UserRepository $repository
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(
        UserRepository $repository,
        UserPasswordEncoderInterface $encoder
    )
    {
        $this->repository = $repository;
        $this->encoder = $encoder;
    }

    /**
     * @param FormInterface $form
     * @param User $user
     * @return UserInterface
     */
    public function new(FormInterface $form, User $user): UserInterface
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $passwordHash = $this->encoder->encodePassword($user, $user->getPassword());
            $user->setToken(base64_encode($user->getUsername() . ':' . $passwordHash));
            $this->repository->upgradePassword($user, $passwordHash);
            return $user;
        }
        throw new InvalidArgumentException();
    }

    /**
     * @param FormInterface $form
     * @param User $user
     * @return UserInterface
     */
    public function login(FormInterface $form, User $user): UserInterface
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $user->getPassword();
            $user = $this->repository->findOneBy(["email" => $user->getEmail()]);
            if ($user && $this->encoder->isPasswordValid($user, $password)) {
                return $user;
            }
            throw new RuntimeException();
        }
        throw new InvalidArgumentException();
    }
}
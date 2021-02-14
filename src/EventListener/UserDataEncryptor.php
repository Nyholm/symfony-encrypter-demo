<?php


namespace App\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\User;
use Symfony\Component\Encryption\EncryptionInterface;

class UserDataEncryptor
{
    private $encryptor;
    private $applicationSecret;

    public function __construct(EncryptionInterface $encryptor, string $applicationSecret)
    {
        $this->encryptor = $encryptor;
        $this->applicationSecret = $applicationSecret;
    }

    public function prePersist(User $user, LifecycleEventArgs $event): void
    {
        $this->encryptEmail($user);
    }

    public function preUpdate(User $user, LifecycleEventArgs $event): void
    {
        $this->encryptEmail($user);
    }

    private function encryptEmail(User $user)
    {
        $key = $this->encryptor->generateKey($this->applicationSecret);

        $user->setEmail($this->encryptor->encrypt($user->getEmail(), $key));
    }

    public function postLoad(User $user, LifecycleEventArgs $event): void
    {
        $key = $this->encryptor->generateKey($this->applicationSecret);

        $user->setEmail($this->encryptor->decrypt($user->getEmail(), $key));
    }
}

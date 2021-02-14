<?php


namespace App\EventListener;


use Doctrine\ORM\Event\LifecycleEventArgs;
use App\Entity\User;

class UserDataEncryptor
{
    public function prePersist(User $user, LifecycleEventArgs $event): void
    {
        $x = 2;
    }
    public function preUpdate(User $user, LifecycleEventArgs $event): void
    {
        $x = 2;
    }
    public function postLoad(User $user, LifecycleEventArgs $event): void
    {
        $x = 2;
    }
}
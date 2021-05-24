<?php

namespace App\Security\Voter;

use App\Entity\ClientUser;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{
    const CLIENT_USER_ACTION = 'client_user_action';

    protected function supports($attribute, $client_user): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [self::CLIENT_USER_ACTION])
        && $client_user instanceof \App\Entity\ClientUser;
    }

    protected function voteOnAttribute($attribute, $client_user, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // On verifie qu'il y a bien un user connecté
        if (!$user instanceof UserInterface) {
            return false;
        }

        // On vérfie que le client_user est lié à un user
        if ($client_user->getUser() === null) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        if ($attribute === self::CLIENT_USER_ACTION) {
            return $this->canDoAction($client_user, $user);
        }

        return false;
    }

    private function canDoAction(ClientUser $client_user, User $user)
    {
        // Le user peut effectuer une action sur le client_user
        return $user === $client_user->getUser();
    }
}

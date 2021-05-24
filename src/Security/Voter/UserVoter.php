<?php

namespace App\Security\Voter;

use App\Entity\ClientUser;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter
{
    const CLIENT_USER_SHOW = 'client_user_show';
    const CLIENT_USER_CREATE = 'client_user_create';
    const CLIENT_USER_UPDATE = 'client_user_update';
    const CLIENT_USER_DELETE = 'client_user_delete';

    protected function supports($attribute, $client_user): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [
            self::CLIENT_USER_SHOW,
            self::CLIENT_USER_CREATE,
            self::CLIENT_USER_UPDATE,
            self::CLIENT_USER_DELETE,
        ])
        && $client_user instanceof \App\Entity\ClientUser;
    }

    protected function voteOnAttribute($attribute, $client_user, TokenInterface $token): bool
    {
        $user = $token->getUser();

        // On verifie qu'il y a bien un user connecté et on vérfie que le client_user est lié à un user
        if (!$user instanceof UserInterface || $client_user->getUser() === null) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case self::CLIENT_USER_SHOW:
                return $this->canShow($client_user, $user);
                break;
            case self::CLIENT_USER_UPDATE:
                return $this->canUpdate($client_user, $user);
                break;
            case self::CLIENT_USER_DELETE:
                return $this->canDelete($client_user, $user);
                break;
            case self::CLIENT_USER_CREATE:
                return $this->canCreate($client_user, $user);
                break;

        }

        return false;
    }

    private function canShow(ClientUser $client_user, User $user)
    {
        // Le user peut récupérer le client_user
        return $user === $client_user->getUser();
    }

    private function canCreate(ClientUser $client_user, User $user)
    {
        // Le user peut créer un nouveau client_user
        return true;
    }

    private function canUpdate(ClientUser $client_user, User $user)
    {
        // Le user peut éditer le client_user
        return $user === $client_user->getUser();
    }

    private function canDelete(ClientUser $client_user, User $user)
    {
        // Le user peut supprimer le client_user
        return $user === $client_user->getUser();
    }
}

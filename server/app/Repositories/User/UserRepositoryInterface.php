<?php

namespace App\Repositories\User;

use App\Repositories\RepositoryInterface;

/**
 * The repository interface for the User Model
 */
interface UserRepositoryInterface extends RepositoryInterface
{
    /**
     * Return all user models with roles (Eager Loading)
     */
    public function allWithRoles();

    /**
     * Reset password for first login
     */
    public function resetPassword($model, $data);

    /*
     * register account user customer
     */
    public function registerCustomer($data);

    public function checkExistUserByEmail($email);

    /**
     * Create or update user login socical api.
     */
    public function handleLoginSocialiteApi($user, $oauth_type);
}

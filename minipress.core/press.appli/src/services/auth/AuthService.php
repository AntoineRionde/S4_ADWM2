<?php

namespace press\app\services\auth;

use Exception;
use press\app\models\User;

class AuthService
{
    //connexion
    /**
     * @param string $username
     * @param string $password
     * @return array|null gère la connexion d'un user
     * gère la connexion d'un user
     * @throws Exception
     */
    public function authenticate(string $username, string $password): ?array
    {

        if (empty($username) || empty($password)) {
            throw new Exception("invalidCredentials");
        }

        $user = User::where('username', $username)->first();
        if ($user === null) {
            throw new Exception("invalidCredentials:mail");
        }

        $hash = $user->password;
        if (!password_verify($password, $hash)) {
            throw new Exception("invalidCredentials:pass");
        }

        if ($user->active === 0) {
            $user->active = 1;
        }

        return $user->toArray();
    }

    //Inscription

    /**
     * @param string $username
     * @param string $password
     * @param string $ConfirmPassword
     * @param int $role
     * @return void
     * permet de s'inscire sur le site
     * @throws Exception
     */
    public function register(string $username, string $password, string $ConfirmPassword, int $role = 0): void
    {

        $user = User::where('username', $username)->first();

        if ($user !== null)
            throw new Exception("userAlreadyExists");

        if ($password !== $ConfirmPassword)
            throw new Exception("passwordNotMatch");

        if (!$this->checkPasswordStrength($password, 8))
            throw new Exception("weakPassword");

        $user = new User();
        $user->username = $username;
        $user->nom = "";
        $user->prenom = "";
        $user->password = password_hash($password, PASSWORD_DEFAULT, ['cost' => 12]);
        $user->activation_token = $this->generateActivitionToken($username);
        $user->activation_expires = date('Y-m-d H:i:s', 60 * 60);
        $user->role = $role;
        //$user->created_at = date('Y-m-d H:i:s');
        $user->save();
    }

    /**
     * @param string $pass le mdp entré pas l'utilisateur
     * @param int $min taille minimale du mdp
     * @return bool True ou False si les condtions du mdp sont remplies ou pas
     */
    public function checkPasswordStrength(string $pass,
                                          int    $min): bool
    {
        $length = (strlen($pass) >= $min); // longueur minimale
        $digit = preg_match("#[\d]#", $pass); // au moins un digit
        $special = preg_match("#[\W]#", $pass); // au moins un car. spécial
        $lower = preg_match("#[a-z]#", $pass); // au moins une minuscule
        $upper = preg_match("#[A-Z]#", $pass); // au moins une majuscule
        if (!$length || !$digit || !$special || !$lower || !$upper) return false;
        return true;
    }

    //Activation

    /**
     * @param string $username
     * @return string
     * @throws Exception
     * génère une token d'activation
     */
    private function generateActivitionToken(string $username): string
    {
        $token = bin2hex(random_bytes(64));
        return $token;
    }

    /**
     * @param string $token
     * @return void active un compte utilisateur
     * active un compte utilisateur
     */
    public function activate(string $token): void
    {
        $user = User::where('activation_token', $token)->first();
        $user->active = 1;
    }
}
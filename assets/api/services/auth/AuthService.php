<?php
require_once __DIR__ . "/../../utils/databases/DatabaseManager.php";
require_once __DIR__ . "/../../models/User.php";

class AuthService {
    private DatabaseManager $manager;

    /**
     * AuthService constructor.
     * @param DatabaseManager $manager
     */
    public function __construct(DatabaseManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param string $email
     * @param string $password
     * @return string|null
     * @throws Exception
     */
    public function login(string $email, string $password): ?string {
        $result = $this->manager->findOne('SELECT idUser, emailAddress, pwd FROM USER WHERE emailAddress = ?', [
            $email
        ]);
        if (!password_verify($password, $result['pwd'])) {
            return null;
        }
        $token = bin2hex(random_bytes(32));
        $this->manager->exec('UPDATE USER SET token = ? WHERE idUser = ?', [
           $token,
           $result['idUser']
        ]);
        return $token;
    }

    /**
     * @param string $email
     * @return bool
     */
    public function emailExists(string $email): bool {
        $res = $this->manager->findOne('SELECT emailAddress FROM USER WHERE emailAddress = ?', [
            $email
        ]);
        return $res !== null;
    }

    public function userFromToken(string $token): ?User {
        $res = $this->manager->findOne('SELECT idUser, firstname, lastname, emailAddress, pwd FROM USER WHERE token = ?', [
            $token
        ]);
        if ($res === null) {
            return null;
        }
        return new User($res['idUser'], $res['firstname'], $res['lastname'], $res['emailAddress'], $res['pwd']);
    }
}
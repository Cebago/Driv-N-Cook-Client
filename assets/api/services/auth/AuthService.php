<?php
require_once __DIR__ . "/../../utils/databases/DatabaseManager.php";
require_once __DIR__ . "/../../models/User.php";
require_once __DIR__ . "/../../models/Fidelity.php";

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
     * @param string $token
     * @return User|null
     */
    public function userFromToken(string $token): ?User {
        $res = $this->manager->findOne('SELECT idUser, firstname, lastname, emailAddress, pwd FROM USER WHERE token = ?', [
            $token
        ]);
        if ($res === null) {
            return null;
        }
        return new User($res['idUser'], $res['firstname'], $res['lastname'], $res['emailAddress'], $res['pwd']);
    }

    /**
     * @param string $token
     * @return User|null
     */
    public function fidelityFromToken(string $token): ?User {
        $user = $this->userFromToken($token);
        if ($user === null) {
            return null;
        }
        $res = $this->manager->findOne("SELECT idFidelity, points FROM FIDELITY, USER WHERE token = ? AND idFidelity = fidelityCard", [
            $token
        ]);
        if ($res === null) {
            return $user;
        }
        $fidelity = new Fidelity($res["idFidelity"], $res["points"]);
        $user->setFidelity($fidelity);
        return $user;
    }

    public function subscribeFidelity(string $token) {
        $user = $this->userFromToken($token);
        if ($user === null) {
            return null;
        }
        $fidelity = $this->fidelityFromToken($token);
        if ($fidelity->getFidelity() !== null) {
            return $fidelity;
        }
        $res = $this->manager->exec("INSERT INTO FIDELITY (points) VALUE (0)", []);
        $last = $this->manager->getLastInsertId();
        $res = $this->manager->exec("UPDATE USER SET fidelityCard = ? WHERE token = ?", [
            $last,
            $token
        ]);
        $fidelity = new Fidelity($last, 0);
        $user->setFidelity($fidelity);
        return $user;
    }
}
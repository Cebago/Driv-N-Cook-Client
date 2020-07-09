<?php
require_once __DIR__ . "/../../utils/databases/DatabaseManager.php";
require_once __DIR__ . "/../../models/User.php";
require_once __DIR__ . "/../../models/Fidelity.php";
require_once __DIR__ . "/../../models/Advantage.php";

class AuthService
{
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
    public function login(string $email, string $password): ?string
    {
        $result = $this->manager->findOne('SELECT idUser, emailAddress, pwd FROM USER WHERE emailAddress = ?', [
            $email
        ]);
        if (!password_verify($password, $result['pwd'])) {
            return null;
        }
        $token = bin2hex(random_bytes(32));
        $this->manager->exec('UPDATE USERTOKEN, USER SET USERTOKEN.token = ? WHERE user = idUser 
                                                 AND tokenType = ? 
                                                 AND idUser = ? ', [
            $token,
            "Appli",
            $result['idUser']
        ]);
        return $token;
    }

    public function subscribeFidelity(string $token)
    {
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
        $res = $this->manager->exec("UPDATE USER, USERTOKEN SET fidelityCard = ? WHERE USERTOKEN.token = ? AND tokenType = ? AND user = idUser", [
            $last,
            $token,
            "Appli"
        ]);
        $fidelity = new Fidelity($last, 0);
        $user->setFidelity($fidelity);
        return $user;
    }

    /**
     * @param string $token
     * @return User|null
     */
    public function userFromToken(string $token): ?User
    {
        $res = $this->manager->findOne('SELECT idUser, firstname, lastname, emailAddress, pwd FROM USER, USERTOKEN WHERE USERTOKEN.token = ? 
                                                                             AND user = idUser 
                                                                             AND tokenType = ?', [
            $token,
            "Appli"
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
    public function fidelityFromToken(string $token): ?User
    {
        $user = $this->userFromToken($token);
        if ($user === null) {
            return null;
        }
        $res = $this->manager->findOne("SELECT idFidelity, points FROM FIDELITY, USER, USERTOKEN WHERE USERTOKEN.token = ? 
                                                           AND idFidelity = fidelityCard 
                                                           AND tokenType = ? 
                                                           AND user = idUser", [
            $token,
            'Appli'
        ]);
        if ($res === null) {
            return $user;
        }
        $fidelity = new Fidelity($res["idFidelity"], $res["points"]);
        $user->setFidelity($fidelity);
        return $user;
    }

    /**
     * @param int $getPoints
     * @return array
     */
    public function fidelityFromPoints(int $getPoints)
    {
        $fidelity = [];
        $advantages = $this->manager->getAll("SELECT idAdvantage, advantageName, advantagePoints, categoryName FROM ADVANTAGE, PRODUCTCATEGORY 
                                                    WHERE advantagePoints <= ? AND idCategory = category ORDER BY advantagePoints ASC", [
            $getPoints
        ]);
        for ($i = 0; $i < count($advantages); $i++) {
            $tmp = new Advantage($advantages[$i]["idAdvantage"], $advantages[$i]["advantagePoints"], $advantages[$i]["advantageName"], $advantages[$i]["categoryName"]);
            $fidelity["Advantage" . $i] = $tmp;
        }
        return $fidelity;
    }
}
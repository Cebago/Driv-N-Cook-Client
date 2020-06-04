<?php


class Fidelity implements  JsonSerializable{
    private int $idFidelity;
    private int $points;

    /**
     * Fidelity constructor.
     * @param int $idFidelity
     * @param int $points
     */
    public function __construct(int $idFidelity, int $points)
    {
        $this->idFidelity = $idFidelity;
        $this->points = $points;
    }


    /**
     * @return int
     */
    public function getIdFidelity(): int
    {
        return $this->idFidelity;
    }

    /**
     * @param int $idFidelity
     */
    public function setIdFidelity(int $idFidelity): void
    {
        $this->idFidelity = $idFidelity;
    }

    /**
     * @return int
     */
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * @param int $points
     */
    public function setPoints(int $points): void
    {
        $this->points = $points;
    }

    /**
     * @return mixed|void
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
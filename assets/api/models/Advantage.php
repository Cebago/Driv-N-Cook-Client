<?php


class Advantage implements JsonSerializable {
    private int $idAdvantage;
    private int $points;
    private string $name;
    private string $category;

    /**
     * Advantage constructor.
     * @param int $idAdvantage
     * @param int $points
     * @param string $name
     * @param string $category
     */
    public function __construct(int $idAdvantage, int $points, string $name, string $category)
    {
        $this->idAdvantage = $idAdvantage;
        $this->points = $points;
        $this->name = $name;
        $this->category = $category;
    }

    /**
     * @return int
     */
    public function getIdAdvantage(): int
    {
        return $this->idAdvantage;
    }

    /**
     * @param int $idAdvantage
     */
    public function setIdAdvantage(int $idAdvantage): void
    {
        $this->idAdvantage = $idAdvantage;
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * @return array|mixed
     */
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
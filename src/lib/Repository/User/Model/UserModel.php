<?php


namespace app\lib\Repository\User\Model;


class UserModel
{
    /** @var integer */
    private $id;

    /** @var string */
    private $name;

    /** @var string */
    private $userIp;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
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
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUserIp(): string
    {
        return $this->userIp;
    }

    /**
     * @param string $userIp
     */
    public function setUserIp(string $userIp): void
    {
        $this->userIp = $userIp;
    }
}
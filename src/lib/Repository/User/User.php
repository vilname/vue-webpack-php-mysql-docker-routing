<?php

namespace app\lib\Repository\User;

use app\lib\Repository\Main;

class User extends Main
{
    /**
     * @param string $fio
     * @return int
     */
    public function saveUser(string $fio): int
    {
        $sth = $this->db->prepare("INSERT INTO `user` SET `name` = :name, `ip_user` = :ip_user");

        $sth->execute([
            'name' => $fio,
            'ip_user' => $_SERVER['REMOTE_ADDR']
        ]);

        // Получаем id вставленной записи
        return $this->db->lastInsertId();
    }
}
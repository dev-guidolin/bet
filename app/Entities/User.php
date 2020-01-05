<?php namespace App\Entities;

use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

class User extends Entity
{
    public function setPassword(string $pass)
    {
        $this->password = password_hash($pass, PASSWORD_BCRYPT);
        return $this;
    }
    public function setCreateAt(string $dateString)
    {
        $this->attributes['creat_at'] = new Time($dateString, 'UTC');
        return $this;
    }

    public function getCreateAt(string $format = 'Y-m-d H:i:s')
    {
        $this->attributes['creat_at'] = $this->mutateDate($this->attributes['creat_at']);
        $timezone = $this->timezone ?? app_timezone();

        $this->attributes['creat_at']->setTimezone($timezone);

        return $this->attributes['creat_at']->format($format);
    }

}
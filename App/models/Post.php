<?php

namespace App\Models;


use App\Traits\TimestampableTrait;

class Post
{
    use TimestampableTrait;

    protected $title;

    protected $body;

    /**
     * @return User
     */
    protected $user;

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * @return mixed
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body): void
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function __toString(): string
    {
        try {
            return $this->getTitle();
        } catch (\Exception $e) {
            var_dump($e);
        }
    }

}
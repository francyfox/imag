<?php


namespace App\Services\tasks;

interface task
{
    public function setState($status);
    public function getState() : string;
    public function accept() : void;
    public function wait() : void;
    public function rejected() : void;
    public function done() : void;
    public function broken() : void;

}

class SetState
{
    protected $state;
    protected const WAIT = 0;
    protected const ACCEPTED = 1;
    protected const DONE = 2;
    protected const REJECTED = 3;
    protected const BROKEN = 4;
    protected $error;

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @return mixed
     */
    public function getError() : string
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    public function setError($error): void
    {
        $this->error = '[TASK_MANAGER_ERROR] = '. $error;
        echo '<div class="error">' . $this->error . '</div>';
    }

    public function setState($status)
    {
        $this->state = $status;
    }

    public function wait(): void
    {
        $this->state = self::WAIT;
    }

    public function accept() : void
    {
        if ($this->state === self::REJECTED){
            throw new \LogicException('Cant accept. The task is REJECTED');
        }
        if ($this->state === self::BROKEN){
            throw new \LogicException('Cant accept. The task is BROKEN');
        }
        $this->state = self::ACCEPTED;
    }

    public function rejected() : void
    {
        if ($this->state === self::ACCEPTED){
            throw new \LogicException('Cant REJECT. The task is ACCEPTED');
        }
        if ($this->state === self::DONE){
            throw new \LogicException('Cant REJECT. The task is DONE');
        }
        $this->state = self::ACCEPTED;
    }

    public function done() : void
    {
        if ($this->state === self::BROKEN){
            throw new \LogicException('Cant Done. The task is BROKEN');
        }
        if ($this->state === self::REJECTED){
            throw new \LogicException('Cant Done. The task is REJECTED');
        }
        $this->state = self::ACCEPTED;
    }

    public function broken() : void
    {
        $this->state = self::BROKEN;
    }
}

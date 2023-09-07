<?php

class Order
{
    private $id;
    private $name;
    private $createdAt;
    private $updatedAt;
    private $status;

    public function __construct($name)
    {
        $this->name = $name;
        $this->createdAt = new DateTime();
        $this->updatedAt = new DateTime();
        $this->status = 'created'; // Всегда устанавливаем статус как 'created'
    }

    public function confirm()
    {
        if ($this->status === 'created') {

            // Сравниваем текущее время с 12:00 PM
            if ($this->createdAt->format('H') >= 12) {
                $this->setStatus('pending_confirmation');
            } else {
                $this->setStatus('confirmed');
            }

        } else {

            throw new Exception('Order is already confirmed or completed');

        }

        $this->updatedAt = new DateTime();
    }
    

    public function complete()
    {
        if ($this->status === 'confirmed') {

            $now = new DateTime();
            $interval = $now->diff($this->createdAt);

            if ($interval->i < 1) {
                throw new Exception('Заказ может быть выполнен только через 1 минуту');
            }

            $this->status = 'completed';

        } else {

            throw new Exception('Заказ не подтвержден');

        }

        $this->updatedAt = new DateTime();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        $this->updatedAt = new DateTime();
    }

    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
}
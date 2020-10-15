<?php namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Support\MessageBag;

class ValidationException extends Exception
{
     /**
     * @var MessageBag
     */
    private $messageBag;

    /**
     * ValidationException constructor.
     * @param MessageBag $messageBag
     */
    public function __construct(MessageBag $messageBag)
    {
        $this->messageBag = $messageBag;
    }

    /**
     * @return MessageBag
     */
    public function getMessageBag()
    {
        return $this->messageBag;
    }
}


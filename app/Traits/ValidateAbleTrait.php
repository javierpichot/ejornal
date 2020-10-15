<?php namespace App\Traits;

use App\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;


trait ValidateAbleTrait
{
    /**
     * {@inheritDoc}
     */
    public function runValidator(array $attributes, $rules, $messages)
    {
        $validator = Validator::make($attributes, $rules, $messages);
        if ($validator->fails()) {
            throw new ValidationException($validator->getMessageBag());
        }
    }
}


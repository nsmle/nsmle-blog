<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AlphaDashDot implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (! is_string($value) && ! is_numeric($value)) {
            return false;
        }

        return preg_match('/^([a-z0-9_](?:(?:[a-z0-9_]|(?:\.(?!\.))){2,16}(?:[a-z0-9_]))?)$/u', $value) > 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.alpha_dash_dot');
    }
}

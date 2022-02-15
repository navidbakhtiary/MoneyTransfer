<?php

namespace App\Rules;

use App\Models\Design;
use Illuminate\Contracts\Validation\Rule;

class BankAccountRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'حساب بانکی وارد شده نامعتبر است';
    }
}

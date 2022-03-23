<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {
        $fortifyPasswordRules = new Password;
        $fortifyPasswordRules->requireNumeric();
        $fortifyPasswordRules->withMessage(":attribute harus minimal 8 karakter dan mengandung setidaknya satu angka.");
        
        return ['required', 'string', $fortifyPasswordRules, 'confirmed'];
    }
}

<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AfterCurrentDate implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $date=\DateTime::createFromFormat('Y-m-d', $value);
        $currentDate = new \DateTime();
        if ($date < $currentDate) {
            $fail("The $attribute must be a date after the current date.");
        }
    }
}

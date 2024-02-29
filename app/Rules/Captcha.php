<?php

namespace App\Rules;
use Closure;
use ReCaptcha\ReCaptcha;
use Illuminate\Contracts\Validation\ValidationRule;

class Captcha implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
    }
    public function passes (string $attribute, $value)
    {
        $recaptcha = new ReCaptcha(env('CAPTCHA_SECRET'));
        $response = $recaptcha->verify($value, $_SERVER['REMOTE_ADDR']);
        return $response->isSuccess();

    }
    public function message()
    {
        return 'Làm ơn check mã captcha.'; 
    }
}

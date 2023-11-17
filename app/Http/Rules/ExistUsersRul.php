<?php

namespace App\Rules;

use App\Repositories\UsersRepository;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ExistUsersRule implements ValidationRule
{
    protected UsersRepository $usersRepository;

    public function __construct()
    {
        $this->usersRepository = new usersRepository();
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $isUsers= $this->usersRepository->get($value);
        if(!$isUsers) {
            $fail('Users não encontrado!');
        }
    }
}

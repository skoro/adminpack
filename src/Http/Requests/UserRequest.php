<?php

namespace Skoro\AdminPack\Http\Requests;

use Skoro\AdminPack\Dto\UserDto;
use Skoro\AdminPack\Validation\UserValidationRules;
use Illuminate\Foundation\Http\FormRequest;
use RuntimeException;

/**
 * UserRequest contains user validation rules.
 */
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // TODO: authorize.
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     *
     * @throws RuntimeException When validation rules couldn't be found.
     */
    public function rules(UserValidationRules $rules)
    {
        switch ($this->method()) {
            case 'POST':
                /**
                 * POST method is for both user registration and
                 * for user creation by admin.
                 * Choose appropriate rules by the current request route.
                 */
                return $this->routeIs('admin.user.store')
                    ? $rules->create()
                    : $rules->register();

            // Updating the user.
            case 'PUT':
                return $rules->update($this->user);
        }

        throw new RuntimeException('No user validation rules for method: ' . $this->method());
    }

    /**
     * Creates a user DTO from the request.
     */
    public function getUserDto(): UserDto
    {
        return new UserDto($this->validated());
    }
}

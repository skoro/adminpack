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
        // New user.
        if ($this->routeIs('admin.user.store')) {
            return $rules->create();
        }
        // Update existing user.
        elseif ($this->routeIs('admin.user.update')) {
            return $rules->update($this->route('user'));
        }
        // Update the user profile.
        elseif ($this->routeIs('admin.user.updateProfile')) {
            return $rules->profile(auth_admin()->user());
        }
        else {
            throw new RuntimeException('No validation rules for route.');
        }
    }

    /**
     * Creates a user DTO from the request.
     */
    public function getUserDto(): UserDto
    {
        return new UserDto($this->validated());
    }
}

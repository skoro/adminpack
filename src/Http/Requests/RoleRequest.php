<?php

namespace Skoro\AdminPack\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use RuntimeException;

/**
 * The role request.
 */
class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth_admin()->user()->can('manageRoles');
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'permission.*' => 'Choose one of the permissions.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'permission' => ['required', 'array'],
            'permission.*' => ['integer', 'exists:permissions,id'],
        ];

        switch ($this->method()) {
            case 'POST': // new role
                $rules['name'][] = 'unique:roles,name';
                break;

            case 'PUT': // edit role
                $role = $this->route('role');
                if (empty($role)) {
                    throw new RuntimeException('Parameter "role" is required.');
                }
                $rules['name'][] = Rule::unique('roles', 'name')->ignore($role);
                break;

            default:
                throw new RuntimeException('Cannot create validation rules for method: ' . $this->method());
        }

        return $rules;
    }

    /**
     * Returns the role name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Returns the role permission IDs.
     *
     * @return int[]
     */
    public function getPermissions(): array
    {
        return $this->permission;
    }
}

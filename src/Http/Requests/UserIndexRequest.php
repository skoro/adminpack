<?php

namespace Skoro\AdminPack\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Skoro\AdminPack\Dto\UserQueryDto;
use Skoro\AdminPack\Models\User;

/**
 * User Index Request.
 * 
 * This request validates parameters to the users index list.
 */
class UserIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth_admin()->user()->can('viewAny', User::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // Sort parameters.
            'sort' => 'nullable|in:id,name,email,role,created',
            'order' => 'required_with:sort|in:asc,desc',

            // Find parameters.
            'text' => 'nullable|string|max:255',
            'role' => 'nullable|int|exists:admin_roles,id',

            'limit' => 'nullable|int|max:100',
        ];
    }

    /**
     * Converts the parameters to the UserQueryDto.
     */
    public function getQueryDto(): UserQueryDto
    {
        return new UserQueryDto($this->validated());
    }

    /**
     * Count of users on the page.
     */
    public function getLimit(int $default = 15): int
    {
        return $this->limit ?: $default;
    }
}

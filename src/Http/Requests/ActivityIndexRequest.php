<?php

namespace Skoro\AdminPack\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Skoro\AdminPack\Dto\ActivityQueryDto;

/**
 * Activity Index Request.
 * 
 * This request validates parameters to the activity index list.
 */
class ActivityIndexRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // return auth_admin()->user()->can('viewAny', User::class);
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
            'sort' => 'nullable|in:created,event,user,message',
            'order' => 'required_with:sort|in:asc,desc',

            'limit' => 'nullable|int|max:100',
        ];
    }

    /**
     * Converts the parameters to the ActivityQueryDto.
     */
    public function getQueryDto(): ActivityQueryDto
    {
        return new ActivityQueryDto($this->validated());
    }

    /**
     * Count of users on the page.
     */
    public function getLimit(int $default = 15): int
    {
        return $this->limit ?: $default;
    }
}

<?php

namespace Skoro\AdminPack\Http\Requests;

use Skoro\AdminPack\Models\OptionElement;
use Skoro\AdminPack\Repositories\OptionElementRepository;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Option request.
 */
class OptionRequest extends FormRequest
{
    /**
     * OptionElement[]
     */
    protected $elements = [];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth_admin()->user()->can('manageOptions');
    }

    /**
     * Create the validation rules for the Option request.
     *
     * @return array
     */
    public function rules(OptionElementRepository $optionRepository)
    {
        $rules = [];
        $group = $this->getGroup();
        $this->elements = $optionRepository->getElementsByGroup($group);

        /** @var OptionElement $element */
        foreach ($this->elements as $element) {
            $rules[$element->option()] = $element->validators;
        }

        return $rules;
    }

    /**
     * @return OptionElement[]
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * Returns option values from the request.
     *
     * @return array A list of key value.
     */
    public function getValues()
    {
        $keys = [];
        foreach ($this->elements as $element) {
            $keys[] = $element->option();
        }
        return $this->only($keys);
    }

    /**
     * Returns 'group' parameter value.
     */
    public function getGroup(): string
    {
        return $this->route('group');
    }
}

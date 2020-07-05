@inject('optionElRepo', 'Skoro\AdminPack\Repositories\OptionElementRepository')
@extends('admin::layouts.admin')
@php
/**
 * @param \Skoro\AdminPack\Repositories\OptionElementRepository $optionElRepo
 * @param string[] $groups  The list of groups.
 * @param string   $active  The active tab.
 */
$groups = $optionElRepo->groups();
@endphp

@section('title', __('Options'))

@section('content')

    <ul class="nav nav-tabs mb-3" role="tablist">
        @foreach($groups as $group)
        <li class="nav-item" role="presentation">
            <a
                href="#tab{{ $loop->iteration }}"
                class="nav-link @if ($loop->iteration == $active) active @endif"
                data-toggle="tab"
                role="tab"
                aria-selected="{{ $loop->iteration == $active ? 'true' : 'false' }}"
            >
                {{ __($group) }}
            </a>
        </li>
        @endforeach
    </ul>

    <div class="tab-content">

        @foreach($groups as $group)
            
            <div id="tab{{ $loop->iteration }}" class="tab-pane fade @if ($loop->iteration == $active) show active @endif" role="tabpanel">
                <form action="{{ route('admin.options.update', ['group' => $group, 't' => $loop->iteration]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    @foreach($optionElRepo->getElementsByGroup($group) as $element)

                        <x-admin-form-row
                            :label="$element->widget == 'checkbox' ? '' : $element->label"
                            :error="$element->key()"
                        >

                            @switch($element->widget)
                                @case('checkbox')
                                    <div class="form-check">
                                        <input type="hidden" name={{ $element->key() }} value="0">
                                        <input
                                            id="optionElement{{ $element->id }}"
                                            name="{{ $element->key() }}"
                                            type="checkbox"
                                            class="form-check-input @error($element->key()) is-invalid @enderror"
                                            value="1"
                                            @if (old($element->key(), $element->value())) checked @endif
                                        >
                                        <label for="optionElement{{ $element->id }}" class="form-check-label">
                                            {{ $element->label }}
                                        </label>
                                    </div>
                                    @break

                                @case('input')
                                    <input
                                        type="text"
                                        name="{{ $element->key() }}"
                                        class="form-control @error($element->key()) is-invalid @enderror"
                                        value="{{ old($element->key(), $element->value()) }}"
                                    >
                                    @break

                                @case('select')
                                    <select name="{{ $element->key() }}" class="custom-select @error($element->key()) is-invalid @enderror">
                                        @foreach ($element->values as $value => $label)
                                            <option value="{{ $value }}" @if ($value == old($element->key(), $element->value())) selected @endif>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @break

                                @case('radiolist')
                                    @foreach ($element->values as $value => $label)
                                        <div class="custom-control custom-radio">
                                            <input
                                                type="radio"
                                                id="option{{ $element->id }}-{{ $value }}"
                                                name="{{ $element->key() }}"
                                                class="custom-control-input"
                                                value="{{ $value }}"
                                                @if (old($element->key(), $element->value()) == $value) checked @endif
                                            >
                                            <label class="custom-control-label" for="option{{ $element->id }}-{{ $value }}">
                                                {{ $label }}
                                            </label>
                                        </div>
                                    @endforeach
                                    @break

                            @endswitch

                            @if ($element->description)
                                <small class="form-text text-muted">
                                    {{ $element->description }}
                                </small>
                            @endif

                        </x-admin-form-row>

                    @endforeach

                    <x-admin-form-actions :back-url="false"/>

                </form>
            </div>

        @endforeach

    </div> <!-- /.tab-content -->

@endsection

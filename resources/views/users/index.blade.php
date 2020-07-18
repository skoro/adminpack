@extends('admin::layouts.admin')

@section('title', __('Users List'))

@section('breadcrumbs')
    <li class="breadcrumb-item">{{ __('System') }}</li>
    <li class="breadcrumb-item">{{ __('Users') }}</li>
@endsection

@section('content')
    <p>
        @admincan('create')
            <x-admin-button icon="person-plus-fill" type="toolbar" :url="route('admin.user.create')">
                {{ __('New User') }}
            </x-admin-button>
        @endadmincan
        @admincan('manageRoles')
            <x-admin-button icon="shield-shaded" type="toolbar" :url="route('admin.roles')">
                {{ __('Roles') }}
            </x-admin-button>
        @endadmincan
    </p>
    
    <data-table src="{{ route('admin.users.data') }}" class="table-hover table-sm">
        <template v-slot:filters>
            <div class="row table-filters mb-3">
                <div class="col-md-2 filter-active">
                    <data-filter-select
                        filter="status"
                        empty="{{ __('All Users') }}"
                        :options="{{ json_encode([
                            \Skoro\AdminPack\Models\User::STATUS_ACTIVE => __('Active'),
                            \Skoro\AdminPack\Models\User::STATUS_DISABLED => __('Disabled')
                        ]) }}"
                    />
                </div>
                <div class="col-md-3 filter-role">
                    <data-filter-select filter="role" empty="{{ __('All Roles') }}" :options="{{ roles()->pluck('name', 'id')->toJson() }}"/>
                </div>
                <div class="col-md-6 filter-name">
                    <data-filter-text filter="text" button="{{ __('Search') }}" desc="{{ __('Name or Email...') }}"/>
                </div>
            </div>
        </template>
        <template v-slot:columns="props">
            <data-column name="id">
                ID
            </data-column>
            <data-column name="name">
                {{ __('Name') }}
            </data-column>
            <data-column name="role">
                {{ __('Role') }}
            </data-column>
            <data-column name="email">
                {{ __('Email') }}
            </data-column>
            <data-column name="created" sort="desc">
                {{ __('Created') }}
            </data-column>
            @admincan('viewActions')
                <data-column name="actions" :sortable="false">
                    {{ __('Actions') }}
                </data-column>
            @endadmincan
        </template>
        <template v-slot:row="props">
            <td>
                <small class="font-italic">
                    @{{ props.row.id }}
                </small>
            </td>
            <td>
                <span :class="{ 'text-muted': props.row.status == 0 }">
                    <span class="user-name">@{{ props.row.name }}</span>
                    <status-badge :value="props.row.status"></status-badge>
                </span>
            </td>
            <td>
                <span class="badge badge-info">@{{ props.row.role }}</span>
            </td>
            <td>
                <span :class="{ 'text-muted': props.row.status == 0 }">
                    @{{ props.row.email }}
                </span>
            </td>
            <td>@{{ props.row.created_ago }}</td>
            @admincan('viewActions')
                <td>
                    <a :href="props.row.links.edit" class="btn btn-outline-secondary btn-sm">
                        {{ __('edit') }}
                    </a>
                </td>
            @endadmincan
        </template>
    </data-table>

@endsection

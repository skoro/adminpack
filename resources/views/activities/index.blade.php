@extends('admin::layouts.admin')

@section('title', __('Activity Log'))

@section('content')
    
    <data-table src="{{ route('admin.activities.data') }}" class="table-hover table-sm">

        <template v-slot:columns="props">
            <data-column name="created" sort="desc">
                {{ __('Created') }}
            </data-column>
            <data-column name="user">
                {{ __('User') }}
            </data-column>
            <data-column name="event">
                {{ __('Event') }}
            </data-column>
            <data-column name="message">
                {{ __('Message') }}
            </data-column>
        </template>

        <template v-slot:row="props">
            <td>
                @{{ props.row.created_ago }}
            </td>
            <td>
                @{{ props.row.user }}
            </td>
            <td>
                @{{ props.row.event }}
            </td>
            <td>
                @{{ props.row.message }}
            </td>
        </template>

    </data-table>

@endsection

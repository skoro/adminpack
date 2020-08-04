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
                <span v-if="props.row.user">
                    <span class="user-name">@{{ props.row.user }}</span>
                    <badge-label type="info">
                        @{{ props.row.role }}
                    </badge-label>
                </span>
                <small v-else class="text-muted font-italic">
                    {{ __('Non exist') }}
                </small>
            </td>
            <td>
                <badge-label v-if="props.row.event == 'new'" type="success">
                    {{ __('New') }}
                </badge-label>
                <badge-label v-if="props.row.event == 'updated'" type="warning">
                    {{ __('Updated') }}
                </badge-label>
                <badge-label v-if="props.row.event == 'deleted'" type="danger">
                    {{ __('Deleted') }}
                </badge-label>
            </td>
            <td>
                @{{ props.row.message }}
            </td>
        </template>

    </data-table>

@endsection

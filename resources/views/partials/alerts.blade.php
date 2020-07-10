@foreach (session()->get('alerts', []) as $alert)
    <x-admin-alert :type="$alert['type']" :close="$alert['close']">
        {{ $alert['message'] }}
    </x-admin-alert>
@endforeach

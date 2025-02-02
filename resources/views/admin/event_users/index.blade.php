@extends('adminlte::page')

@section('title', 'イベントユーザー一覧')

@section('content_header')
    <h1>イベントユーザー一覧</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route('event-users.index') }}" method="GET" class="form-inline">
                        <div class="form-group mr-2">
                            <select name="service_id" id="service_id" class="form-control">
                                <option value="">全てのサービス</option>
                                @foreach($services as $id => $name)
                                    <option value="{{ $id }}" {{ request('service_id') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mr-2">
                            <select name="event_id" id="event_id" class="form-control">
                                <option value="">全てのイベント</option>
                                @foreach($events as $id => $name)
                                    <option value="{{ $id }}" {{ request('event_id') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">絞り込み</button>
                    </form>
                </div>
                <div class="col-md-4 text-right">
                    <a href="{{ route('event-users.create') }}" class="btn btn-primary">新規作成</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>サービス</th>
                        <th>イベント</th>
                        <th>外部ユーザーID</th>
                        <th>作成日時</th>
                        <th>更新日時</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eventUsers as $eventUser)
                    <tr>
                        <td><a href="{{ route('event-users.edit', $eventUser) }}">{{ $eventUser->id }}</a></td>
                        <td>{{ $eventUser->event->service->name }}</td>
                        <td>{{ $eventUser->event->name }}</td>
                        <td>{{ $eventUser->user }}</td>
                        <td>{{ $eventUser->created_at }}</td>
                        <td>{{ $eventUser->updated_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $eventUsers->appends(request()->query())->links() }}
        </div>
    </div>
@stop

@section('js')
<script>
$(function() {
    $('#service_id').on('change', function() {
        var serviceId = $(this).val();
        var $eventSelect = $('#event_id');

        // イベント選択をリセット
        $eventSelect.empty().append('<option value="">全てのイベント</option>');

        if (serviceId) {
            $.get('{{ route("get-events") }}', { service_id: serviceId }, function(events) {
                $.each(events, function(id, name) {
                    $eventSelect.append($('<option>', {
                        value: id,
                        text: name
                    }));
                });
            });
        }
    });
});
</script>
@stop
@extends('adminlte::page')

@section('title', 'イベントユーザー編集')

@section('content_header')
    <h1>イベントユーザー編集</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('event-users.update', $eventUser) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="service_id">サービス</label>
                    <select class="form-control" id="service_id">
                        <option value="">選択してください</option>
                        @foreach($services as $id => $name)
                            <option value="{{ $id }}" {{ $eventUser->event->service_id == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="event_id">イベント</label>
                    <select class="form-control @error('event_id') is-invalid @enderror" id="event_id" name="event_id">
                        @foreach($events as $id => $name)
                            <option value="{{ $id }}" {{ $eventUser->event_id == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                    @error('event_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="user">外部ユーザーID</label>
                    <input type="number" class="form-control @error('user') is-invalid @enderror" id="ext_user_id" name="user" value="{{ old('user', $eventUser->user) }}">
                    @error('user')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>作成日時</label>
                    <input type="text" class="form-control" value="{{ $eventUser->created_at }}" readonly>
                </div>
                <div class="form-group">
                    <label>更新日時</label>
                    <input type="text" class="form-control" value="{{ $eventUser->updated_at }}" readonly>
                </div>
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">更新</button>
                    <a href="{{ route('event-users.index') }}" class="btn btn-secondary">戻る</a>
                </div>
            </form>
            <form action="{{ route('event-users.destroy', $eventUser) }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </div>
    </div>
@stop

@section('js')
<script>
$(function() {
    $('#service_id').on('change', function() {
        var serviceId = $(this).val();
        if (serviceId) {
            $.get('{{ route("get-events") }}', { service_id: serviceId }, function(events) {
                var $eventSelect = $('#event_id');
                $eventSelect.empty().append('<option value="">選択してください</option>');
                $.each(events, function(id, name) {
                    $eventSelect.append($('<option>', {
                        value: id,
                        text: name
                    }));
                });
            });
        } else {
            $('#event_id').empty().append('<option value="">サービスを選択してください</option>');
        }
    });
});
</script>
@stop
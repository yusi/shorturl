@extends('adminlte::page')

@section('title', 'イベントユーザー作成')

@section('content_header')
    <h1>イベントユーザー作成</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('event-users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="service_id">サービス</label>
                    <select class="form-control" id="service_id">
                        <option value="">選択してください</option>
                        @foreach($services as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="event_id">イベント</label>
                    <select class="form-control @error('event_id') is-invalid @enderror" id="event_id" name="event_id">
                        <option value="">サービスを選択してください</option>
                    </select>
                    @error('event_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="user">外部ユーザーID</label>
                    <input type="number" class="form-control @error('user') is-invalid @enderror" id="user" name="user" value="{{ old('user') }}">
                    @error('user')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
                <a href="{{ route('event-users.index') }}" class="btn btn-secondary">戻る</a>
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
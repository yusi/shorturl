@extends('adminlte::page')

@section('title', 'イベント編集')

@section('content_header')
    <h1>イベント編集</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('events.update', $event) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="service_id">サービス</label>
                    <select class="form-control @error('service_id') is-invalid @enderror" id="service_id" name="service_id">
                        <option value="">選択してください</option>
                        @foreach($services as $id => $name)
                            <option value="{{ $id }}" {{ old('service_id', $event->service_id) == $id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                    @error('service_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">名前</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $event->name) }}">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="url">KEY</label>
                    <input type="text" class="form-control @error('key') is-invalid @enderror" id="key" name="key" value="{{ old('key', $event->key) }}">
                    @error('key')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url', $event->url) }}">
                    @error('url')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="starts_at">開始日時</label>
                    <div class="input-group date" id="starts_at_picker" data-target-input="nearest">
                        <input type="text" name="starts_at"
                            class="form-control datetimepicker-input @error('starts_at') is-invalid @enderror"
                            data-target="#starts_at_picker"
                            value="{{ old('starts_at', $event->starts_at) }}">
                        <div class="input-group-append" data-target="#starts_at_picker" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    @error('starts_at')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="expires_at">有効期限</label>
                    <div class="input-group date" id="expires_at_picker" data-target-input="nearest">
                        <input type="text" name="expires_at"
                            class="form-control datetimepicker-input @error('expires_at') is-invalid @enderror"
                            data-target="#expires_at_picker"
                            value="{{ old('expires_at', $event->expires_at) }}">
                        <div class="input-group-append" data-target="#expires_at_picker" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                    @error('expires_at')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>作成日時</label>
                    <input type="text" class="form-control" value="{{ $event->created_at }}" readonly>
                </div>
                <div class="form-group">
                    <label>更新日時</label>
                    <input type="text" class="form-control" value="{{ $event->updated_at }}" readonly>
                </div>
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">更新</button>
                    <a href="{{ route('events.index') }}" class="btn btn-secondary">戻る</a>
                </div>
            </form>
            <form action="{{ route('events.destroy', $event) }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </div>
    </div>
@stop

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/locale/ja.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/js/tempusdominus-bootstrap-4.min.js"></script>
<script>
    $(function () {
        $('#starts_at_picker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            locale: 'ja',
            icons: {
                time: 'far fa-clock'
            }
        });

        $('#expires_at_picker').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            locale: 'ja',
            icons: {
                time: 'far fa-clock'
            }
        });
    });
</script>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.39.0/css/tempusdominus-bootstrap-4.min.css">
@stop
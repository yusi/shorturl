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
                    <label for="url">URL</label>
                    <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url', $event->url) }}">
                    @error('url')
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
@extends('adminlte::page')

@section('title', 'サービス編集')

@section('content_header')
    <h1>サービス編集</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('services.update', $service) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">名前</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $service->name) }}">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>作成日時</label>
                    <input type="text" class="form-control" value="{{ $service->created_at }}" readonly>
                </div>
                <div class="form-group">
                    <label>更新日時</label>
                    <input type="text" class="form-control" value="{{ $service->updated_at }}" readonly>
                </div>
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">更新</button>
                    <a href="{{ route('services.index') }}" class="btn btn-secondary">戻る</a>
                </div>
            </form>
            <form action="{{ route('services.destroy', $service) }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </div>
    </div>
@stop

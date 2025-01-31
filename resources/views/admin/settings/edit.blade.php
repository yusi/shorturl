@extends('adminlte::page')

@section('title', '設定編集')

@section('content_header')
    <h1>設定編集</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('settings.update', $setting) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="key">キー</label>
                    <input type="text" class="form-control" id="key" value="{{ $setting->key }}" readonly>
                </div>
                <div class="form-group">
                    <label for="value">値</label>
                    <textarea class="form-control @error('value') is-invalid @enderror" id="value" name="value" rows="3">{{ old('value', $setting->value) }}</textarea>
                    @error('value')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="comment">コメント</label>
                    <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="3">{{ old('comment', $setting->comment) }}</textarea>
                    @error('comment')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>作成日時</label>
                    <input type="text" class="form-control" value="{{ $setting->created_at }}" readonly>
                </div>
                <div class="form-group">
                    <label>更新日時</label>
                    <input type="text" class="form-control" value="{{ $setting->updated_at }}" readonly>
                </div>
                <button type="submit" class="btn btn-primary">更新</button>
                <a href="{{ route('settings.index') }}" class="btn btn-secondary">戻る</a>
            </form>
            <form action="{{ route('settings.destroy', $setting) }}" method="POST" class="mt-3">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
            </form>
        </div>
    </div>
@stop
@extends('adminlte::page')

@section('title', '設定作成')

@section('content_header')
    <h1>設定作成</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('settings.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="key">キー</label>
                    <select class="form-control @error('key') is-invalid @enderror" id="key" name="key">
                        <option value="">選択してください</option>
                        @foreach($availableKeys as $key => $description)
                            <option value="{{ $key }}" {{ old('key') == $key ? 'selected' : '' }}>
                                {{ $key }} ({{ $description }})
                            </option>
                        @endforeach
                    </select>
                    @error('key')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="value">値</label>
                    <textarea class="form-control @error('value') is-invalid @enderror" id="value" name="value" rows="3">{{ old('value') }}</textarea>
                    @error('value')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="comment">コメント</label>
                    <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment" rows="3">{{ old('comment') }}</textarea>
                    @error('comment')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
                <a href="{{ route('settings.index') }}" class="btn btn-secondary">戻る</a>
            </form>
        </div>
    </div>
@stop
@extends('adminlte::page')

@section('title', 'イベント作成')

@section('content_header')
    <h1>イベント作成</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('events.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="service_id">サービス</label>
                    <select class="form-control @error('service_id') is-invalid @enderror" id="service_id" name="service_id">
                        <option value="">選択してください</option>
                        @foreach($services as $id => $name)
                            <option value="{{ $id }}" {{ old('service_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('service_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="name">名前</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" value="{{ old('url') }}">
                    @error('url')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
                <a href="{{ route('events.index') }}" class="btn btn-secondary">戻る</a>
            </form>
        </div>
    </div>
@stop
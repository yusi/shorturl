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
                <button type="submit" class="btn btn-primary">更新</button>
                <a href="{{ route('services.index') }}" class="btn btn-secondary">戻る</a>
            </form>
        </div>
    </div>
@stop

@extends('adminlte::page')

@section('title', 'サービス作成')

@section('content_header')
    <h1>サービス作成</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('services.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">名前</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">保存</button>
                <a href="{{ route('services.index') }}" class="btn btn-secondary">戻る</a>
            </form>
        </div>
    </div>
@stop

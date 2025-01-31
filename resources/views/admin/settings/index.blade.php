@extends('adminlte::page')

@section('title', '設定一覧')

@section('content_header')
    <h1>設定一覧</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('settings.create') }}" class="btn btn-primary">新規作成</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>キー</th>
                        <th>値</th>
                        <th>コメント</th>
                        <th>作成日時</th>
                        <th>更新日時</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($settings as $setting)
                    <tr>
                        <td><a href="{{ route('settings.edit', $setting) }}">{{ $setting->id }}</a></td>
                        <td>{{ $setting->key }}</td>
                        <td>{{ $setting->value }}</td>
                        <td>{{ $setting->comment }}</td>
                        <td>{{ $setting->created_at }}</td>
                        <td>{{ $setting->updated_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $settings->links() }}
        </div>
    </div>
@stop
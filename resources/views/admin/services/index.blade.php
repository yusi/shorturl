@extends('adminlte::page')

@section('title', 'サービス一覧')

@section('content_header')
    <h1>サービス一覧</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('services.create') }}" class="btn btn-primary">新規作成</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>名前</th>
                        <th>作成日時</th>
                        <th>更新日時</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td><a href="{{ route('services.edit', $service) }}">{{ $service->id }}</a></td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->created_at }}</td>
                        <td>{{ $service->updated_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $services->links() }}
        </div>
    </div>
@stop

@extends('adminlte::page')

@section('title', 'イベント一覧')

@section('content_header')
    <h1>イベント一覧</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('events.create') }}" class="btn btn-primary">新規作成</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>サービス</th>
                        <th>名前</th>
                        <th>URL</th>
                        <th>開始日時</th>
                        <th>有効期限</th>
                        <th>作成日時</th>
                        <th>更新日時</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td><a href="{{ route('events.edit', $event) }}">{{ $event->id }}</a></td>
                        <td>{{ $event->service->name }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->url }}</td>
                        <td>{{ $event->starts_at }}</td>
                        <td>{{ $event->expires_at }}</td>
                        <td>{{ $event->created_at }}</td>
                        <td>{{ $event->updated_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $events->links() }}
        </div>
    </div>
@stop
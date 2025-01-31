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
                        <th>作成日</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->service->name }}</td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->created_at }}</td>
                        <td>
                            <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-info">編集</a>
                            <form action="{{ route('events.destroy', $event) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $events->links() }}
        </div>
    </div>
@stop
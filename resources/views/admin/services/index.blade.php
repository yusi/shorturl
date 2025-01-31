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
                        <th>作成日</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td>{{ $service->id }}</td>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->created_at }}</td>
                        <td>
                            <a href="{{ route('services.edit', $service) }}" class="btn btn-sm btn-info">編集</a>
                            <form action="{{ route('services.destroy', $service) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('本当に削除しますか？')">削除</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $services->links() }}
        </div>
    </div>
@stop

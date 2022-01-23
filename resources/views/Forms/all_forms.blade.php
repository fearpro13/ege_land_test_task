@extends('index')
@extends('Forms.ajax_form')
@extends('Forms.form')
@section('styles')
    <link href="/css/table_styling.css" rel="stylesheet">
@endsection
@section('body')
    <label>
        Пользователи
        <table>
            <thead>
            <tr>
                @foreach(array_keys($users[0] ?? []) as $userColName)
                    <td>
                        {{ $userColName }}
                    </td>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($users ?? [] as $user)
                <tr>
                    @foreach ($user as $userInfoCol)
                        <td>{{ $userInfoCol }}</td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </label>
@endsection

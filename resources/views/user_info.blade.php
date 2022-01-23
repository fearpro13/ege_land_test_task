@extends('index')
@section('styles')
    @parent
    <link href="/css/table_styling.css" rel="stylesheet">
@endsection
@section('body')
    @parent
    <label>
        Пользователь
        <table>
            <thead>
            <tr>
                @foreach(array_keys($userInfoCols) as $userColName)
                    <td>
                        {{ $userColName }}
                    </td>
                @endforeach
            </tr>
            </thead>
            <tbody>
            <tr>
                @foreach ($userInfoCols as $userInfoCol)
                    <td>{{ $userInfoCol }}</td>
                @endforeach
            </tr>
            </tbody>
        </table>
    </label>
    <label>
        Тесты Пользователя
        <table>
            <thead>
            <tr>
                @foreach(array_keys($tests[0] ?? []) as $testColName)
                    <td>
                        {{ $testColName }}
                    </td>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($tests as $testRow)
                <tr>
                    @foreach($testRow as $paramName => $paramValue)
                        <td>
                            {{ $paramValue }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </label>
    <label>
        Курсы Пользователя
        <table>
            <thead>
            <tr>
                @foreach(array_keys($courses[0] ?? []) as $courseColName)
                    <td>
                        {{ $courseColName }}
                    </td>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($courses as $courseRow)
                <tr>
                    @foreach($courseRow as $courseName => $courseValue)
                        <td>
                            {{ $courseValue }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>

        </table>
    </label>
    <label>
        Настройки пользователя
        <table>
            <thead>
            <tr>
                @foreach(array_keys($settings[0] ?? []) as $settingColName)
                    <td>
                        {{ $settingColName }}
                    </td>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($settings as $settingRow)
                <tr>
                    @foreach($settingRow as $settingName => $settingValue)
                        <td>
                            {{ $settingValue }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
            </tbody>
        </table>
    </label>
@endsection


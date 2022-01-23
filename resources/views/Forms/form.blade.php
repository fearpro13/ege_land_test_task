<form action="{{ url('/user/save') }}" method="POST" name="post_form">
    @csrf
    <label>
        Имя
        <input type="text" name="name"/>
    </label>
    <label>
        Фамилия
        <input type="text" name="last_name"/>
    </label>
    <label>
        Почта
        <input type="text" name="email"/>
    </label>
    <input type="submit" value="Создать via POST FormData">
</form>
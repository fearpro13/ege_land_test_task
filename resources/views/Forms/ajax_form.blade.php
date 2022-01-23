@extends('Forms.form')
@section('scripts')
    <script>
        let form = document.querySelectorAll('form[name="post_form"]')[1]

        document.querySelectorAll('form[name="post_form"] > input[type="submit"]')[1].remove()

        let ajaxButton = document.createElement('input')
        ajaxButton.type = 'button'
        ajaxButton.value = 'Создать via Ajax request'
        ajaxButton.onclick = (event) => {
            let ajaxForm = new FormData(form)
            let uri = `{{{ url('/user/save') }}}`

            fetch(uri, {
                body: ajaxForm,
                method: "POST"
            })
        }

        form.appendChild(ajaxButton)
    </script>
@endsection
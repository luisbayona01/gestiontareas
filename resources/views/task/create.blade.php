@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Task
@endsection

@section('content')

<div class="alert alert-success m-4 d-none" id="msg">
                            <p class="mensage"></p>
                        </div>
        <div class="alert alert-danger m-4 d-none" id="msg-error">
                            <p class="mensage-error"></p>
    </div>                     
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Task</span>
                    </div>
                    <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('tasks.index') }}"> {{ __('Back') }}</a>
                        </div>
                    <div class="card-body bg-white">
                        <form  id="createTarea" class="needs-validation" novalidate>
                           
                  
                            @include('task.form')
  
                            <div class="col-md-12 mt20 mt-2">
                    <button type="button" class="btn btn-primary" id="savetask">{{ __('Guardar tarea') }}
                    <span class="spinner-border spinner-border-sm mr-2" style="display:none;text-align:center" id="loading2"></span>

                    
                    </button>
    </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
    
$("#savetask").on('click',function(){
    $("#loading2").show();
    let isValid = document.querySelector('#createTarea').reportValidity();

            if (isValid == false) {
                $('#createTarea').addClass('was-validated');
                $("#loading2").hide();
                return  false
            } 

    let dueDateInput = document.getElementById('due_date');
    let  dueDateError = document.getElementById('due_date_error');
    let dueDateValue = dueDateInput.value;
    let  isValidDate = !isNaN(Date.parse(dueDateValue));

    if (isValidDate) {
        // Si la fecha es válida, limpia el mensaje de error
        dueDateError.style.display = 'none';
    } else {
        // Si la fecha no es válida, muestra el mensaje de error
        console.log(dueDateValue);
        dueDateError.style.display = 'inline';
        $("#loading2").hide();
        return  false
    }

            var datosFormulario = new FormData(document.querySelector('#createTarea'));

                fetch("{{ route('tasks.store') }}", {
                    method: 'POST',
                    body: datosFormulario,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errorData => { throw new Error(errorData.message); });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.ok === false) {
                       $(".mensage-error").html(data.message); 
                       $("#msg-error").removeClass('d-none');  
                        console.error('Error:', data.message);
                    } else {

                        
                        $(".mensage").html(data.message); 
                        $("#msg").removeClass('d-none');
                        console.log('Tarea creada:', data.message);
                    }
                    $("#loading2").hide();
                })
                .catch(error => {
                    console.error('There was a problem with the fetch operation:', error);
                    $("#loading2").hide();
                });

})


</script>

@endsection

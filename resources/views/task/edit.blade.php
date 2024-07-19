@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Task
@endsection

@section('content')
<div class="alert alert-success m-4 d-none" id="msg">
                            <p class="mensage"></p>
                        </div>
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Task</span>
                    </div>
                    <div class="card-body bg-white">
                        <form method="POST"  role="form" enctype="multipart/form-data"  id="edittarea" class="needs-validation" novalidate>
                            {{ method_field('PATCH') }}
                          

                            @include('task.form')

                            
                            <div class="col-md-12 mt20 mt-2">
        <button type="button" class="btn btn-primary" id="UpdateTask">{{ __('modificara tarea') }}</button>
    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
    
    $("#UpdateTask").on('click',function(){
        $("#loading2").show();
        let isValid = document.querySelector('#edittarea').reportValidity();
    
                if (isValid == false) {
                    $('#edittarea').addClass('was-validated');
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
    
                var datosFormulario = new FormData(document.querySelector('#edittarea'));
    
                    fetch("{{ route('tasks.update', $task->id) }}", {
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

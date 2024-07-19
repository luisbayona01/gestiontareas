<div class="row padding-1 p-1">
    <div class="col-md-12">
        
       
        <div class="form-group mb-2 mb20">
            <label for="title" class="form-label">{{ __('Título') }}</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $task?->title) }}" id="title" placeholder="Título" required>
            <div class="invalid-feedback" role="alert"><strong> el  campo Título es obligatorio</strong></div>
        </div>
        <div class="form-group mb-2 mb20">
            <label for="description" class="form-label">{{ __('Descripción') }}</label>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="description" placeholder="Descripcion" required>{{ old('description', $task?->description) }}</textarea>
            <div class="invalid-feedback" role="alert"><strong> el  campo Descripción es obligatorio</strong></div>
        </div>
        <input type="hidden"  name="user_id" value="{{ Auth::user()->id}}">
        <div class="form-group mb-2 mb20">
            <label for="status" class="form-label">{{ __('Estado') }}</label>
        
            
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
            <option value="">Seleccione un estado</option>    
            <option value="pendiente" {{ old('status', $task?->status) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="en progreso" {{ old('status', $task?->status) == 'en progreso' ? 'selected' : '' }}>En progreso</option>
            <option value="completada" {{ old('status', $task?->status) == 'completada' ? 'selected' : '' }}>Completada</option>
            </select>
            <div class="invalid-feedback" role="alert"><strong> el  campo estado es obligatorio</strong></div>
        </div>
        <div class="form-group mb-2 mb20">
            <label for="due_date" class="form-label">{{ __('Fecha límite') }}</label>
            <input type="text" name="due_date" class="form-control @error('due_date') is-invalid @enderror" value="{{ old('due_date', $task?->due_date) }}" id="due_date" placeholder="fecha límite" required>
          
            <span id="due_date_error" style="color: red; display: none;">Por favor, ingrese una fecha válida.</span>
            <div class="invalid-feedback" role="alert"><strong> el  campo Fecha límite es obligatorio</strong></div>
        </div>

    </div>


</div>


<script>
$("#due_date").datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd' 
        });

  
</script>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-flex justify-content-between">
            ✏️ Editar Documento
            <a href="{{ route('documents.index') }}" class="btn btn-sm btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Volver
            </a>
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card shadow-lg rounded-3">
                    <div class="card-header text-center bg-warning text-white">
                        <h4 class="m-0">Editar Documento</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('documents.update', $filename) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-2">
                                <label for="name" class="form-label">Nombre del Documento</label>
                                <input type="text" name="name" class="form-control rounded fw-bold text-center" id="name" required readonly value="{{ $document[0]['name'] ?? '' }}" maxlength="50">
                            </div>

                            <div id="dynamic-fields">
                                @foreach($document as $index => $detail)
                                <div class="dynamic-field mb-2" data-index="{{ $index }}">
                                    <div class="rounded pb-1 border border-info p-2">
                                        <label class="form-label">Título</label>
                                        <input type="text" name="title[]" class="form-control rounded" required value="{{ $detail['title'] }}">

                                        <label class="form-label">Descripción</label>
                                        <input type="text" name="description[]" class="form-control rounded" required value="{{ $detail['description'] }}">

                                        <label class="form-label">Código</label>
                                        <textarea name="code[]" class="form-control" required rows="2">{{ $detail['code'] }}</textarea>

                                        <label class="form-label">Nota <span class="small text-muted">(Opcional)</span></label>
                                        <input type="text" name="note[]" class="form-control rounded" value="{{ $detail['note'] }}">

                                        <button type="button" class="btn btn-info btn-sm mt-2 remove-field text-white">Quitar</button>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-sm btn-primary" id="add-field-btn"><i class="bi bi-plus-circle"></i> Añadir Campos</button>
                            </div>

                            <div class="d-flex justify-content-between d-grid gap-2 mt-3">
                                <a href="{{ route('documents.index') }}" class=" btn btn-danger"><i class="bi bi-arrow-left-circle"></i> Cancelar</a>
                                <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Guardar Cambios</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-field-btn').addEventListener('click', function() {
            const container = document.getElementById('dynamic-fields');
            const newIndex = document.querySelectorAll('.dynamic-field').length;
            const newField = document.createElement('div');
            newField.classList.add('dynamic-field', 'mb-2');
            newField.dataset.index = newIndex;

            newField.innerHTML = `
                <div class="rounded pb-1 border border-info p-2">
                
                <label class="form-label">Título</label>
                <input type="text" name="title[]" class="form-control rounded" required placeholder="Ingresa el título del documento">

                <label class="form-label">Descripción</label>
                <input type="text" name="description[]" class="form-control rounded" required placeholder="Escribe una breve descripción del documento">

                <label class="form-label">Código</label>
                <textarea name="code[]" class="form-control" required rows="2" placeholder="Ingresa el código relacionado al documento"></textarea>

                <label class="form-label">Nota <span class="small text-muted">(Opcional)</span></label>
                <input type="text" name="note[]" class="form-control rounded" placeholder="Escribe una nota opcional">

                <button type="button" class="btn btn-info btn-sm mt-2 remove-field text-white">Quitar</button>
                
                </div>
            `;

            container.appendChild(newField);
        });

        document.getElementById('dynamic-fields').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-field')) {
                event.target.closest('.dynamic-field').remove();
            }
        });
    </script>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-flex justify-content-between">
            📝 Nueva Documentación
            <a href="/dashboard" class="btn btn-sm btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Dashboard
            </a>
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card shadow-lg rounded-3">
                    <div class="card-header text-center bg-primary text-white">
                        <h4 class="m-0">Nuevo Documento</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('documents.store') }}" method="POST">
                            @csrf

                            <div class="mb-2">
                                <label for="name" class="form-label">Nombre del Documento</label>
                                <input type="text" name="name" class="form-control rounded" id="name" required placeholder="Ingresa el nombre del documento" maxlength="50">
                            </div>

                            <div id="dynamic-fields">
                                <div class="dynamic-field-container rounded mb-2 pb-1 border border-info p-2">
                                    <div class="dynamic-field mb-2">
                                        <label for="title" class="form-label">Título</label>
                                        <input type="text" name="title[]" class="form-control rounded" required placeholder="Ingresa el título del documento">
                                    </div>
                                    <div class="dynamic-field mb-2">
                                        <label for="description" class="form-label">Descripción</label>
                                        <input type="text" name="description[]" class="form-control rounded" required placeholder="Escribe una breve descripción del documento">
                                    </div>
                                    <div class="dynamic-field mb-2">
                                        <label for="code" class="form-label">Código</label>
                                        <textarea name="code[]" class="form-control" required rows="2" placeholder="Ingresa el código relacionado al documento"></textarea>
                                    </div>
                                    <div class="dynamic-field mb-2">
                                        <label for="note" class="form-label">Nota <span class="small text-muted">(Opcional)</span></label>
                                        <input type="text" name="note[]" class="form-control rounded" placeholder="Escribe una nota opcional">
                                    </div>
                                    <button type="button" class="btn btn-info btn-sm text-white remove-field">Quitar</button>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-sm btn-primary" id="add-field-btn"><i class="bi bi-plus-circle"></i> Añadir Campos</button>
                            </div>

                            <div class="d-flex justify-content-between d-grid gap-2 mt-3">
                                <a href="/dashboard" class="btn btn-danger"><i class="bi bi-arrow-left-circle"></i> Cancelar</a>
                                <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Guardar</button>
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
            const newField = document.createElement('div');
            newField.classList.add('dynamic-field-container', 'rounded', 'mb-2', 'pb-1', 'border', 'border-info', 'p-2');

            newField.innerHTML = `
                <div class="dynamic-field mb-2">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" name="title[]" class="form-control rounded" required placeholder="Ingresa el título del documento">
                </div>
                <div class="dynamic-field mb-2">
                    <label for="description" class="form-label">Descripción</label>
                    <input type="text" name="description[]" class="form-control rounded" required placeholder="Escribe una breve descripción del documento">
                </div>
                <div class="dynamic-field mb-2">
                    <label for="code" class="form-label">Código</label>
                    <textarea name="code[]" class="form-control" required rows="2" placeholder="Ingresa el código relacionado al documento"></textarea>
                </div>
                <div class="dynamic-field mb-2">
                    <label for="note" class="form-label">Nota <span class="small text-muted">(Opcional)</span></label>
                    <input type="text" name="note[]" class="form-control rounded" placeholder="Escribe una nota opcional">
                </div>
                <button type="button" class="btn btn-info btn-sm remove-field text-white">Quitar</button>
            `;

            container.appendChild(newField);
        });

        document.getElementById('dynamic-fields').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-field') || event.target.closest('.remove-field')) {
                event.target.closest('.dynamic-field-container').remove();
            }
        });
    </script>
</x-app-layout>
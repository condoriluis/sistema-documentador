<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📊 Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="row">
                        <div class="col-12 text-center mb-4">
                            <h4 class="display-5 font-weight-bold text-primary">Bienvenido al dashboard</h4>
                            <p class="lead text-muted">Administra tus documentos y recursos fácilmente desde aquí.</p>
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <div class="card shadow-sm border-primary">
                                <div class="card-body text-center">
                                    <i class="bi bi-file-earmark-plus fs-1 text-primary mb-3"></i>
                                    <h5 class="card-title">Crear Nuevo Documento</h5>
                                    <p class="card-text">Haz clic en el botón para documentar ahora y generar tu archivo.</p>
                                    <a href="{{ route('documents.create') }}" class="btn btn-lg btn-primary rounded-pill my-2">
                                        <i class="bi bi-pencil-square"></i> Documentar Ahora
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <div class="card shadow-sm border-info">
                                <div class="card-body text-center">
                                    <i class="bi bi-folder2-open fs-1 text-info mb-3"></i>
                                    <h5 class="card-title">Gestionar Documentos</h5>
                                    <p class="card-text">Accede y organiza todos los documentos que has generado.</p>
                                    <a href="{{ route('documents.index') }}" class="btn btn-lg btn-info rounded-pill text-white my-2">
                                        <i class="bi bi-folder"></i> Ver Documentos
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
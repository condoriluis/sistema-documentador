<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight d-flex justify-content-between">
            {{ __('📂 Documentos Disponibles') }}
            <a href="/dashboard" class="btn btn-sm btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Dashboard
            </a>
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="d-flex justify-content-between mb-3">
                    <a href="{{ route('documents.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Nuevo Documento
                    </a>

                    <input type="text" id="searchInput" class="form-control w-50 rounded" placeholder="🔍 Buscar documento...">
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre del Archivo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="documentTable">
                            @forelse($paginatedDocuments as $doc)
                            <tr>
                                <td>{{ $doc['filename'] }}</td>
                                <td>
                                    <a href="{{ route('documents.show', $doc['filename']) }}" target="_blank" class="btn btn-sm btn-primary">👀 Ver</a>
                                    <a href="{{ route('documents.download', $doc['filename']) }}" class="btn btn-sm btn-info text-white">⬇️ Descargar</a>
                                    <a href="{{ route('documents.edit', $doc['filename']) }}" class="btn btn-sm btn-warning">✏️ Editar</a>
                                    <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $doc['filename'] }}">
                                        <i class="bi bi-trash3-fill"></i> Eliminar
                                    </button>
                                    <form id="delete-form-{{ $doc['filename'] }}" action="{{ route('documents.destroy', $doc['filename']) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2" class="text-center">No hay documentos disponibles.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $paginatedDocuments->links() }}
                </div>

            </div>
        </div>
    </div>

    <script>
        document.getElementById("searchInput").addEventListener("keyup", function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#documentTable tr");

            rows.forEach(row => {
                let filename = row.cells[0]?.textContent.toLowerCase();
                row.style.display = filename.includes(filter) ? "" : "none";
            });
        });

        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                let docId = this.getAttribute("data-id");
                let form = document.getElementById(`delete-form-${docId}`);

                Swal.fire({
                    title: '¿Eliminar este documento?',
                    text: "No podrás revertir esta acción.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminarlo',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>
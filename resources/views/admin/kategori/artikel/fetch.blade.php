<table class="table table-lg">
    <thead>
        <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Opsi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($data['kategoriArtikel'] as $item)
            <tr>
                <td>{{ ($data['kategoriArtikel']->currentpage() - 1) * $data['kategoriArtikel']->perpage() + $loop->index + 1 }}
                </td>
                <td>{!! $item->nama !!}</td>
                <td>
                    <div class="btn-group">
                        <button onclick="showModal(`{{ route('admin.kategori-artikel.edit', $item->id) }}`)"
                            data-bs-toggle="tooltip" title="Ubah" data-bs-placement="top" data-bs-original-title="Ubah"
                            class="btn btn-outline-success">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td></td>
                <td>Data tidak ada</td>
                <td></td>
            </tr>
        @endforelse
    </tbody>
    <input type="hidden" name="page" value="1" />
</table>
@if ($data['kategoriArtikel']->hasPages())
    <tfoot>
        {{ $data['kategoriArtikel']->links('components.pagination-admin') }}
    </tfoot>
@endif

<div class="row mb-5 pb-5">
        <div class="col-md-8">
            <span class="notes-block-span-name font-weight-bold "><strong>{{ $note->user->name ?? 'None'}}</strong></span>
            <span class="notes-block-span-last-name font-weight-bold px-3 ">{{ $note->user->last_name ?? '' }}</span>
            <span class="notes-block-span-date text-primary ">{{  $note->updated_at->format('d-m-Y') }}</span>
            <span class="notes-block-span-date text-warning ">{{  $note->updated_at->format('H:i') }}</span>
        </div>


        <div class="col-md-2">
            {{-- <button class="notes-block-update btn text-primary"  data-toggle="modal" data-target="#exampleModal_{{ $note->id }}"><i class="bi bi-pencil text-primary"></i>Upravit</button> --}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop_{{ $note->id }}">
                <i class="bi bi-pencil me-2"></i>Редагувати
            </button>
        </div>
        <form class="col-md-2" action="{{ route('admin.notes.delete', $note) }}" method="POST"
        onsubmit="if(!confirm('Видалити?')) return false">
        @csrf
        @method('DELETE')
        <button class="btn text-danger"><i class="bi bi-trash text-danger me-2"></i>Видалити</button>
        </form>

    <div class="col-md-12">
        <span class="notes-block-span-text ">{{ $note->note }}</span>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal_{{ $note->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form class="modal-content" action="{{ route('admin.notes.update', $note) }}" method="POST">
          @csrf
          @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <textarea class="form-control" name="note" id="" cols="30" rows="10">{{ $note->note }}</textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="sumbit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="staticBackdrop_{{ $note->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('admin.notes.update', $note) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5> --}}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea class="form-control" name="note" id="" cols="30" rows="10">{{ $note->note }}</textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрити</button>
                <button type="submit" class="btn btn-primary">Підтвердити</button>
            </div>
        </form>
    </div>
</div>

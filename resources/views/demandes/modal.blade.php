<div class="modal fade" id="chauffeurModal" tabindex="-1" role="dialog" aria-labelledby="chauffeurModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="chauffeurModalLabel">Liste des chauffeurs disponibles</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul>
                    @foreach($chauffeurs as $chauffeur)
                        @if($chauffeur->condition)
                            <li>{{ $chauffeur->nom }} {{ $chauffeur->prenom }} ({{ $chauffeur->tel }})</li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

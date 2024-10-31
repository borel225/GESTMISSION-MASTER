
$(document).ready(function () {
    // Fonction pour désactiver les checkboxes des agents déjà sélectionnés
    function updateCheckboxState() {
        // Récupérer les IDs des agents déjà sélectionnés
        const selectedIds = $('#participantsList li').map(function() {
            return $(this).data('id').toString();
        }).get();

        // Mettre à jour l'état des checkboxes
        $('input[type="checkbox"]').each(function() {
            if (selectedIds.includes($(this).val())) {
                $(this).prop('disabled', true);
                $(this).prop('checked', false);
            } else {
                $(this).prop('disabled', false);
            }
        });
    }

    // Lors de l'ouverture du modal
    $('#agentsModal').on('show.bs.modal', function () {
        updateCheckboxState();
    });

    $('#saveAgents').click(function () {
        let selectedAgents = [];
        $('input[type="checkbox"]:checked').each(function () {
            const agentId = $(this).val();
            const agentName = $(this).next().text();

            // Vérifier si l'agent n'est pas déjà dans la liste
            if (!$(`#participantsList li[data-id="${agentId}"]`).length) {
                selectedAgents.push(agentId);
                $('#participantsList').append(`
                    <li class="list-group-item" data-id="${agentId}">
                        ${agentName}
                        <button type="button" class="btn btn-sm btn-danger float-end" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </li>
                `);
            }
        });

        // Mettre à jour le champ caché avec les identifiants des participants
        let currentParticipants = $('#participants').val();
        let existingIds = currentParticipants ? currentParticipants.split(',') : [];
        let allParticipants = [...new Set([...existingIds, ...selectedAgents])];
        $('#participants').val(allParticipants.join(','));

        // Réinitialiser les cases à cocher et fermer le modal
        $('input[type="checkbox"]:checked').prop('checked', false);
        $('#agentsModal').modal('hide');
    });

    // Gestion de la suppression d'un participant
    $('#participantsList').on('click', 'button', function () {
        $(this).closest('li').remove();
        let remainingAgents = $('#participantsList').find('li').map(function () {
            return $(this).data('id');
        }).get().join(',');
        $('#participants').val(remainingAgents);

        // Mettre à jour l'état des checkboxes après la suppression
        updateCheckboxState();
    });
});

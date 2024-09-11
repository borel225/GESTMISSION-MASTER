

$(document).ready(function () {


    $('#saveAgents').click(function () {
        let selectedAgents = [];
        $('input[type="checkbox"]:checked').each(function () {
            selectedAgents.push($(this).val());
            $('#participantsList').append(`<li class="list-group-item" data-id="${$(this).val()}">${$(this).next().text()} <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button></li>`);
        });

        // Mettre à jour le champ caché avec les identifiants des participants
        $('#participants').val(selectedAgents.join(','));

        // Réinitialiser les cases à cocher et fermer le modal
        $('input[type="checkbox"]:checked').prop('checked', false);

        // Fermer le modal
        $('#agentsModal').modal('hide');


    });

    $('#participantsList').on('click', 'button.close', function () {
        $(this).closest('li').remove();
        let remainingAgents = $('#participantsList').find('li').map(function () {
            return $(this).data('id');
        }).get().join(',');
        $('#participants').val(remainingAgents);
    });
});

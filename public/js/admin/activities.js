$(document).ready(function () {
    const contextModal = $('#contextModal');

    if (contextModal.length) {
        contextModal.on('show.bs.modal', function (event) {
            const button = $(event.relatedTarget);
            const contextRawTarget = $(button).attr('data-context-raw');

            const contextRaw = $(contextRawTarget).text();

            const context = JSON.parse(contextRaw);

            $('#contextModal .modal-body pre code').text(JSON.stringify(context, null, 2));
        });
    }
});

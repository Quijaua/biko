'use strict';

(function () {

    const inputParaSelectFunction = function (event) {
        const divAluno = $('#divAluno');
        const values = $(this).val();

        if (event.params.data.id === 'null') {
            $(this).val('null').trigger('change');
            divAluno.addClass('d-none');
            return;
        }

        if (values.includes('null')) {
            $(this).val(event.params.data.id).trigger('change');
        }

        divAluno.removeClass('d-none');
    };

    $('#inputPara').select2().on('select2:select', inputParaSelectFunction);

})();
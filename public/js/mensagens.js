'use strict';

(function () {

    const clearInputNull = function (event) {
        const values = $(this).val();

        if (event.params.data.id === 'null') {
            $(this).val('null').trigger('change');
            return;
        }

        if (values.includes('null')) {
            $(this).val(event.params.data.id).trigger('change');
        }
    };

    const inputParaNucleoSelectFunction = function (event) {
        const divAluno = $('#divAluno');

        if (event.params.data.id === 'null') {
            divAluno.addClass('d-none');
            return;
        }

        divAluno.removeClass('d-none');
    };

    $('#inputParaNucleo').select2()
        .on('select2:select', inputParaNucleoSelectFunction)
        .on('select2:select', clearInputNull);

    $("#inputParaAluno").select2({
        width: '100%',
        minimumInputLength: 2,
        ajax: {
            url: '/api/alunos/nucleo/search',
            dataType: 'json',
            type: 'POST',
            quietMillis: 50,
            data: function (aluno) {
                return {
                    nucleos: $('#inputParaNucleo').val(),
                    aluno: aluno.term,
                };
            },
            processResults: function (data) {
                const todos = [{
                    text: 'Todos os alunos',
                    id: 'null',
                }];

                const alunos = $.map(data, function (aluno) {
                    return {
                        text: aluno.NomeAluno,
                        slug: aluno.NomeAluno,
                        id: aluno.id
                    }
                });

                return {results: $.merge(todos, alunos)};
            }
        }
    }).on('select2:select', clearInputNull);

    const editor = new Quill('#editor', {
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                ['blockquote', 'code-block'],

                [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                [{ 'direction': 'rtl' }],                         // text direction

                [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                [{ 'font': [] }],
                [{ 'align': [] }],

                ['clean']                                         // remove formatting button
            ],
        },
        theme: 'snow'
    });

})();
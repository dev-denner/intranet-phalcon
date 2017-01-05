{{ content() }}
<table class="table table-bordered table-condensed">
    <caption><h2 style="text-align: center">Coleta de Informações para Rescisão Contratual</h2></caption>
    <thead>
        <tr><th colspan="2" style="text-align: center">Clique no link para abrir o arquivo no navegador.</th></tr>
    </thead>
    <tbody>
        <tr>
            <td style="padding: 10px; text-align: center;">Lote {{ sequence }}</td>
            <td style="padding: 10px; text-align: center;">{{ link_to('downloads/coleta_rescisao/'~link, 'Click Aqui') }}</td>
        </tr>
    </tbody>
</table>
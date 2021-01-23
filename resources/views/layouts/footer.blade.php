<script src="//cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>

<script>
    $('#tablas').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No existe registros",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No registros disponibles",
            "infoFiltered": "(Mostrando de _MAX_ registros totales)",
            "search": "Buscar",
            "paginate": {
                'next': "Siguiente",
                'previous': "Anterior"
            }
        }
    });
</script>

<script>
    @if (session()->has('success'))
        Swal.fire(
        '{{session()->get('success')}}',
        '',
        'success'
        )
    @endif
    @if (session()->has('no-success'))
        Swal.fire(
        '{{session()->get('no-success')}}',
        '',
        'danger'
        )
    @endif
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
        crossorigin="anonymous"></script>

<script>
    $(".months").click(function () {
        console.warn()
        $('.name_months').text($(this).text())

    });
</script>




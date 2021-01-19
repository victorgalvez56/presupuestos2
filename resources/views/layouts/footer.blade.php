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
    $(function () {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        Toast.fire({
            icon: 'success',
            title: ' {{ session()->get('success') }}'
        })
    });
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
<script>
    $(document).on("click", "#delete_row_budgets", function () {
        $(this).closest("tr").remove();
    });
    $(document).on("click", "#add_row_budgets", function () {
        html = "<tr class='row_add'>";
        html += "<td>" + " <select name='month_id[]' class='form-control' required><option value=''>Seleccione mes</option>@foreach($months as $month)<option value='{{$month->id}}'>{{$month->name}}</option>@endforeach</select></td>";
        html += "<td>" + "  <input type='number'  name='quantity[]' class='form-control quantity' value=''   placeholder='Ingrese cantidad' step='0.01' required></td>";
        html += "<td>" + " <textarea type='text' name='description[]' class='form-control' value='' placeholder='Ingrese descripción' required></textarea></td>";
        html += "<td>" + " <select name='batch_id[]' class='form-control' required>  value=''  <option value=''>Seleccione área</option> @foreach($batchs as $batch)<option value='{{$batch['id']}}'>{{$batch['name']}}</option> @endforeach</select></td>";
        html += "<td>" + "<input type='text' name='unit_price[]' class='form-control unit_price' value='' placeholder='S/. 00.00' step='0.01' required></td>";
        html += "<td>" + "<input type='text' name='total_soles[]' class='form-control' value='' placeholder='S/. 00.00' step='0.01' required readonly></td>";
        html += "<td>" + "<input type='text' name='total_dollars[]' class='form-control' value='' placeholder='$. 00.00'  step='0.01' required readonly></td>";
        html += "<td>" + " <button class='btn btn-danger' id='delete_row_budgets'><span class='fas fa-minus'></span></button></td>";
        html += "</tr>";
        $("#table_add_budgets tbody").append(html);
    });
    $(document).on("keyup change", "#table_add_budgets input.quantity", function () {
        price_dollars = $("#price_dollar").val();
        quantity = $(this).val();
        unit_price = $(this).closest("tr").find("td:eq(4)").children("input").val();
        total_soles = quantity * unit_price;
        total_dollar = total_soles * price_dollars;
        $(this).closest("tr").find("td:eq(5)").children("input").val(total_soles.toFixed(2));
        $(this).closest("tr").find("td:eq(6)").children("input").val(total_dollar.toFixed(2));
    });
    $(document).on("keyup change", "#table_add_budgets input.unit_price", function () {
        price_dollars = $("#price_dollar").val();
        quantity = $(this).closest("tr").find("td:eq(1)").children("input").val();
        unit_price = $(this).val();
        total_soles = quantity * unit_price;
        total_dollar = total_soles * price_dollars;
        $(this).closest("tr").find("td:eq(5)").children("input").val(total_soles.toFixed(2));
        $(this).closest("tr").find("td:eq(6)").children("input").val(total_dollar.toFixed(2));
    });
    $(document).on("keyup change", "#price_dollar", function () {
        price_dollar = $(this).val()
        $('#table_add_budgets tbody tr').each(function (i, el) {
            price_dollar_new = price_dollar * $(this).find("td:eq(5)").children("input").val();
            $(this).find("td:eq(6)").children("input").val(price_dollar_new.toFixed(2))
        });
    });
</script>



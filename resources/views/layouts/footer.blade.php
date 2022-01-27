<!-- Core Vendors JS -->
<script src="{{ asset('/assets/js/vendors.min.js') }}"></script>

<!-- page js -->
{{-- <script src="{{ asset('') }}/assets/vendors/chartjs/Chart.min.js"></script> --}}
<script src="{{ asset('/assets/js/pages/dashboard-default.js') }}"></script>
<!-- page css -->
<link href="{{ asset('/assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">

<!-- page js -->
<script src="{{ asset('assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/assets/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>

<!-- Core JS -->
<script src="{{ asset('/assets/js/app.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.5/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">
    $('#data-table').DataTable();

    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
    $('#no_hp').on('keyup', function() {
        var no_hp = $(this).val();
        if (no_hp.length >= 2) {
            if (no_hp.substr(0, 3) == '620') {
                var phone = no_hp.replace('0', '');
                $('#no_hp').val(phone);
                console.log(no_hp);
            } else if (no_hp.substr(0, 2) == '62') {
                $('#no_hp').val(no_hp);
                console.log(no_hp);
            } else {
                var phone = "62" + no_hp.replace('0', '');
                $('#no_hp').val(phone);
                console.log(no_hp);
            }
        }
    })

</script>

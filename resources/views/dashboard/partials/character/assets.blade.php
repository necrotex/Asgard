<div class="mt-3">

    <table class="table table-striped" id="asset-table">
        <thead>
        <tr>
            <th scope="col">Type</th>
            <th scope="col">Group</th>
            <th scope="col">Location</th>
            <th scope="col">Amount</th>
            <th scope="col">Volume</th>
            <th scope="col">Packaged</th>
        </tr>
        </thead>
    </table>

</div>

@push('js')
    <script>
        $(document).ready(function(){
            $(function() {

                var table = $('#asset-table').DataTable({
                    lengthMenu: [[10, 50, 100, -1], [10, 50, 100, "All"]],
                    processing: true,
                    serverSide: true,
                    select: {
                        items: 'row'
                    },
                    autoWidth: false,
                    ajax: '{!! route('character.assets', $character) !!}',
                    columns: [
                        { data: 'type_name', name: 'type_name' },
                        { data: 'group', name: 'group' },
                        { data: 'location_name', name: 'location_name'},
                        { data: 'quantity', name: 'quantity' },
                        { data: 'packaged', name: 'packaged' },
                        { data: 'volume', name: 'volume' }
                    ]
                });
            });
        });

    </script>
@endpush
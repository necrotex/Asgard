<div class="mt-3">

    <table class="table table-striped" id="asset-table">
        <thead>
        <tr>
            <th scope="col">Type</th>
            <th scope="col">Location</th>
            <th scope="col">Amount</th>
        </tr>
        </thead>
    </table>

</div>

@push('js')
    <script>
        $(document).ready(function(){
            $(function() {

                var table = $('#asset-table').DataTable({
                    processing: true,
                    serverSide: true,
                    select: {
                        items: 'row'
                    },
                    autoWidth: false,
                    ajax: '{!! route('character.assets', $character) !!}',
                    columns: [
                        { data: 'type_name', name: 'type.typeName' },
                        { data: 'location_name', name: 'character_assets.location_name' },
                        { data: 'quantity', name: 'character_assets.quantity' }
                    ]

                });
            });
        });

    </script>
@endpush
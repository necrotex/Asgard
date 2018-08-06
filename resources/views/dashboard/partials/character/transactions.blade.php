<div class="mt-3">

    <table class="table table-striped" id="transactions-table">
        <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">Type</th>
            <th scope="col">Group</th>
            <th scope="col">Amount</th>
            <th scope="col">Price</th>
            <th scope="col">Total</th>
            <th scope="col">Buy/Sell</th>
        </tr>
        </thead>
    </table>

</div>

<div class="modal fade" id="transaction-modal" tabindex="-1" role="dialog" aria-labelledby="transaction-modal-subject" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
@push('js')
    <script>
        $(document).ready(function(){
            $(function() {

                var table = $('#transactions-table').DataTable({
                    lengthMenu: [[10, 50, 100, -1], [10, 50, 100, "All"]],
                    processing: true,
                    serverSide: true,
                    select: {
                        items: 'row'
                    },
                    autoWidth: false,
                    ajax: '{!! route('character.transactions', $character) !!}',
                    columns: [
                        { data: 'date', name: 'date' },
                        { data: 'type_name', name: 'type_name' },
                        { data: 'group_name', name: 'group_name' },
                        { data: 'quantity', name: 'quantity' },
                        { data: 'unit_price', name: 'unit_price' },
                        { data: 'total_price', name: 'total_price' },
                        { data: 'action_type', name: 'action_type' }
                    ]
                });

            });
        });

    </script>
@endpush
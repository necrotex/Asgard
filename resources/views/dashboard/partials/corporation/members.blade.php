<div class="mt-3">

    <table class="table table-striped" id="{{$table}}-table">
        <thead>
        <tr>
            <th scope="col">Name</th>
        </tr>
        </thead>
    </table>

</div>

@push('js')
    <script>
        $(document).ready(function(){
            $(function() {

                var table = $('#{{$table}}-table').DataTable({
                    lengthMenu: [[10, 50, 100, -1], [10, 50, 100, "All"]],
                    processing: true,
                    serverSide: true,
                    select: {
                        items: 'row'
                    },
                    autoWidth: false,
                    ajax: '{!! route($route, $corporation) !!}',
                    columns: [
                        {data: 'name', name: 'name',
                            fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                                if(oData.route) {
                                    $(nTd).html("<a href="+oData.route+">"+oData.name+"</a>");
                                }
                            }
                        }
                    ]
                });
            });
        });

    </script>
@endpush
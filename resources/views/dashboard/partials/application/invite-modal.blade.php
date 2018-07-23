<div class="modal fade" id="inviteModal" tabindex="-1" role="dialog" aria-labelledby="inviteModalTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inviteModalTitle">Application Invite</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="form">Application Form</label>
                    <select id="form" name="form" class="w-100 form-control"></select>
                </div>

                <div class="input-group mb-3">
                    <input type="text" class="form-control form-control-sm" readonly id="code" data-clipboard-text="">

                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="copy"
                                data-content="Invite copied" data-clipboard-target="#code">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function () {
            $('#form').select2({
                'minimumResultsForSearch': Infinity,
                width: '100%',
                ajax: {
                    url: '{{route('applications.invite.forms')}}',
                    dataType: 'json'
                }
            });

            $('#form').on('select2:select', function (e) {
                var data = e.params.data;
                console.log(data);

                axios.post('{{route('applications.invite.code')}}',
                    {
                        form: data.id
                    })
                    .then(function (data) {
                        $('#code').val(data.data);
                        $('#code').attr('data-clipboard-text', data.data)
                    });
            });

            var clipboard = new window.clipboard('#copy');

            clipboard.on('success', function (e) {
                $(e.trigger).popover("show");
                // hide notification after 1,5s
                setTimeout(
                    function () {
                        $(e.trigger).popover("hide");
                    }, 1500);
            });
        });

    </script>

@endpush
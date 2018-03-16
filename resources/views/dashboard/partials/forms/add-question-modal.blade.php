<div class="modal fade" id="createNewQuestionModal" tabindex="-1" role="dialog" aria-labelledby="newQuestion" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NewQuestionModalLabel">Add new Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('question.store', $form)}}" method="post">
                    {{csrf_field()}}

                    <div class="form-group">
                        <label for="question">Question</label>
                        <textarea class="form-control" id="question" rows="4" name="question"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" rows="4" name="description"></textarea>
                        <small class="form-text text-muted">Not visable to the applicant! Use this field to describe your intent asking the question,
                        so that other recruiters know what to look out for.</small>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="true" name="required" checked id="required">
                        <label for="required">Required</label>

                        <small class="form-text text-muted">Is the an answer required to finish the application?</small>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>

                </form>
            </div>
        </div>
    </div>
</div>
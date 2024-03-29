<div class="modal fade" id="addcategory" role="dialog" aria-labelledby="addcategory" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form name="saveRolesForm" id="saveRolesForm" method="post"
      data-exists="{{ route('admin.role.exists', ['id' => $role->id ?? null]) }}"
      action="{{ route('admin.role.store') }}">
      @csrf
      @if (isset($role))
        @method('PATCH')
      @endif
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ isset($role) ? 'Edit Role' : 'Add Role' }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="form-errors"></div>
          <div class="form-group m-form__group">
            <label for="roles_name" class="form-control-label">Roles Name: <i class="text-danger">*</i></label>
            <input type="text" class="form-control" id="roles_name" name="roles_name"
              value="{{ $role->description ?? '' }}" data-msg-remote="Please enter unique role" maxlength="190">
          </div>
        </div>
        <div class="modal-footer">
          <x-button type="button" class="btn shadow-none btn-default" data-dismiss="modal">
            Close
          </x-button>
          <x-button type="submit" class="btn  btn-primary" id="next">
            {{ isset($role) ? 'Update' : 'Save' }}
          </x-button>
        </div>
      </div>
    </form>
  </div>
</div>


<script type="text/javascript">
  jQuery(document).ready(function($) {
    $('#saveRolesForm').validate({
      debug: false,
      ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
      rules: {
        roles_name: {
          required: true,
          remote: {
            url: $('#saveRolesForm').data('exists'),
            type: "post",
          }
        }
      },
      messages: {
        name: {
          remote: "Please enter unique role",
        }
      },
      errorPlacement: function(error, element) {
        // $(element).addClass('is-invalid')
        error.appendTo(element.parent()).addClass('text-danger');
      }
    });
  });

</script>

<x-app :title="$title">


  <x-admin.UI.page-header title="Manage Role">
    <x-slot name="action">
      <x-button href="{{ route('admin.user.index') }}" class="btn-secondary" icon="fa fa-arrow-left" variant="link">
        Back
      </x-button>
      <x-button data-url="{{ route('admin.role.create') }}" data-target-modal="#addcategory"
        href="{{ route('admin.user.index') }}" class="btn-primary call-modal" icon="fa fa-plus" variant="link">
        Add
      </x-button>
    </x-slot>
  </x-admin.UI.page-header>

  <div class="row mt-3">
    <div class="col-lg-4">
      <p class="text-muted">
        The Role Permissions Manager allows you to set which roles can access which documents and with what
        permissions (read, write, submit, etc.).
      </p>
      <p class="text-muted">
        Once roles are assigned to a user, their access can be limited to specific documents. The permission
        structure allows you to define different permission rules for different fields using a concept called
        Permission Level of a field.
      </p>
    </div>
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body p-0">
          <table class="table table-valign-middle" id="roletable" data-url="{{ route('admin.role.dataList') }}"
            style="width: 100%;">
            <thead class="bg-light">
              <tr>
                <th style="width:1%">No</th>
                <th style="width:25%" data-orderable="true">Title</th>
                <th style="width:10%" data-orderable="false">Permission</th>
                <th style="width:10%" data-orderable="false">Status</th>
                <th style="width:10%" data-orderable="false" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <x-slot name="javascript">
    <script type="text/javascript">
      $(document).ready(function() {
        let admin = $('#roletable').DataTable({
          "processing": true,
          "serverSide": true,
          "stateSave": true,
          "lengthMenu": [10, 25, 50],
          "responsive": true,
          // "iDisplayLength": 2,
          "ajax": {
            "url": $('#roletable').attr('data-url'),
            "dataType": "json",
            "type": "POST",
            "data": {

              status: $('#status').val(),
              date_from: $('#date_from').val(),
              date_to: $('#date_to').val(),

            }
          },

          "order": [
            [0, "desc"]
          ],
          "columns": [{
              "data": "id"
            },
            {
              "data": "name"
            },
            {
              "data": "permission"
            },
            {
              "data": "status"
            },
            {
              "data": "action"
            },
          ]
        });
      });

    </script>
  </x-slot>
</x-app>

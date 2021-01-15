<x-app :title="$title">
  <x-admin.UI.page-header title="Manage Permission">
    <x-slot name="action">
      <x-button href="{{ route('admin.user.index') }}" class="btn-secondary" icon="fa fa-arrow-left" variant="link">
        Back
      </x-button>
      <x-button data-url="{{ route('admin.permission.create') }}" data-target-modal="#addcategory"
        class="btn-primary call-modal" icon="fa fa-plus" variant="link">
        Add
      </x-button>
    </x-slot>
  </x-admin.UI.page-header>
  <div class="row mt-3">

    <div class="col-lg-4">
      <p class="text-muted">
        The permission manager allows you to set which permissions can access which documents and with what
        permissions (read, write, submit, etc.). assign a permission to role or directly to user.

      </p>

    </div>

    <div class="col-lg-8">
      <div class="card">
        <div class="card-body p-0">
          <table class="table table-valign-middle" id="permissiontable"
            data-url="{{ route('admin.permission.dataList') }}" style="width: 100%;">
            <thead class="bg-light">
              <tr>
                <th style="width:1%">No</th>
                <th style="width:25%" data-orderable="true">Title</th>
                {{-- <th style="width:10%" data-orderable="false">Permission</th>
                --}}
                <th style="width:10%" data-orderable="false">Status</th>
                <th style="width:3%" class="text-center" data-orderable="false" class="text-center">Action</th>
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
        let admin = $('#permissiontable').DataTable({
          "processing": true,
          "serverSide": true,
          "stateSave": true,
          "lengthMenu": [10, 25, 50],
          "responsive": true,
          // "iDisplayLength": 2,
          "ajax": {
            "url": $('#permissiontable').attr('data-url'),
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

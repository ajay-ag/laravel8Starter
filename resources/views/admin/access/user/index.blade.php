<x-app :title="$title">

  <x-admin.UI.page-header :title="$title">
    <x-slot name="action">
      <x-button href="{{ route('admin.user.create') }}" class="btn-primary" icon="fa fa-plus" variant="link">
        Add user
      </x-button>
    </x-slot>
  </x-admin.UI.page-header>

  <div class="row">
    <div class="col-lg-12">
      <x-card padding="p-0">
        <table class="table table-valign-middle" id="roletable" data-url="{{ route('admin.user.dataList') }}"
          style="width: 100%;">
          <thead class="bg-light">
            <tr>
              <th style="width:25%" data-orderable="true">Name</th>
              <th style="width:10%" data-orderable="true">Email</th>
              <th style="width:20%" data-orderable="false">Roles</th>
              <th style="width:10%" data-orderable="true">Status</th>
              <th style="width:10%" class="text-center" data-orderable="false">Action</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </x-card>
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
            "data": {}
          },

          "order": [
            [0, "desc"]
          ],
          "columns": [{
              "data": "name"
            },
            {
              "data": "email"
            },
            {
              "data": "roels"
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

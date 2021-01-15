<x-app>
  <x-admin.UI.page-header :title="$title">
    <x-slot name="action">
      <x-button href="{{ route('admin.sub-category.create') }}" class="btn-secondary" icon="fa fa-plus" variant="link">
        Add Category
      </x-button>
    </x-slot>
  </x-admin.UI.page-header>
  <div class="row mt-3">
    <div class="col-lg-12">
      <x-card padding="p-0">
        <table class="table table-valign-middle" id="categoryTable" data-url="{{ route('admin.sub-category.dataList') }}"
          style="width: 100%;">
          <thead class="bg-light">
            <tr>
              <th style="width:1%">No</th>
              <th style="width:25%" data-orderable="true">Title</th>
              <th style="width:10%" data-orderable="false">Status</th>
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
      $(document).ready(function () {
        let admin = $('#categoryTable').DataTable({
          "processing": true,
          "serverSide": true,
          "stateSave": true,
          "lengthMenu": [10, 25, 50],
          "responsive": true,
          // "iDisplayLength": 2,
          "ajax": {
            "url": $('#categoryTable').attr('data-url'),
            "dataType": "json",
            "type": "POST",
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
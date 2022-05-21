<x-app>
  <x-admin.UI.page-header :title="$title" />

  <div class="row">
    <div class="col-md-12">
      <x-card padding="p-0">
        <table class="table w-100" id="ContactTable" data-url="{{ route('admin.contact.list') }}">
          <thead class="bg-light">
            <tr>
              <th data-orderable="true">Name</th>
              <th style="width:20%" data-orderable="false">Email</th>
              <th style="width:20%">Telephone</th>
              <th style="width:20%" data-orderable="false">Subject</th>
              <th style="width:25%" data-orderable="false" class="text-center">Action</th>
            </tr>
          </thead>
        </table>
      </x-card>
    </div>
  </div>
  <div id="load-modal"></div>

  <x-slot name="link">
    <link rel="stylesheet" href="{{ asset('assets/plugins/mohithg-switchery/dist/switchery.min.css') }}">
  </x-slot>
  <x-slot name="script">
    <script src="{{asset('assets/plugins/mohithg-switchery/dist/switchery.min.js') }}"></script>
  </x-slot>
  <x-slot name="javascript">
    <script type="text/javascript">
      $(document).ready(function () {
        var table = $('#ContactTable').DataTable({
          "processing": true,
          "serverSide": true,
          "stateSave": true,
          "lengthMenu": [10, 25, 50],
          "responsive": true,
          // "iDisplayLength": 2,
          "ajax": {
            "url": $('#ContactTable').attr('data-url'),
            "dataType": "json",
            "type": "POST",
            "data": function (d) {
              return $.extend({}, d, {});
            }
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
              "data": "phone"
            },
            {
              "data": "subject"
            },
            {
              "data": "action"
            }
          ]
        });
      });
    </script>
  </x-slot>
</x-app>
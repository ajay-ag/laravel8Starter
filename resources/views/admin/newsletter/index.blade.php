<x-app>
  <x-admin.UI.page-header :title="$title" />

  <div class="row">
    <div class="col-sm-12">
      <div class="card p-0">
        {{-- <div class="card-body"> --}}
        <div class="dt-responsive">
          <table class="table w-100" id="newsletterTable" data-url="{{ route('admin.newsletter.list') }}">
            <thead class="bg-light">
              <tr>
                <th style="width:1%">#</th>
                <th style="width:25%" class="" data-orderable="false">Email</th>
                <th style="width:2%" data-orderable="false" class="text-center">Date</th>
              </tr>
            </thead>
          </table>
        </div>
        {{-- </div> --}}
      </div>
      <!-- Language - Comma Decimal Place table end -->
    </div>
  </div>

  <x-slot name="javascript">
    <script>
      $(document).ready(function () {
        var table = $('#newsletterTable').DataTable({
          "processing": true,
          "serverSide": true,
          "stateSave": true,
          "lengthMenu": [10, 25, 50],
          "responsive": true,
          // "iDisplayLength": 2,
          "ajax": {
            "url": $('#newsletterTable').attr('data-url'),
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
              "data": "id"
            },
            {
              "data": "email"
            },
            {
              "data": "created_at"
            }
          ]
        });
      });
    </script>
  </x-slot>

</x-app>
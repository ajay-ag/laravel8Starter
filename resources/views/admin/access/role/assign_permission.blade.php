<x-app>
  <x-admin.UI.page-header title="Assign Permission">
    <x-slot name="action">
      <x-button href="{{ route('admin.user.index') }}" variant="link" class="btn-secondary" icon="fa fa-arrow-left"
        variant="link">
        Back
      </x-button>
    </x-slot>
  </x-admin.UI.page-header>

  <div class="row mt-3">
    <div class="col-lg-5">
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
    <div class="col-lg-7">
      <div class="card">
        <div class="card-body ">
          <div id="m_tree_3" class="tree-demo"></div>
        </div>
      </div>
      <button type="button" data-url="{{ route('admin.role.permission.assign', $role->id) }}"
        class="btn btn-primary btn-sm assign-permission float-right shadow">Assign Permission</button>
    </div>
  </div>
  <x-slot name="css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
  </x-slot>
  <x-slot name="script">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
  </x-slot>
  <x-slot name="javascript">

    <script type="text/javascript">
      $(document).ready(function() {

        var data = @json($permissions);

        $("#m_tree_3").jstree({
          plugins: ["wholerow", "checkbox", "types"],
          core: {
            themes: {
              responsive: !1
            },
            data: data
          },
          types: {
            default: {
              icon: "fa fa-folder m--font-warning"
            },
            file: {
              icon: "fa fa-file  m--font-warning"
            }
          }
        });

        $('.assign-permission').on('click', function() {
          var el = $(this);
          var btndata = el.data();

          var server_tree = $('#m_tree_3').jstree("get_selected", true);

          var newArray = server_tree.map(function(value, index) {
            return $.merge(value.parents, [value.id]);
          });

          var arrayData = $.unique([].concat.apply([], newArray));

          data = arrayData.filter(function(x, i, a) {
            return a.indexOf(x) == i && x != '#';
          });

          // return true ;

          $.ajax({
            type: "post",
            url: btndata.url,
            data: {
              permission: data,
              role: btndata.role
            },
          }).done(function(respons) {

            toast.fire({
              type: 'success',
              title: 'Success',
              icon: 'success',
              text: 'Permission assigned successfully..'
            });

          }).fail(function(respons) {

            toast.fire({
              type: 'error',
              title: 'Error',
              icon: 'error',
              text: 'something went wrong please try again !'
            });

          });

        });

      });

    </script>
  </x-slot>
</x-app>

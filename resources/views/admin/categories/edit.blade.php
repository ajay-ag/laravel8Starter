<x-app>
  <x-admin.UI.page-header title=" ">
    <x-slot name="action">
      <x-button href="{{ route('admin.category.index') }}" class="btn-secondary" icon="fa fa-arrow-left" variant="link">
        Back
      </x-button>
    </x-slot>
  </x-admin.UI.page-header>
  <div class="row mt-4">
    <div class="col-sm-12 col-md-5">
      <div class="cards">
        <div class="card-body p-0">
          <h4 class=""> Edit Category </h4>
          <p class="text-muted">Hear you can Update a category and uplod image </p>
        </div>
      </div>
    </div>
    <div class="col-sm-12 col-md-7 ">
      <form action="{{ route('admin.category.update' , $category->id ) }}" id="categoriesForm" method="post"
        enctype="multipart/form-data">
        @csrf @method('PUT')
        <x-card>
          <div class="row" x-data="slugdata()" x-init="init({{ json_encode($category) }})">
            <div class="col-md-12">
              <div class="form-group">
                <label>Category Name <span class="text-danger">*</span></label>
                <input type="text" name="name"
                  data-rule-remote="{{ route('admin.category.exists' ,['id' => $category->id ]) }}" x-model="name"
                  value="{{ $category->name ?? '' }}" id="name" required class="form-control">
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label>Slug <span class="text-danger">*</span></label>
                <input type="text" readonly x-model="slug(name)" value="{{ $category->slug ?? '' }}" name="slug"
                  required id="slug" class="form-control">
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group">
                <label>Description</label>
                <textarea name="description" id="description" rows="2"
                  class="form-control">{{ $category->description ?? '' }}</textarea>
              </div>
            </div>

            <div class="col-sm-12 clearfix ">
              <x-admin.UI.imagepriview height="200px" label='Image' data-rule-required="true" name='images' id='images' priview='{{ $category->image_src ?? null }}'/>
            </div>

          </div>
        </x-card>
        <div class="float-right">
          <x-button href="{{ route('admin.category.index') }}" class="shadow-none btn-default mr-3" variant="link">
            Cancel
          </x-button>
          <x-button type="submit" class="btn-primary float-right">
            Update
          </x-button>
        </div>
      </form>
    </div>
  </div>

  <x-slot name="javascript">
    <script>
      function slugdata() {
        return {
          name: '',
          slug: function (text) {
            return text.toString().normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase().trim()
              .replace(/\s+/g, '-').replace(/[^\w\-]+/g, '').replace(/\-\-+/g, '-');
          },
          init(category) {
            this.name = category.name;
            this.slug(this.name);
          }
        }
      }

      $(document).ready(function () {
        $('#categoriesForm').validate({
          debug: false,
          ignore: '.select2-search__field,:hidden:not("textarea,.files,select")',
          rules: {
              name: {
                  required: true,
                      remote: {
                          url:  $('#name').attr('data-rule-remote'),
                          type: "get"
                      }
              }
          },
          messages: {
            name: {
                  remote: "Category already in use",
              }
          },
          errorPlacement: function (error, element) {
            // $(element).addClass('is-invalid')
            error.appendTo(element.parent()).addClass('text-danger');
          }
        });

      });
    </script>
  </x-slot>
</x-app>
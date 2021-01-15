<x-app>
  <x-admin.UI.page-header title=" ">
    <x-slot name="action">
      <x-button href="{{ route('admin.sub-category.index') }}" class="btn-secondary" icon="fa fa-arrow-left" variant="link">
        Back
      </x-button>
    </x-slot>
  </x-admin.UI.page-header>
  <div class="row mt-4">
    <div class="col-sm-12 col-md-5">
      <div class="cards">
        <div class="card-body p-0">
          <h4 class=""> Create Sub Category </h4>
          <p class="text-muted">Hear you can create a category and ulode image </p>
        </div>
      </div>
    </div>

    <div class="col-sm-12 col-md-7 ">
      <form action="{{ route('admin.sub-category.store') }}"
        id="categoriesForm" method="post"
        enctype="multipart/form-data">
        @csrf
        <x-card>
          <div class="row" x-data="slugdata()">
            <div class="col-sm-12">
              <div class="form-group">
                  <label for="category">category <span class="text-danger">*</span></label>
                  <select class="form-control category-select2" name="category" id="category"
                      data-url="{{ route('admin.get.category') }}" data-rule-required="true"
                      data-placeholder="Select Category."
                      data-msg-required="Category is required.">
                      <option value="" selected>Select Category</option>
                  </select>
              </div>
          </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Name <span class="text-danger">*</span></label>
                <input type="text"
                  data-url="{{ route('admin.sub-category.exists') }}"
                  required
                  name="name" x-model="name"
                  id="name" class="form-control">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Slug <span class="text-danger">*</span></label>
                <input type="text" readonly x-model="slug(name)" name="slug" required id="slug" class="form-control">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Description</label>
                <textarea name="description" id="description" rows="2" class="form-control"></textarea>
              </div>
            </div>
            <div class="col-sm-12 clearfix ">
              <x-admin.UI.imagepriview class="files" height="200px" label='Image' name='images' id='images' priview=''/>
            </div>
          </div>
        </x-card>
        <div class="float-right">
          <x-button href="{{ route('admin.sub-category.index') }}" class="shadow-none btn-default mr-3" variant="link">
            Cancel
          </x-button>
          <x-button type="submit" class="btn-primary float-right">
            Save
          </x-button>
        </div>
      </form>
    </div>
  </div>
  <x-slot name="script">
    <script src="{{ asset('admin/js/subcategory.js') }}"></script>
  </x-slot>
</x-app>
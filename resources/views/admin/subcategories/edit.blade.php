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
      <form action="{{ route('admin.sub-category.update' , $category->id ) }}" id="categoriesForm" method="post"
        enctype="multipart/form-data">
        @csrf @method('PUT')
        <x-card>
          <div class="row" x-data="slugdata()" x-init="init({{ json_encode($category) }})">
            <div class="col-sm-12">
              <div class="form-group">
                  <label for="category">category <span class="text-danger">*</span></label>
                  <select class="form-control category-select2" name="category" id="category"
                    data-url="{{ route('admin.get.category') }}" data-rule-required="true"
                    data-placeholder="Select Category." data-msg-required="Category is required.">
                    <option value="" selected>Select Category</option>
                    @if ($category->category)
                        <option value="{{$category->category->id}}"   selected>{{$category->category->name}}</option>
                    @endif
                  </select>
              </div>
          </div>
            <div class="col-md-12">
              <div class="form-group">
                <label>Name <span class="text-danger">*</span></label>
                <input type="text" name="name"
                  data-url="{{ route('admin.sub-category.exists') }}"
                  data-id="{{ $category->id }}"
                  x-model="name"
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
          <x-button href="{{ route('admin.sub-category.index') }}" class="shadow-none btn-default mr-3" variant="link">
            Cancel
          </x-button>
          <x-button type="submit" class="btn-primary float-right">
            Update
          </x-button>
        </div>
      </form>
    </div>
  </div>
  <x-slot name="script">
    <script src="{{ asset('admin/js/subcategory.js') }}"></script>
  </x-slot>
</x-app>
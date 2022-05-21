<x-app :title="$title">
    <x-admin.UI.page-header :title="$title">
        <x-slot name="action">
            <x-button href="{{ route('admin.home') }}" class="btn-secondary" icon="fa fa-arrow-left" variant="link">
                Back
            </x-button>
        </x-slot>
    </x-admin.UI.page-header>
    <form action="{{ route('admin.profile.update', $profile->id) }}" id="saveUser" method="POST" autocomplete="off">
        @csrf @method('PUT')
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center" id="tag_container">
                            <img src="{{ $profile->profile_src ?? '' }}" class="rounded-circle profile-user-img"
                                style="width:150px;" id="showcropimg">
                            <div class="text-center py-3">
                                <label for="uplode_btn" class="btn btn-sm btn-info">Upload Image</label>
                                <input type="file" value="Choose a file" accept="image/*" id="uplode_btn"
                                    name="uplode_btn" style="display:none;">
                            </div>
                            <h4 class="mt-1"><b>{{ ucfirst($profile->first_name ?? '') }}</b></h4>
                            <p class="card-subtitle">{{ $profile->email ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="profiletab">

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                        @foreach ($errors->all() as $error)
                                            <span> {{ $loop->iteration }} ) {{ $error }}</span><br>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="first_name" class="col-sm-1-12 col-form-label">First Name <i
                                                class="text-danger">*</i></label>
                                        <input type="text" data-rule-required="true" class="form-control"
                                            name="first_name" id="first_name" value="{{ $profile->first_name }}"
                                            placeholder="First Name">
                                    </div>
                                    <div class="form-group col">
                                        <label for="last_name" class="col-sm-1-12 col-form-label">Last Name <i
                                                class="text-danger">*</i></label>
                                        <input type="text" data-rule-required="true" value="{{ $profile->last_name }}"
                                            class="form-control" name="last_name" id="last_name"
                                            placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="email" class="col-sm-1-12 col-form-label">E-mail Address <i
                                                class="text-danger">*</i></label>
                                        <input type="text" data-rule-required="true" class="form-control"
                                            data-rule-remote="{{ route('admin.user.email.unique', ['id' => $profile->id]) }}"
                                            value="{{ $profile->email }}" data-msg-remote="This email already exists"
                                            name="email" id="email" placeholder="E-mail Address">
                                    </div>
                                </div>
                                <hr style="margin-left: -20px; margin-right: -20px; ">
                                <h4 class="mb-3">Change Password</h4>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="old_password" class="col-sm-1-12 col-form-label">Old Password
                                        </label>
                                        <input type="password" data-rule-required="true" class="form-control ignore"
                                            name="old_password" id="old_password" placeholder="Old Password">
                                    </div>
                                    <div class="form-group col">
                                        <label for="new_password" class="col-sm-1-12 col-form-label">New Password
                                        </label>
                                        <input type="password" data-rule-required="true" class="form-control ignore"
                                            name="new_password" id="new_password" placeholder="New Password">
                                    </div>
                                    <div class="form-group col">
                                        <label for="confirm_password" class="col-sm-1-12 col-form-label">Confirm
                                            Password
                                        </label>
                                        <input type="password" data-rule-required="true" class="form-control ignore"
                                            name="confirm_password" id="confirm_password"
                                            placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group d-flex justify-content-end">
                    <x-button type="submit" class="btn btn-primary">Save</x-button>
                </div>
            </div>
        </div>
    </form>
    <!-- Modal -->
    <div class="modal fade" id="profile_modal" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Profile Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="upload-demo"></div>
                    <input type="hidden" name="profile_url" id="profile_url"
                        value="{{ route('admin.profile.update.image', $profile->id) }}">
                </div>
                <div class="modal-footer">
                    <x-button class="btn btn-default shadow-none" data-dismiss="modal" type="button">
                        Close
                    </x-button>
                    <x-button class="btn-primary upload-result" type="submit">
                        Save
                    </x-button>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.min.css" rel="stylesheet">
    </x-slot>
    <x-slot name="script">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.4/croppie.min.js"></script>
    </x-slot>
    <x-slot name="javascript">
        <script>
            $(document).ready(function() {
                var $uploadCrop;

                function readFile(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('.upload-demo').addClass('ready');
                            $uploadCrop.croppie('bind', {
                                url: e.target.result,
                            }).then(function() {
                                // $('#profile_modal').modal('show');
                            });
                        }
                        reader.readAsDataURL(input.files[0]);
                    } else {
                        swal("Sorry - you're browser doesn't support the FileReader API");
                    }
                }
                $uploadCrop = $('#upload-demo').croppie({
                    viewport: {
                        width: 200,
                        height: 200,
                        type: 'circle'
                    },
                    boundary: {
                        width: 300,
                        height: 300
                    },
                    enableExif: true,
                });
                $('#uplode_btn').on('change', function() {
                    $('#profile_modal').modal('show');
                });
                $('#profile_modal').on('shown.bs.modal', function() {
                    var input = $('#uplode_btn').get(0);
                    readFile(input);
                });
                $('.role-select-2').select2({
                    placeholder: 'Search Role',
                    allowClear: true
                });
                $('.upload-result').on('click', function(ev) {
                    $uploadCrop.croppie('result', {
                        type: 'canvas',
                        size: 'viewport',
                        format: 'base64'
                    }).then(function(resp) {
                        $.ajax({
                            type: "post",
                            url: $('#profile_url').val(),
                            data: {
                                image: resp
                            },
                        }).done(function(res) {
                            $('img.avatar ,#showcropimg').attr('src', res.image_url);
                            message.fire({
                                type: 'success',
                                icon: 'success',
                                text: 'Image has been updated successfully.',
                            })
                            if (res.success == true) {
                                $("#image").attr("src", res.image_url);
                            }
                        }).always(function(res) {
                            $('#profile_modal').modal('hide');
                            $('#imgSrcInput').remove();
                        }).fail(function(res) {
                            if ($(document).is('input[name="_method"]')) {
                                swal(
                                    "Sorry - you're browser doesn't support the FileReader API");
                            } else {
                                $('img.avatar ,#showcropimg').attr('src', resp);
                                $('<input>', {
                                    name: 'imgsrc',
                                    id: 'imgSrcInput',
                                    value: resp,
                                    type: 'hidden'
                                }).prependTo('form');
                            }
                        });
                    });
                });
            });

            $('#saveUser').validate({
                debug: false,
                ignore: '.ignore',
                errorPlacement: function(error, element) {
                    // $(element).addClass('is-invalid')
                    error.appendTo(element.parent()).addClass('text-danger');
                }
            });
        </script>
    </x-slot>
</x-app>

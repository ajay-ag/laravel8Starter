<x-app>

  <x-admin.UI.page-header title="Logs" />
  <div class="table-responsive">
    <table class="table table-sm table-hover">
        <thead>
            <tr>
                @foreach($headers as $key => $header)
                <th scope="col" class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                    @if ($key == 'date')
                        <span class="badge badge-info">{{ $header }}</span>
                    @else
                        <span class="badge badge-level-{{ $key }}">
                            {{ log_styler()->icon($key) }} {{ $header }}
                        </span>
                    @endif
                </th>
                @endforeach
                <th scope="col" class="text-right">@lang('Actions')</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rows as $date => $row)
                <tr>
                    @foreach($row as $key => $value)
                        <td class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                            @if ($key == 'date')
                                <span class="badge badge-primary">{{ $value }}</span>
                            @elseif ($value == 0)
                                <span class="badge empty">{{ $value }}</span>
                            @else
                                <a href="{{ route('log-viewer::logs.filter', [$date, $key]) }}">
                                    <span class="badge badge-level-{{ $key }}">{{ $value }}</span>
                                </a>
                            @endif
                        </td>
                    @endforeach
                    <td class="text-right">
                        <a href="{{ route('log-viewer::logs.show', [$date]) }}" class="btn btn-sm btn-info">
                            <i class="fa fa-search"></i>
                        </a>
                        <a href="{{ route('log-viewer::logs.download', [$date]) }}" class="btn btn-sm btn-success">
                            <i class="fa fa-download"></i>
                        </a>
                        <a href="#delete-log-modal" class="btn btn-sm btn-danger" data-log-date="{{ $date }}">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="11" class="text-center">
                        <span class="badge badge-secondary">@lang('The list of logs is empty!')</span>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
  </div>
  {{-- {{ $rows->render() }} --}}
  <x-slot name="javascript">
    <script>
      $(function () {
          var deleteLogModal = $('div#delete-log-modal'),
              deleteLogForm  = $('form#delete-log-form'),
              submitBtn      = deleteLogForm.find('button[type=submit]');

          $("a[href='#delete-log-modal']").on('click', function(event) {
              event.preventDefault();
              var date    = $(this).data('log-date'),
                  message = "{{ __('Are you sure you want to delete this log file: :date ?') }}";

              deleteLogForm.find('input[name=date]').val(date);
              deleteLogModal.find('.modal-body p').html(message.replace(':date', date));

              deleteLogModal.modal('show');
          });

          deleteLogForm.on('submit', function(event) {
              event.preventDefault();
              submitBtn.button('loading');

              $.ajax({
                  url:      $(this).attr('action'),
                  type:     $(this).attr('method'),
                  dataType: 'json',
                  data:     $(this).serialize(),
                  success: function(data) {
                      submitBtn.button('reset');
                      if (data.result === 'success') {
                          deleteLogModal.modal('hide');
                          location.reload();
                      }
                      else {
                          alert('AJAX ERROR ! Check the console !');
                          console.error(data);
                      }
                  },
                  error: function(xhr, textStatus, errorThrown) {
                      alert('AJAX ERROR ! Check the console !');
                      console.error(errorThrown);
                      submitBtn.button('reset');
                  }
              });

              return false;
          });

          deleteLogModal.on('hidden.bs.modal', function() {
              deleteLogForm.find('input[name=date]').val('');
              deleteLogModal.find('.modal-body p').html('');
          });
      });
    </script>
  </x-slot>
  <x-slot name="css">
    <style>
      /*
      * Colors: Badge & Infobox
      */

      .badge.badge-env,
     .badge.badge-level-all,
     .badge.badge-level-emergency,
     .badge.badge-level-alert,
     .badge.badge-level-critical,
     .badge.badge-level-error,
     .badge.badge-level-warning,
     .badge.badge-level-notice,
     .badge.badge-level-info,
     .badge.badge-level-debug,
     .badge.empty {
         color: #FFF;
         text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
     }

     .badge.badge-level-all,
     .box.level-all {
         background-color: {{ log_styler()->color('all') }};
     }

     .badge.badge-level-emergency,
     .box.level-emergency {
         background-color: {{ log_styler()->color('emergency') }};
     }

     .badge.badge-level-alert,
     .box.level-alert  {
         background-color: {{ log_styler()->color('alert') }};
     }

     .badge.badge-level-critical,
     .box.level-critical {
         background-color: {{ log_styler()->color('critical') }};
     }

     .badge.badge-level-error,
     .box.level-error {
         background-color: {{ log_styler()->color('error') }};
     }

     .badge.badge-level-warning,
     .box.level-warning {
         background-color: {{ log_styler()->color('warning') }};
     }

     .badge.badge-level-notice,
     .box.level-notice {
         background-color: {{ log_styler()->color('notice') }};
     }

     .badge.badge-level-info,
     .box.level-info {
         background-color: {{ log_styler()->color('info') }};
     }

     .badge.badge-level-debug,
     .box.level-debug {
         background-color: {{ log_styler()->color('debug') }};
     }

     .badge.empty,
     .box.empty {
         background-color: {{ log_styler()->color('empty') }};
     }

     .badge.badge-env {
         background-color: #6A1B9A;
     }
 </style>
  </x-slot>
  <div id="delete-log-modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <form id="delete-log-form" action="{{ route('log-viewer::logs.delete') }}" method="POST">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="date" value="">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">@lang('Delete log file')</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <p></p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-secondary mr-auto" data-dismiss="modal">@lang('Cancel')</button>
                  <button type="submit" class="btn btn-sm btn-danger" data-loading-text="@lang('Loading')&hellip;">@lang('Delete')</button>
              </div>
          </div>
      </form>
    </div>
  </div>
</x-app>
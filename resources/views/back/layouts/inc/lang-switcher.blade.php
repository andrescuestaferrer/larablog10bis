<div class="row align-self-end" style="padding: 10px;" >
    <div class="col-md-12" >
        <!-- <strong> {{ __('Language') }} </strong> -->
        <?php  $available_locales = config('app.available_locales'); $current_locale = config('app.locale')?>
        <select class="form-select"  id="changeLang">   
        @foreach($available_locales as $locale_name => $available_locale)
            @if($available_locale === $current_locale)
                <option value="{{ $available_locale }}"  selected> {{ __($locale_name) }}  </option>
            @else
                <option value="{{ $available_locale }}" > {{ __($locale_name) }} </option>
            @endif
        @endforeach
        </select>
    </div>
</div>

@push('scripts')
    <script>
        $('#changeLang').on('change', function(e) {
            var url = "{{ route('changeLang') }}";
            lang_id = document.getElementById("changeLang").value;
            window.location.href = url + "?lang="+ lang_id;
        });
    </script>
@endpush
@if($errors->has($field))
    <div class="alert alert-danger"> <!--bootstrapovi stilovi za error message u klasi-->
        @foreach($errors->get($field) as $error)
            {{ $error }}
        @endforeach
    </div>
@endif

@if ($errors)
<div class="alert alert-icon-left alert-arrow-left alert-danger alert-dismissible mb-2" role="alert">
	<span class="alert-icon"><i class="la la-warning"></i></span>
	<ul>
	    @foreach ($errors as $e)
	        <li class="text-bold">{{ $e }}</li>
	    @endforeach
    </ul>
</div>
@endif

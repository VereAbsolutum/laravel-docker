@if ($errors->any())
@foreach($errors->all() as $error)
<div class="bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4 mt-1" role="alert">
    <p class="font-bold">Be Warned</p>
    <p>{{ $error }}</p>
</div>

@endforeach
@endif



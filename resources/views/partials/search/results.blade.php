<h1 class="cover-heading">"{{ $word }}"</h1>

<hr>

@if(!empty($error))
<div class="alert alert-danger" role="alert">
    {{ $error }}
</div>
@endif

@forelse ($results as $key => $result)
    <h2># {{ $key + 1 }}</h2>

    <h4 class="text-left">Definitions</h4>

    <ul class="text-left">
        @foreach ($result->getDefinitions() as $definition)
            <li>{{ $definition }}</li>
        @endforeach
    </ul>

    <h4 class="text-left">Pronunciations</h4>

    <ul class="text-left pronunciations">
        @foreach ($result->getPronunciations() as $pronunciation)
            <li>
                <audio controls>
                    <source src="{{ $pronunciation }}" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </li>
        @endforeach
    </ul>
@empty
    <div class="alert alert-danger" role="alert">
        No results
    </div>
@endforelse

<hr>

<p class="lead">
    <a href="{{ route('home') }}" class="btn btn-lg btn-secondary">Home</a>
</p>

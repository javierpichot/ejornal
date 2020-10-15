@foreach($diagnosticos as $diagnostico)
    <option value="{{ $diagnostico->id }}" data-guia="{{ $diagnostico->guia }}">{{$diagnostico->diagnostico}}</option>
@endforeach
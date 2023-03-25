{!! $phpTagStart !!}
namespace {{ $namespace }};

@if(isset($implementsClassName))
use {{$implementsClassNameSpace}};

@endif
@if(isset($extendsClassName))
use {{$extendsClassNameSpace}};

@endif
{{ $type }} {{ $className }}@if(isset($extendsClassName)) extends {{ $extendsClassName }}@endif @if(isset($implementsClassName)) implements {{ $implementsClassName }}@endif {

}

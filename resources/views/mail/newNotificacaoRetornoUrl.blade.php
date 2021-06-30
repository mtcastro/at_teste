@component('mail::message')
    
<h1>Url Voltou ao funcionar</h1>
<p>Atenção, a url <b>"{{$consulta->url->url}}"</b> esteve inativo por: <b>{{
    $consulta->tempoInatividade()->format("%d dias %h horas  %i minutos e %s segundos")}}</b></p>
@endcomponent
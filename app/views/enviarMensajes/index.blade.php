@extends('layouts.mainTemplate')
@section('title', 'Inicio - Enviar email')
@section('head-scripts')
@endsection
@section('content')
    <section class="container">
        <div class="row m-0 g-3">
            <div class="col-12">
                <h5 class="text-center">Enviar mensaje</h5>
                <hr>
            </div>
            <form action="{{route('enviar-mensaje/realizar-envio')}}" method="POST">
                <div class="col-12">
                    <p class="text-start">Seleccione una plantilla</p>
                    @foreach($mensajes_guardados as $mensaje)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="id_mensaje" id="template_{{$mensaje['id_mensaje']}}" value="{{$mensaje['id_mensaje']}}">
                            <label class="form-check-label" for="template_{{$mensaje['id_mensaje']}}">
                                <i class="bi bi-envelope-fill"></i> {{$mensaje['asunto']}}
                            </label>
                        </div>                  
                    @endforeach
                    <div class="text-danger small" id="msgPlantillas"></div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="input_email_pre" class="form-label">Enviar a</label>
                        <input type="email" name="email_send" class="form-control shadow-none" id="input_email" placeholder="name@example.com">
                        <div class="invalid-feedback" id="msgEmail"></div>
                    </div>                  
                </div>
                <div class="col-12 text-center">
                    <button class="btn btn-primary" type="submit" id="button_submit">Enviar mensaje</button>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('footer-scripts')
    {!! jsFile('enviarMensajes', false) !!}
@endsection
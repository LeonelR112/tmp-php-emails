@extends('layouts.mainTemplate')
@section('title', 'Inicio - Email tracker')
@section('head-scripts')
    {!! trumbowygCSS() !!}
@endsection
@section('content')
    <section class="container">
        <div class="row m-0 gy-3">
            @isset($_GET['status'])
                @if($_GET['status'] == 'success')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> El mensaje fue guardado correctamente!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @else
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-x-circle"></i> Ha ocurrido un error!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
            @endisset
            <div class="col-12">
                <a href="{{route('enviar-mensaje')}}" class="btn btn-primary" title="Enviar un mensaje"><i class="bi bi-send-fill"></i> Enviar mensaje</a>
            </div>
            <div class="col-12 mb-3">
                <h5 class="text-center">Crear mensajes</h5>
                <form action="{{route('add-messaje-template')}}" method="POST" id="form_crear_mensajes">
                    <input type="hidden" name="link_tracker" id="input_link_tracker">
                    <div class="row m-0 g-3">
                        <div class="col-12">
                            <label for="input_asunto" class="form-label">Asunto</label>
                            <input type="text" name="asunto" id="input_asunto" class="form-control shadow-none">
                            <div class="invalid-feedback" id="msgAsunto"></div>
                        </div>
                        <div class="col-12">
                            <label for="input_asunto" class="form-label">Link</label>
                            <input type="text" name="link_tracker" id="input_link" class="form-control shadow-none">
                            <div class="invalid-feedback" id="msgLink"></div>
                        </div>
                        <div class="col-12">
                            <label for="input_asunto" class="form-label">Mensaje</label><br>
                            <textarea type="text" name="mensaje" id="input_mensaje"></textarea>
                            <div class="invalid-feedback" id="msgCuerpo"></div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary px-4" id="input_submit" title="Guardar mensaje" type="submit"><i class="bi bi-floppy"></i> Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12">
                <table class="table table table-stripped align-middle">
                    <thead>
                        <tr>
                            <th colspan="4" class="text-center table-secondary">Mensajes guardados</th>
                        </tr>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Asunto</th>
                            <th scope="col" class="text-center">Track link</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody_mensajes">
                        @foreach($mensajes_guardados as $mensaje)
                        <tr>
                            <td scope="col">{{$mensaje['id_mensaje']}}</td>
                            <td scope="col">{{$mensaje['asunto']}}</td>
                            <td scope="col" class="text-center">{!! $mensaje['track_link'] != "" ? '<span class="badge bg-success">SI</span>' : '<span class="badge bg-secondary">NO</span>' !!}</td>
                            <td scope="col" class="text-end">
                                <a class="btn btn-danger btn-sm rounded-circle" href="{{route('delete-message/' . $mensaje['id_mensaje'])}}"><i class="bi bi-trash3"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        @if(count($mensajes_guardados) == 0)
                        <tr>
                            <td scope="col" colspan="4" class="text-muted small">No hay mensajes guardados</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
@section('footer-scripts')
    {!! trumbowygJS() !!}
    {!! jsFile('editorMensajes') !!}
@endsection



<h1>Configurações de Admin</h1>

@component('components.alerta')
    @slot('tipoAlerta')
        Aviso
    @endslot
    Você foi avisado.
@endcomponent

<x-card>
    Conteúdo do Card
</x-card>

<p>Programador: {{ $programador }}</p>
<form method="POST">
    @csrf
    <label for="">Mensagem do Início</label>
    <br>
    <textarea name="mensagem" id="" cols="30" rows="10"></textarea>

    <br>
    <br>
    <button type="submit">Salvar Alterações</button>
</form>
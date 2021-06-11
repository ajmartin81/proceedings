<x-guest-layout>

    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <div class="text-center">
            <h1 class="m-4 font-large text-xl text-red-600">Ha ocurrido un error</h1>
            <p>La cuenta ya ha sido verificada o está usando otra cuenta actualmente.</p>
            <br>
            <p>Pongase en contacto con el <a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}">administrador</a>.</p>
            <p>ó</p>
            <p>restablezca su contraseña <a href="{{ route('password.request') }}">aquí</a>.</p>
        </div>
        
    </x-jet-authentication-card>
</x-guest-layout>
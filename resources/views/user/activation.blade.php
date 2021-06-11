<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div>
                <x-jet-authentication-card-logo />
            </div>
            
            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose">
                
                <h3 class="text-center">Confirme su nueva cuenta</h3>
                
                <textarea rows="10" class="block w-full mb-3 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" style="resize:none" disabled>
1. Política de privacidad
Empresa A informa a los usuarios del sitio web sobre su política respecto del tratamiento y protección de los datos de carácter personal de los usuarios y clientes que puedan ser recabados por la navegación o contratación de servicios a través de su sitio web.
En este sentido, Empresa A garantiza el cumplimiento de la normativa vigente en materia de protección de datos personales, reflejada en la Ley Orgánica 15/1999 de 13 de diciembre, de Protección de Datos de Carácter Personal y en el Real Decreto 1720/2007, de 21 diciembre, por el que se aprueba el Reglamento de Desarrollo de la LOPD.
El uso de esta web implica la aceptación de esta política de privacidad.

2. Recogida, finalidad y tratamientos de datos
Empresa A tiene el deber de informar a los usuarios de su sitio web acerca de la recogida dedatos de carácter personal que pueden llevarse a cabo, bien sea mediante el envío de correo electrónico o al cumplimentar los formularios incluidos en el sitio web. En este sentido, Empresa A será considerada como responsable de los datos recabados mediante los medios anteriormente descritos.
A su vez Empresa A informa a los usuarios de que la finalidad del tratamiento de los datos recabados contempla: La atención de solicitudes realizadas por los usuarios, la inclusión en la agenda de contactos, la prestación de servicios, la gestión de la relación comercial y otras finalidades (INDICAR) Las operaciones, gestiones y procedimientos técnicos que se realicen de forma automatizada o no automatizada y que posibiliten la recogida, el almacenamiento, la modificación, la transferencia y otras acciones sobre datos de carácter personal, tienen la consideración de tratamiento de datos personales.
Todos los datos personales, que sean recogidos a través del sitio web de Empresa A, y por tanto tenga la consideración de tratamiento de datos de carácter personal, serán incorporados en los ficheros declarados ante la Agencia Española de Protección de Datos por Empresa A.

3. Comunicación de información a terceros
Empresa A informa a los usuarios de que sus datos personales no serán cedidos a terceras organizaciones, con la salvedad de que dicha cesión de datos este amparada en una obligación legal o cuando la prestación de un servicio implique la necesidad de una relación contractual con un encargado de tratamiento. En este último caso, solo se llevará a cabo la cesión de datos al tercero cuando Empresa A disponga del consentimiento expreso del usuario.

4. Derechos de los usuarios
La Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal concede a los interesados la posibilidad de ejercer una serie de derechos relacionados con el tratamiento de sus datos personales.
En tanto en cuanto los datos del usuario son objeto de tratamiento por parte de Empresa A. Los usuarios podrán ejercer los derechos de acceso, rectificación, cancelación y oposición de acuerdo con lo previsto en la normativa legal vigente en materia de protección de datos personales.
Para hacer uso del ejercicio de estos derechos, el usuario deberá dirigirse mediante comunicación escrita, aportando documentación que acredite su identidad (DNI o pasaporte), a la siguiente dirección: Empresa A, Calle: X Nº Y, Código postal: Z, Ciudad: V, Provincia: W o la dirección que sea sustituida en el Registro General de Protección de Datos. Dicha comunicación deberá reflejar la siguiente información: Nombre y apellidos del usuario, la petición de solicitud, el domicilio y los datos acreditativos.
El ejercicio de derechos deberá ser realizado por el propio usuario. No obstante, podrán ser ejecutados por una persona autorizada como representante legal del autorizado. En tal caso, se deberá aportar la documentación que acredite esta representación del interesado.
                </textarea>
            
                <x-jet-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('update-user', ['userId' => $userId]) }}">
                    @csrf
                    <div class="block">
                        <x-jet-label for="email" value="{{ __('Email') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="terms">
                            <div class="flex items-center">
                                <x-jet-checkbox name="rgpd" id="rgpd" required/>
    
                                <div class="ml-2">
                                    {!! __('Acepto la política de Protección de datos') !!}
                                </div>
                            </div>
                        </x-jet-label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button>
                            {{ __('Confirmar registro') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
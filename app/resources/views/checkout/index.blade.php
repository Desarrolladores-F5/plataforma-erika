<x-app-layout>

    <div class="container mx-auto py-12">
        <h1 class="text-2xl font-bold mb-4">Confirmar compra</h1>

        <p>Estás a punto de comprar:</p>

        <h2 class="text-xl font-semibold">{{ $course->title }}</h2>

        <p class="mt-2">
            Precio: 
            <strong>CLP {{ number_format($course->price, 0, ',', '.') }}</strong>
        </p>

        <p class="mt-4 text-gray-600">
            <em>(Esta es una pantalla de prueba. Luego aquí conectamos Stripe/Webpay.)</em>
        </p>

        <a href="{{ route('webpay.iniciar', $course->slug) }}" class="btn btn-primary" 
           class="inline-block mt-6 px-6 py-3 bg-orange-500 text-white font-bold rounded shadow">
            Proceder al pago (demo)
        </a>
    </div>

</x-app-layout>

{{-- resources/views/components/productos/tarjeta-relacionada.blade.php --}}
@props(['producto'])

<a href="{{ route('producto.detalle', $producto) }}" class="group block bg-bg-dark-secondary rounded-2xl overflow-hidden transform hover:-translate-y-2 transition duration-500 shadow-xl hover:shadow-[0_25px_50px_-12px_rgba(233,30,99,0.25)] border border-bg-dark-secondary hover:border-accent-pink">
    
    <div class="relative w-full aspect-square overflow-hidden">
        <img src="{{ $producto->imagen? asset('storage/'. $producto->imagen) : 'https://placehold.co/400x400/2c2c2c/E91E63?text=Cheesecake' }}" 
             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" 
             alt="{{ $producto->nombre }}">
    </div>
    
    <div class="p-5">
        <h4 class="font-serif text-2xl font-extrabold text-text-light truncate">{{ $producto->nombre }}</h4>
        <p class="text-sm text-gray-500 mt-1">{{ $producto->categoria?->nombre?? 'Postre' }}</p>
        
        <div class="mt-4 flex justify-between items-center">
            <span class="text-3xl font-extrabold text-accent-pink">{{ number_format($producto->precio, 2, ',', '.') }} €</span>
            <span class="text-base font-semibold border-2 border-accent-pink rounded-full px-5 py-2 text-accent-pink group-hover:bg-accent-pink group-hover:text-primary-black transition duration-300">
                Ver Detalle
            </span>
        </div>
    </div>
</a>
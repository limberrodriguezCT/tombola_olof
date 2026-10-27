<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        
        <div class="flex justify-end mb-6">
            <a href="{{ route('tombola.index') }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-6 rounded-full shadow-[0_4px_15px_rgba(220,38,38,0.5)] transition-transform transform hover:scale-105 flex items-center space-x-2">
                <span>🎰</span>
                <span>Iniciar Tómbola</span>
            </a>
        </div>

        <div class="bg-white rounded-lg shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-red-600">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Nombre Completo</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Centro</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Departamento</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Procedencia</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-white uppercase tracking-wider">Fecha de Registro</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($participants as $participant)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-900">{{ $participant->nombre_completo }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $participant->centro_procedencia }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $participant->departamento }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <!-- Corrección de contraste aquí -->
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-full bg-red-600 text-white shadow-sm">
                                    {{ $participant->tipo_procedencia }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $participant->created_at->format('d/m/Y h:i A') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500 font-medium text-lg">No hay participantes registrados todavía.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
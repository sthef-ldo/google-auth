<x-layouts::app :title="__('Dashboard')">

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl ">

        <!-- Título agregado -->

        <h1 class="text-xl font-bold">Usuarios registrados</h1>

        <flux:table>
            <flux:table.columns>
                <flux:table.column>Id</flux:table.column>
                <flux:table.column>Nombre</flux:table.column>
                <flux:table.column>email</flux:table.column>
                <flux:table.column>Tipo de Cuenta</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>

                @foreach ($users as $user)
                    <flux:table.row>
                        <flux:table.cell>{{ $user->id }}</flux:table.cell>
                        <flux:table.cell>{{ $user->name }}</flux:table.cell>
                        <flux:table.cell>
                            <div class="flex flex-col">
                                <span class="font-medium text-gray-900">{{ $user->email }}</span>
                                <span
                                    class="text-sm text-gray-500">{{ $user->created_at?->format('d/m/Y') ?? '—' }}</span>
                            </div>
                        </flux:table.cell>

                        @if (empty($user->google_id))
                            <flux:table.cell variant="strong" color="green"> Correo </flux:table.cell>
                        @else
                            <flux:table.cell variant="strong" color="blue"> Google </flux:table.cell>
                        @endif
                        {{-- 
                        Variante para determinar el tipo de cuenta  
                        <flux:table.cell variant="strong" color="blue"> {{ $user->google_id ? 'Google' : 'Correo' }} </flux:table.cell>
                        --}}
                    </flux:table.row>
                @endforeach

            </flux:table.rows>

        </flux:table>
        <div class="mt-6 flex justify-center">
            {{ $users->links('pagination::tailwind') }}
        </div>
    </div>

</x-layouts::app>

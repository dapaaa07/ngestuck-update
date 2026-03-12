<x-app-layout>

    {{-- Header --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight">
            {{ __('Tags: Edit') }}
        </h2>
    </x-slot>

    <section class="mx-6">
        <div class="p-8">
            {{-- Menggunakan tag form standar HTML dan Laravel --}}
            <form action="{{ route('admin.tags.update', $tag->slug) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-8">
                    {{-- Name --}}
                    <div>
                        <x-form.label for="name" value="{{ __('Name') }}" />
                        <x-form.input id="name" class="block w-full mt-1" type="text" name="name" :value="$tag->name" required autofocus />
                        <x-form.error for="name" />
                    </div>

                    {{-- Button --}}
                    <x-buttons.primary type="submit">
                        {{ __('Update') }}
                    </x-buttons.primary>
                </div>
            </form>
        </div>
    </section>
</x-app-layout>
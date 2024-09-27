<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-center text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("You're logged in! Now you can create, update, delete your notes!") }}
        </h2>
    </x-slot>

    <div class="container mx-auto max-w-2xl p-6 text-gray-900 dark:text-gray-100">
        <h2 class="text-2xl font-bold mb-4 text-center">Create note</h2>

        <!-- Форма для створення нової нотатки -->
        <form action="{{ route('notes.store') }}" method="POST" class="mb-6 bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md mx-auto">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title:</label>
                <input type="text" id="title" name="title" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100">
                <!-- Змінив кольори фокусів на purple -->
            </div>
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Content:</label>
                <textarea id="content" name="content" required
                          class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100"></textarea>
            </div>
            <button type="submit" class="px-4 py-2 bg-purple-500 text-white font-semibold rounded-md shadow hover:bg-purple-500 focus:outline-none">Add Note</button>
            <!-- Змінив колір кнопки на purple -->
        </form>

        <!-- Відображення нотаток -->
        @if ($notes->isEmpty())
            <p class="text-gray-500 dark:text-gray-400">No notes available.</p>
        @else
            <h2 class="text-2xl font-bold mb-4 text-center">Your notes</h2>
            <ul class="space-y-4">
                @foreach ($notes as $note)
                    <li class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md">
                        <strong class="text-2xl font-semibold">{{ $note->title }}</strong>
                        <p class="mt-1 text-lg">{{ $note->content }}</p>

                        <div class="flex space-x-4 mt-4 justify-center">
                            <!-- justify-center - центроване розташування кнопок -->
                            <!-- Форма для редагування нотатки -->
                            <form action="{{ route('notes.update', $note->id) }}" method="POST" class="flex space-x-2">
                                @csrf
                                @method('PATCH')
                                <input type="text" name="title" value="{{ $note->title }}" required
                                       class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100">
                                <input type="text" name="content" value="{{ $note->content }}" required
                                       class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-purple-500 focus:border-purple-500 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-100">
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-500">Update</button>
                                <!-- Змінив колір кнопки на green -->
                            </form>

                            <!-- Форма для видалення нотатки -->
                            <form action="{{ route('notes.destroy', $note->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-500">Delete</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>

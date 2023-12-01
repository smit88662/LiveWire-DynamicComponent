<div>
    <div class="col-md-8 mb-2">
        @if (session()->has('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-900 dark:text-green-400"
                role="alert">
                <span class="font-medium">{{ session()->get('success') }}</span>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger" role="alert">
                {{ session()->get('error') }}
            </div>
        @endif
        @if ($addPost)
            @include('livewire.custom-create')
        @endif
        @if ($updatePost)
            @include('livewire.custom-edit')
        @endif
    </div>

    @if (!$addPost && !$updatePost)
        <div
            class="container-fluid filament-tables-container rounded-xl border border-gray-300 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
            <div class="filament-tables-header-container">
                <h2 class="selectItem filament-tables-header-heading text-xl font-bold tracking-tight items-center">
                    View Post:
                </h2>
                <div class="filament-tables-header">
                    <div style="margin-top: 15px" class="w-full mt-4 filament-hr border-t dark:border-gray-700">
                    </div>
                </div>
                <div class="button" style="margin-top: 18px">
                    <button type="button" wire:click="addBtn()"
                        class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action"
                        style="margin-left: 7px; margin-bottom: 18px">Create Post</button>
                </div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                        align="center">
                        <tr>
                            <th scope="col" class="px-6 py-3">#</th>
                            <th scope="col" class="px-6 py-3">Comment</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        @if (count($posts) > 0)
                            @foreach ($posts as $post)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">
                                        {{ $post->id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @foreach (explode(',', $post->comment) as $comment)
                                            {{ $comment }}
                                            <br>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4">
                                        <button class="customButton" style="background-color: lightblue; color: black"
                                            wire:click="editPost({{ $post->id }})">Edit</button>
                                        <button class="customButton"
                                            style="margin-left: 8px; background-color: red; color: white"
                                            wire:click="deletePost({{ $post->id }})">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" align="center" class="px-6 py-4">
                                    No Posts Found.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    <script>
        function repeaterSave() {
            window.location.reload();
        }
    </script>
    <style>
        .container-fluid {
            width: 100%;
            height: auto;
            border: 2px solid lightgray;
            border-radius: 10px;
            padding: 20px;
            background-color: #fff;
        }

        .form-control {
            border-radius: 15px
        }

        .customButton {
            padding: 4px;
            font-size: 0.90rem;
            width: 69px;
            height: 34px;
            border-radius: 9px;
        }
    </style>
</div>

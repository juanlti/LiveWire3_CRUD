<div>
    {{-- The whole world belongs to you. --}}

    <div class="bg-white shadow rounded-lg p-6 mb-8">

        <form wire:submit.prevent="save">

            <div class="mb-4">
                {{-- secion  01 del formulario --}}
                {{-- @error('title') <span>{{ $message }}</span> @enderror --}}

                <x-label>
                    Nombre

                    <input type="text" class="w-full rounded-md" wire:model="postCreate.title">
                </x-label>


                <x-input-error for="postCreate.title"/>


            </div>

            <div class="mb-4">
                <x-label>
                    Contenido

                </x-label>

                <x-textarea class="w-full" wire:model="postCreate.content">


                </x-textarea>
                <x-input-error for="postCreate.content"/>
            </div>
            {{-- secion  02 del formulario --}}
            <div class="mb-4 ">

                <label for="">

                    <x-select class="w-full" wire:model="postCreate.category_id">
                        <option value="" disabled>Selecione una Categoria</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">
                                {{$category->name}}
                            </option>

                        @endforeach

                    </x-select>
                    <x-input-error for="postCreate.category_id"/>
                </label>
            </div>
            <div>
                <ul>
                    @foreach($tags as $tag)
                        <li>
                            <label>
                                <x-checkbox type="checkbox" value="{{$tag->id}}" wire:model="postCreate.tags">

                                </x-checkbox>
                                {{$tag['title']}}


                            </label>
                        </li>
                    @endforeach


                </ul>
                <x-input-error for="postCreate.tags"/>
            </div>


            <div class="flex justify-end">
                <x-button>
                    Guardar Datos

                </x-button>

            </div>

        </form>
    </div>


    {{--  {{"nombre del formulario".$formularioNombre}}  --}}
    <div class="bg-white shadow rounded-lg p-6 mt-4">
        <ul class="list-disc list-inside space-y-2"> {{--Lista  --}}
            @foreach($posts as $post)
                <li class="flex justify-between" wire:key="post--{{$post->id}}">
                    {{-- CORRECTO FUNCIONAMIENTO DE RENDERIZADO PARA UNA COLECCION QUE VA SE ACTUALIZANDO EN TODO MOMENTO--}}
                    {{-- LOGRAMOS UNA SEPARACION --}}

                    {{$post->title}}
                    {{--  {{$post->title}} izquierda --}}

                    <div>
                        {{-- bottones a la derecha --}}
                        <x-button wire:click="edit({{$post->id}})">
                            Editar
                        </x-button>


                        <x-danger-button wire:click="destroy({{$post->id}})"
                                         wire:confirm="Esta seguro que desea eliminar esta publicacion ?">
                            Eliminar
                        </x-danger-button>
                    </div>

                </li>

            @endforeach


        </ul>

    </div>


    {{-- MODAL PROPIO (:--}}
    {{-- OCULTAMOS MODAL--}}
    @if($openModal)

        {{-- formulario de edicion--}}
        <div class="bg-gray-800 bg-opacity-25 fixed inset-0">
            <div class="py-12">
                {{-- CENTRAMOS EL CONTENIDO --}}
                <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                    {{--  contenido centrodo ==>   holaaa  --}}
                    <div class="bg-white shadow rounded-lg p-6">

                        <form wire:submit.prevent="update">

                            <div class="mb-4">
                                {{-- secion  01 del formulario --}}
                                @error('title') <span>{{ $message }}</span> @enderror
                                <label>
                                    Nombre
                                </label>
                                <input type="text" class="w-full" wire:model="postEdit.title">
                                <x-input-error for="postEdit.title"></x-input-error>
                            </div>

                            <div class="mb-4">
                                <x-label>
                                    Contenido

                                </x-label>

                                <x-textarea class="w-full" wire:model="postEdit.content">
                                    <x-input-error for="postEdit.content"></x-input-error>


                                </x-textarea>
                            </div>
                            {{-- secion  02 del formulario --}}
                            <div class="mb-4 ">

                                <label for="">
                                    Categorias

                                    <x-select class="w-full" wire:model="postEdit.category_id">
                                        <x-input-error for="postEdit.category_id"></x-input-error>
                                        <option value="" disabled>Selecione una Categoria</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">
                                                {{$category->name}}
                                            </option>

                                        @endforeach

                                    </x-select>
                                </label>
                            </div>
                            <div>
                                <ul>
                                    @foreach($tags as $tag)
                                        <li>
                                            <label>
                                                <x-checkbox type="checkbox" value="{{$tag->id}}"
                                                            wire:model="postEdit.tags">

                                                </x-checkbox>
                                                {{$tag['title']}}

                                            </label>
                                        </li>

                                    @endforeach


                                </ul>
                                <x-input-error for="postEdit.tags"></x-input-error>
                            </div>


                            <div class="flex justify-end">
                                <x-danger-button wire:click="$set('openModal',false)" class="mr-2">
                                    Cancelar

                                </x-danger-button>

                                <x-button>

                                    Actualizar

                                </x-button>


                            </div>


                        </form>

                    </div>
                </div>

            </div>

            @endif
            {{-- MODAL DE JETSTREAM --}}
            {{--
            <form wire:submit.prevent="update">
                <x-dialog-modal wire:modal="openModal">
                    <x-slot name="title">
                        {{-- slot title --}}


            {{--
                            </x-slot>
                            <x-slot name="content">
                                {{-- slot contente --}}
            {{--

                <div class="mb-4">
                    {{-- secion  01 del formulario --}}
            {{--
                        @error('title') <span>{{ $message }}</span> @enderror
                        <label>
                            Nombre
                        </label>
                        <input type="text" class="w-full" wire:model="postEdit.title" required>
                    </div>

                    <div class="mb-4">
                        <x-label>
                            Contenido

                        </x-label>

                        <x-textarea class="w-full" wire:model="postEdit.content" required>


                        </x-textarea>
                    </div>
                    {{-- secion  02 del formulario --}}
            {{--
                    <div class="mb-4 ">

                        <label for="">
                            Categorias

                            <x-select class="w-full" wire:model="postEdit.category_id" required>
                                <option value="" disabled>Selecione una Categoria</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">
                                        {{$category->name}}
                                    </option>

                                @endforeach

                            </x-select>
                        </label>
                    </div>
                    <div>
                        <ul>
                            @foreach($tags as $tag)
                                <li>
                                    <label>
                                        <x-checkbox type="checkbox" value="{{$tag->id}}"
                                                    wire:model="postEdit.tags">

                                        </x-checkbox>
                                        {{$tag['title']}}

                                    </label>
                                </li>

                            @endforeach


                        </ul>
                    </div>




                </x-slot>
                <x-slot name="footer">

                    {{-- slot footer --}}
            {{--

                    <div class="flex justify-end">
                        <x-button class="mr-2">

                            Actualizar

                        </x-button>
                        <x-danger-button wire:click="$set('openModal',false)">
                            Cancelar

                        </x-danger-button>


                    </div>


                </x-slot>

            </x-dialog-modal>
            </form>
             --}}

        </div>


</div>

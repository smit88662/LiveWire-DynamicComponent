     <div
         class="container-fluid filament-tables-container rounded-xl border border-gray-300 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
         <div class="filament-tables-header-container">
             <h2 class="selectItem filament-tables-header-heading text-xl font-bold tracking-tight items-center">
                 Edit Post:
             </h2>
             <div class="filament-tables-header">
                 <div style="margin-top: 15px" class="w-full mt-4 filament-hr border-t dark:border-gray-700">
                 </div>

                 <form>
                     {{-- <div class="container flex items-center" style="margin-top: 40px; margin-left: 20px">
                    <div class="grid">
                        <label class="mb-2">
                            {{ __('Title:') }}
                        </label>
                        <input type="text" class="form-control dark:bg-gray-800" id="title"
                            placeholder="Enter Title" wire:model="title">
                        @error('title')
                            <span class="text-danger" style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                </div> --}}
                     @foreach ($this->values as $key => $value)
                         <div class="container2" style="margin-top: 40px;">
                             <div
                                 class="container-some filament-tables-container rounded-xl border border-gray-300 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-900">
                                 <div class="{{ $loop->last ? '' : 'mb-2' }}" wire:key="{{ $key }}">
                                     <div class="grid" style="margin: 30px">
                                         <label class="mb-2 mt-6">
                                             {{ __('Comment') }}
                                         </label>
                                         <input type="text" style="margin-right: 85px" placeholder="Enter Comment"
                                             class="form-control dark:bg-gray-800"
                                             wire:model.defer="values.{{ $key }}">
                                     </div>
                                 </div>

                                 @if ($loop->index === 0)
                                     <button class="customButton"
                                         style="margin-left: 30px; background-color: green;  margin-bottom: 20px"
                                         wire:click.prevent="addRowForValue">Add
                                     </button>
                                 @else
                                     <button
                                         class="mb-5 fi-btn relative grid-flow-col justify-items-end font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-gray fi-btn-color-gray fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-white text-gray-950 hover:bg-gray-50 dark:bg-white/5 dark:text-white dark:hover:bg-white/10 ring-1 ring-gray-950/10 dark:ring-white/20 fi-ac-btn-action"
                                         style="margin-left: 30px"
                                         wire:click.prevent="removeRowForValue({{ $key }})">Remove
                                     </button>
                                 @endif
                             </div>
                         </div>
                     @endforeach

                     <div class="button" style="margin-top: 28px">
                         <button type="button" wire:click.prevent="updatePostData()"
                             class="filament-button filament-button-size-md inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset dark:focus:ring-offset-0 min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action"
                             style="margin-left: 30px; margin-bottom: 30px">Update</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>

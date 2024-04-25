@push('scripts')
    <script></script>
@endpush

<div
    x-data="{
        commandOpen: @entangle('open'),
    }"
    x-init="
        $watch('commandOpen', function(value){
            if(value === true){
                document.body.classList.add('overflow-hidden');
                $nextTick(() => { window.dispatchEvent(new CustomEvent('command-input-focus', {})); });
            }else{
                document.body.classList.remove('overflow-hidden');
            }
        })
    "
    class="relative z-50 w-auto h-auto"
    @keydown.escape.window="commandOpen = false"
    @keydown.window.prevent.cmd.k="$wire.dispatch('command-palette')"
>
    <template x-teleport="body">

        <div x-show="commandOpen" class="fixed top-0 left-0 z-[99] flex items-center justify-center w-screen h-screen" x-cloak>
            <div x-show="commandOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-300"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="commandOpen=false" class="absolute inset-0 w-full h-full bg-slate-900/40 dark:bg-slate-50/40"
            >
            </div>
            <div
                x-show="commandOpen"
                x-trap.inert.noscroll="commandOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-data="{
                    commandItems: {
                        suggestions : [
                            {
                                title: 'Calendar',
                                value: 'calendar',
                                icon: '<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'24\' height=\'24\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\' class=\'w-4 h-4 mr-2\'><rect width=\'18\' height=\'18\' x=\'3\' y=\'4\' rx=\'2\' ry=\'2\'></rect><line x1=\'16\' x2=\'16\' y1=\'2\' y2=\'6\'></line><line x1=\'8\' x2=\'8\' y1=\'2\' y2=\'6\'></line><line x1=\'3\' x2=\'21\' y1=\'10\' y2=\'10\'></line></svg>',
                                default: true,
                            },
                            {
                                title: 'Search Emoji',
                                value: 'emoji',
                                icon: '<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'24\' height=\'24\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\' class=\'w-4 h-4 mr-2\'><circle cx=\'12\' cy=\'12\' r=\'10\'></circle><path d=\'M8 14s1.5 2 4 2 4-2 4-2\'></path><line x1=\'9\' x2=\'9.01\' y1=\'9\' y2=\'9\'></line><line x1=\'15\' x2=\'15.01\' y1=\'9\' y2=\'9\'></line></svg>',
                                default: true,
                            },
                            {
                                title: 'Calculator',
                                value: 'calculator',
                                icon: '<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'24\' height=\'24\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\' class=\'w-4 h-4 mr-2\'><rect width=\'16\' height=\'20\' x=\'4\' y=\'2\' rx=\'2\'></rect><line x1=\'8\' x2=\'16\' y1=\'6\' y2=\'6\'></line><line x1=\'16\' x2=\'16\' y1=\'14\' y2=\'18\'></line><path d=\'M16 10h.01\'></path><path d=\'M12 10h.01\'></path><path d=\'M8 10h.01\'></path><path d=\'M12 14h.01\'></path><path d=\'M8 14h.01\'></path><path d=\'M12 18h.01\'></path><path d=\'M8 18h.01\'></path></svg>',
                                default: false,
                            }
                        ],
                        settings: [
                            {
                                title: 'Profile',
                                value: 'profile',
                                icon: '<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'24\' height=\'24\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\' class=\'w-4 h-4 mr-2\'><path d=\'M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2\'></path><circle cx=\'12\' cy=\'7\' r=\'4\'></circle></svg>',
                                right: '⌘P',
                                default: true,
                            },
                            {
                                title: 'Billing',
                                value: 'billing',
                                icon: '<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'24\' height=\'24\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\' class=\'w-4 h-4 mr-2\'><rect width=\'20\' height=\'14\' x=\'2\' y=\'5\' rx=\'2\'></rect><line x1=\'2\' x2=\'22\' y1=\'10\' y2=\'10\'></line></svg>',
                                right: '⌘B',
                                default: true,
                            },
                            {
                                title: 'Settings',
                                value: 'settings',
                                icon: '<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'24\' height=\'24\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\' class=\'w-4 h-4 mr-2\'><path d=\'M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z\'></path><circle cx=\'12\' cy=\'12\' r=\'3\'></circle></svg>',
                                right: '⌘S',
                                default: false,
                            },
                            {
                                title: 'Keyboard Settings',
                                value: 'keyboard-settngs',
                                icon: '<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'24\' height=\'24\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2\' stroke-linecap=\'round\' stroke-linejoin=\'round\' class=\'w-4 h-4 mr-2\'><rect width=\'20\' height=\'16\' x=\'2\' y=\'4\' rx=\'2\' ry=\'2\'></rect><path d=\'M6 8h.001\'></path><path d=\'M10 8h.001\'></path><path d=\'M14 8h.001\'></path><path d=\'M18 8h.001\'></path><path d=\'M8 12h.001\'></path><path d=\'M12 12h.001\'></path><path d=\'M16 12h.001\'></path><path d=\'M7 16h10\'></path></svg>',
                                right: '⌘K',
                                default: false,
                            },
                        ]
                    },
                    commandItemsFiltered: [],
                    commandItemActive: null,
                    commandItemSelected: null,
                    commandId: $id('command'),
                    commandSearch: '',
                    commandSearchIsEmpty() {
                        return this.commandSearch.length == 0;
                    },
                    commandItemIsActive(item) {
                        return this.commandItemActive && this.commandItemActive.value==item.value;
                    },
                    commandItemActiveNext(){
                        let index = this.commandItemsFiltered.indexOf(this.commandItemActive);
                        if(index < this.commandItemsFiltered.length-1){
                            this.commandItemActive = this.commandItemsFiltered[index+1];
                            this.commandScrollToActiveItem();
                        }
                    },
                    commandItemActivePrevious(){
                        let index = this.commandItemsFiltered.indexOf(this.commandItemActive);
                        if(index > 0){
                            this.commandItemActive = this.commandItemsFiltered[index-1];
                            this.commandScrollToActiveItem();
                        }
                    },
                    commandScrollToActiveItem(){
                        if(this.commandItemActive){
                            activeElement = document.getElementById(this.commandItemActive.value + '-' + this.commandId)
                            if(!activeElement) return;

                            newScrollPos = (activeElement.offsetTop + activeElement.offsetHeight) - this.$refs.commandItemsList.offsetHeight;
                            if(newScrollPos > 0){
                                this.$refs.commandItemsList.scrollTop=newScrollPos;
                            } else {
                                this.$refs.commandItemsList.scrollTop=0;
                            }
                        }
                    },
                    commandSearchItems() {
                        if(!this.commandSearchIsEmpty()){
                            searchTerm = this.commandSearch.replace(/\*/g, '').toLowerCase();
                            this.commandItemsFiltered = this.commandItems.filter(item => item.title.toLowerCase().startsWith(searchTerm));

                            this.commandScrollToActiveItem();
                        } else {
                            this.commandItemsFiltered = this.commandItems.filter(item => item.default);
                        }
                        this.commandItemActive = this.commandItemsFiltered[0];
                    },
                    commandShowCategory(item, index){
                        if(index == 0) return true;
                        if(typeof this.commandItems[index-1] === 'undefined') return false;
                        return item.category != this.commandItems[index-1].category;
                    },
                    commandCategoryCapitalize(string){
                        return string.charAt(0).toUpperCase() + string.slice(1);
                    },
                    commandItemsReorganize(){
                        commandItemsOriginal = this.commandItems;
                        keys = Object.keys(this.commandItems);
                        this.commandItems = [];
                        keys.forEach((key, index) => {
                            for(i=0; i<commandItemsOriginal[key].length; i++){
                                commandItemsOriginal[key][i].category = key;
                                this.commandItems.push( commandItemsOriginal[key][i] );
                            }
                        });
                    }
                }" x-init="
                    commandItemsReorganize();
                    commandItemsFiltered = commandItems;
                    commandItemActive=commandItems[0];
                    $watch('commandSearch', value => commandSearchItems());
                    $watch('commandItemSelected', function(item){
                        if(item){
                            console.log('item:', item);
                        }
                    });
                "
                @keydown.down="event.preventDefault(); commandItemActiveNext();"
                @keydown.up="event.preventDefault(); commandItemActivePrevious()"
                @keydown.enter="commandItemSelected=commandItemActive;"
                @command-input-focus.window="$refs.commandInput.focus();"
                class="flex min-h-[370px] justify-center w-full max-w-xl items-start relative" x-cloak>
                <div class="box-border flex flex-col w-full h-full overflow-hidden bg-slate-50/90 dark:bg-slate-900/90 rounded-md shadow-md drop-shadow-md backdrop-blur-sm">
                    <div class="flex items-center px-3 border-b border-slate-300 dark:border-slate-700">
                        <svg class="w-4 h-4 mr-0 shrink-0" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" x2="16.65" y1="21" y2="16.65"></line></svg>
                        <input type="text" x-ref="commandInput" x-model="commandSearch" class="flex w-full px-2 py-3 text-sm bg-transparent border-0 rounded-md outline-none focus:outline-none focus:ring-0 focus:border-0 placeholder:text-slate-900 dark:placeholder:text-slate-50 h-11 disabled:cursor-not-allowed disabled:opacity-50" placeholder="Type a command or search..." autocomplete="off" autocorrect="off" spellcheck="false">
                    </div>
                    <div x-ref="commandItemsList" class="max-h-[320px] overflow-y-auto overflow-x-hidden">
                        <template x-for="(item, index) in commandItemsFiltered" :key="'item-' + index">

                            <div class="pb-1 space-y-1">
                                <template x-if="commandShowCategory(item, index)">
                                    <div class="px-1 overflow-hidden">
                                        <div class="px-2 py-1 my-1 text-xs font-medium" x-text="commandCategoryCapitalize(item.category)"></div>
                                    </div>
                                </template>

                                <template x-if="(item.default && commandSearchIsEmpty()) || !commandSearchIsEmpty()">
                                    <div class="px-1">
                                        <div :id="item.value + '-' + commandId" @click="commandItemSelected=item" @mousemove="commandItemActive=item" :class="{ 'bg-blue-600 text-white' : commandItemIsActive(item) }" class="relative flex cursor-default select-none items-center rounded-md px-2 py-1.5 text-sm outline-none data-[disabled]:pointer-events-none data-[disabled]:opacity-50">
                                            <span x-html="item.icon"></span>
                                            <span x-text="item.title"></span>
                                            <template x-if="item.right">
                                                <span class="ml-auto text-xs tracking-widest text-muted-foreground" x-text="item.right"></span>
                                            </template>
                                        </div>
                                    </div>
                                </template>
                            </div>

                        </template>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>

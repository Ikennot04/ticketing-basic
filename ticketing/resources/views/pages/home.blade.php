<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('partials.head')
</head>

<body>
    <div x-data="{
        tickets: [
            { id: 1001, title: 'Ticket #1001', description: 'Issue with login', created_at: '2025-08-01 10:00', updated_at: '2025-08-01 12:00' },
            { id: 1002, title: 'Ticket #1002', description: 'Payment not processed', created_at: '2025-08-01 11:00', updated_at: '2025-08-01 13:00' },
            { id: 1003, title: 'Ticket #1003', description: 'Unable to download invoice', created_at: '2025-08-01 12:30', updated_at: '2025-08-01 14:00' }
        ],
        selected: null,
        search: ''
    }" class="flex min-h-screen" x-cloak>
        <!-- Left half: Ticket list -->
        <div class="w-1/2 bg-white p-8 border-r border-[#e3e3e0] flex flex-col relative">
            <!-- Search bar (upper left) -->
            <form class="flex mb-6" @submit.prevent>
                <input type="text" x-model="search" placeholder="Search tickets..."
                    class="flex-1 px-3 py-2 border border-[#e3e3e0] rounded-l focus:outline-none focus:border-[#1b1b18] text-sm">
                <button type="button"
                    class="px-4 py-2 bg-[#1b1b18] text-white rounded-r hover:bg-black transition-colors text-sm"
                    @click="$refs.searchInput && $refs.searchInput.focus()">
                    Search
                </button>
            </form>
            <ul class="space-y-4 flex-1 overflow-y-auto">
                <template
                    x-for="ticket in (search ? tickets.filter(t => t.title.toLowerCase().includes(search.toLowerCase()) || t.description.toLowerCase().includes(search.toLowerCase())) : tickets)"
                    :key="ticket.id">
                    <li
                        class="p-4 rounded shadow border border-[#e3e3e0] hover:border-[#1b1b18] transition-colors flex justify-between items-center">
                        <div>
                            <div class="font-medium text-lg text-[#1b1b18]" x-text="ticket.title"></div>
                            <div class="text-sm text-[#706f6c]" x-text="ticket.description"></div>
                        </div>
                        <button
                            class="ml-4 px-4 py-2 bg-[#1b1b18] text-white rounded hover:bg-black transition-colors text-sm"
                            @click="selected = ticket" type="button">
                            View
                        </button>
                    </li>
                </template>
                <template
                    x-if="(search ? tickets.filter(t => t.title.toLowerCase().includes(search.toLowerCase()) || t.description.toLowerCase().includes(search.toLowerCase())) : tickets).length === 0">
                    <li class="text-[#706f6c] text-center py-8">No tickets found.</li>
                </template>
            </ul>
            <!-- Add Button (lower right of left half) -->
            <button
                class="absolute bottom-8 right-8 px-6 py-3 bg-[#1b1b18] text-white rounded-full shadow-lg hover:bg-black transition-colors text-base z-10"
                type="button" @click="alert('Add ticket action')">
                + Add Ticket
            </button>
        </div>

        <!-- Right half: Ticket details -->
        <div class="w-1/2 flex items-center justify-center">
            <template x-if="selected">
                <div class="bg-white border border-[#e3e3e0] rounded-lg shadow-md p-8 w-[448px]">
                    <h3 class="text-xl font-semibold mb-4 text-[#1b1b18]" x-text="selected.title"></h3>
                    <p class="mb-4 text-[#706f6c]" x-text="selected.description"></p>
                    <div class="text-sm text-[#706f6c] mb-1">
                        <span class="font-medium text-[#1b1b18]">Created:</span>
                        <span x-text="selected.created_at"></span>
                    </div>
                    <div class="text-sm text-[#706f6c] mb-6">
                        <span class="font-medium text-[#1b1b18]">Updated:</span>
                        <span x-text="selected.updated_at"></span>
                    </div>
                    <div class="flex gap-4">
                        <button
                            class="px-4 py-2 bg-[#1b1b18] text-white rounded hover:bg-black transition-colors text-sm"
                            type="button" @click="alert('Update action for ' + selected.title)">
                            Update
                        </button>
                        <button
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors text-sm"
                            type="button"
                            @click="
                    if(confirm('Are you sure you want to delete this ticket?')) {
                      tickets = tickets.filter(t => t.id !== selected.id);
                      selected = null;
                    }
                  ">
                            Delete
                        </button>
                    </div>
                </div>
            </template>
            <template x-if="!selected">
                <div class="text-[#706f6c] text-center">Select a ticket to view details.</div>
            </template>
        </div>
    </div>
    <!-- Alpine.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>

</html>

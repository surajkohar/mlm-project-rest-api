
<link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">


<div class="w-full flex justify-between shadow-lg px-4 py-2 sticky top-0 left-0 bg-white z-40">
    <div class="w-max flex items-center">
        <div class="h-max w-max lg:hidden flex">
            <i class="fa fa-bars text-themeColor text-2xl mr-3 cursor-pointer"
                onclick="document.getElementById('sideBar').classList.remove('hidden');"></i>
        </div>
        <span class="text-black font-bold text-xl font-montserrat lg:block md:block hidden">Dashboard</span>
    </div>
    <div class="w-max relative lg:block md:block hidden">
       
        <ul id="flights-list"></ul>
        <ul id="hotels-list"></ul>
    </div>
    <div class="w-max flex gap-2 items-center">
        <div class="relative">
            <button class="flex items-center focus:outline-none" id="user-menu-button" aria-expanded="true" aria-haspopup="true">
                <div class="w-max flex flex-col items-end">
                    {{-- <span class="text-black font-bold text-sm font-montserrat">{{ auth()->user()->name }}</span> --}}
                    <p class="text-normalText font-normal text-xs font-montserrat text-center">
                        {{-- {{ auth()->user()->roles[0]->name }}</p> --}}
                </div>
                <div class="w-max h-max flex">
                    <!-- Add your image source here -->
                    {{-- <!-- <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" class="rounded-full h-8 w-8" alt=""> --> --}}
                </div>
            </button>

            {{-- <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                <!-- Account Management -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Account') }}
                </div>

                
                <div class="border-t border-gray-200"></div>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem" tabindex="-1" id="user-menu-item-2">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div> --}}
        </div>
    </div>
</div>

<script>
    // Add event listener to toggle the dropdown menu
    document.getElementById('user-menu-button').addEventListener('click', function() {
        var dropdown = this.nextElementSibling;
        dropdown.classList.toggle('hidden');
    });
</script>

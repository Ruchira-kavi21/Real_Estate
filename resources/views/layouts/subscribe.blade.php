<!-- Subscription Section -->
<section class="bg-white text-center py-10">
    <div class="container mx-auto">
        <h2 class="text-2xl font-bold text-teal-500">Don't miss out</h2>
        <p class="text-gray-600 mt-2 mb-6">Limited-time offers and discounts for subscribers only.</p>
        <form id="subscribeForm" class="mt-6 flex justify-center">
            @csrf
            <input type="email" name="email" id="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" 
                   placeholder="Your email is safe with us" 
                   class="w-full max-w-md px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-teal-400" required>
            <button type="submit" class="px-6 py-2 bg-gray-800 text-white font-semibold rounded-r-md hover:bg-gray-700 focus:outline-none">Subscribe</button>
        </form>
        <div id="subscribeMessage" class="mt-4"></div>
    </div>
</section>
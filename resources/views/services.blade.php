@extends('layouts.app')

@section('content')

{{-- Navbar --}}
<nav class="flex justify-between items-center px-12 py-5 bg-white border-b border-gray-100">
    <a href="{{ route('home') }}" class="text-sm font-bold tracking-widest uppercase hover:opacity-80 transition-opacity">
        Salon<span class="text-yellow-600 font-light">TwentyTwo</span>
    </a>
    <ul class="flex gap-10 list-none">
        <li><a href="#" class="text-xs font-medium tracking-widest uppercase text-gray-500 hover:text-yellow-600 transition-colors">About</a></li>
        <li><a href="{{ route('services.index') }}" class="text-xs font-medium tracking-widest uppercase text-yellow-600 border-b border-yellow-600 pb-0.5 transition-colors">Services</a></li>
        <li><a href="#" class="text-xs font-medium tracking-widest uppercase text-gray-500 hover:text-yellow-600 transition-colors">Gallery</a></li>
        <li><a href="#" class="text-xs font-medium tracking-widest uppercase text-gray-500 hover:text-yellow-600 transition-colors">Find Us</a></li>
        <li><a href="#" class="text-xs font-medium tracking-widest uppercase text-gray-500 hover:text-yellow-600 transition-colors">Contact</a></li>
    </ul>
    <div class="flex gap-5 items-center">
        <a href="#" class="text-xs tracking-widest uppercase text-gray-400 hover:text-yellow-600 transition-colors">Instagram</a>
        <a href="#" class="text-xs tracking-widest uppercase text-gray-400 hover:text-yellow-600 transition-colors">Facebook</a>
        <a href="{{ route('booknow') }}" class="bg-black hover:bg-yellow-600 text-white text-xs font-semibold tracking-widest uppercase px-5 py-3 transition-colors">Book Now</a>
    </div>
</nav>

{{-- Page Hero --}}
<section class="relative h-[50vh] bg-black overflow-hidden flex items-center justify-center text-center px-12">
    <img src="{{ asset('images/services.jpg') }}" class="absolute inset-0 w-full h-full object-cover opacity-60" alt="Our Services">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="relative z-10 max-w-3xl">
        <p class="text-xs font-semibold tracking-widest uppercase text-yellow-500 mb-4">What We Offer</p>
        <h1 class="text-6xl font-light text-white leading-tight mb-6">
            Our <span class="font-bold text-yellow-500">Services</span>
        </h1>
    </div>
</section>

{{-- Consultation Section --}}
<section class="grid grid-cols-1 md:grid-cols-2 bg-white border-b border-gray-50">
    <div class="h-[500px] md:h-[600px] overflow-hidden">
        <img src="{{ asset('images/services.jpg') }}" class="w-full h-full object-cover" alt="Salon Consultation">
    </div>

    <div class="flex flex-col justify-center px-12 md:px-24 py-20">
        <h2 class="text-4xl font-bold text-black uppercase tracking-tight mb-8">Consultation</h2>
        <p class="text-lg text-gray-500 leading-relaxed mb-10 max-w-md font-light">
            Finding your perfect hairdresser is important. We recommend a complimentary consultation to talk through your needs with our experts.
        </p>
        <a href="{{ route('booknow') }}" class="bg-black hover:bg-yellow-600 text-white text-xs font-bold tracking-widest uppercase px-12 py-5 transition-all w-fit shadow-xl">
            Book now
        </a>
    </div>
</section>


{{-- SECTION 01: THE CUT --}}
<div class="service-section py-24 bg-white" data-category="hair">
    <div class="px-12 mb-16">
        <div class="flex items-baseline gap-4">
            <h2 class="text-8xl font-black text-gray-50 leading-none">01</h2>
            <div class="-ml-12">
                <h3 class="text-4xl font-bold uppercase tracking-[0.2em] text-black">The Sculpted Cut</h3>
                <p class="text-yellow-600 text-xs font-bold tracking-widest uppercase mt-2">Precision & Movement</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-0 items-center">
        <div class="lg:col-span-5 px-12 lg:pl-24 lg:pr-0 z-20 order-2 lg:order-1">
            <div class="bg-stone-50 p-12 lg:p-16 shadow-2xl">
                <p class="text-gray-400 text-xs mb-6 leading-widest uppercase">Signature Service</p>
                <h4 class="text-2xl font-bold text-black uppercase mb-6">Bespoke Silhouette</h4>
                <p class="text-gray-500 text-sm leading-loose mb-10">
                    We don't just cut hair; we engineer it. Our signature process begins with a structural analysis of your profile, followed by dry-carving techniques that ensure your style holds its shape.
                </p>
                <a href="{{ route('booknow') }}" class="inline-block border-b-2 border-black pb-2 text-xs font-bold uppercase tracking-widest hover:text-yellow-600 hover:border-yellow-600 transition-all">
                    Reserve Your Session
                </a>
            </div>
        </div>
        <div class="lg:col-span-7 h-[700px] lg:pl-12 order-1 lg:order-2 mb-12 lg:mb-0">
            <div class="w-full h-full relative">
                <img src="{{ asset('images/hero.jpg') }}" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-1000" alt="Master Cut">
                <div class="absolute -bottom-6 -left-6 bg-yellow-600 w-32 h-32 hidden lg:block -z-10"></div>
            </div>
        </div>
    </div>
</div>

{{-- SECTION 02: THE COLOUR --}}
<div class="service-section bg-neutral-900 py-32 overflow-hidden" data-category="color">
    <div class="max-w-7xl mx-auto px-12 grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
        <div class="relative">
            <div class="absolute -left-16 top-0 h-full hidden xl:flex items-center">
                <span class="rotate-180 [writing-mode:vertical-lr] text-white/5 text-9xl font-black uppercase tracking-tighter">CHROMA</span>
            </div>
            <div class="aspect-[4/5] bg-neutral-800 relative group">
                <img src="{{ asset('images/services.jpg') }}" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity duration-700">
                <div class="absolute inset-0 border-[20px] border-white/5 group-hover:border-yellow-600/20 transition-all pointer-events-none"></div>
            </div>
        </div>
        <div class="text-white">
            <span class="text-yellow-500 text-xs font-bold tracking-[0.4em] uppercase block mb-6">02 — Artistry</span>
            <h3 class="text-5xl font-bold uppercase mb-8 leading-tight">Signature <br><span class="text-neutral-500">Global Tint</span></h3>
            <p class="text-neutral-400 text-sm leading-loose mb-12 max-w-md">
                Your colour is your signature. Find the one shade that truly illuminates your eyes through our professional Light-Reflect method.
            </p>
            <div class="flex flex-col gap-6 border-t border-neutral-800 pt-10">
                <a href="{{ route('booknow') }}" class="flex justify-between items-center group cursor-pointer">
                    <span class="text-xs uppercase tracking-widest group-hover:text-yellow-500 transition-colors">Book a Colourist</span>
                    <div class="w-12 h-12 rounded-full border border-white/10 flex items-center justify-center group-hover:bg-yellow-600 group-hover:border-yellow-600 transition-all">
                        <span class="text-white">→</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- {{-- SECTION 03: TEXTURE & FINISH --}}
<div class="service-section py-32 px-12 bg-stone-50" data-category="spa">
    <div class="text-center mb-20">
        <h3 class="text-xs font-bold tracking-[0.5em] uppercase text-gray-400 mb-4">Final Touches</h3>
        <h2 class="text-4xl font-bold text-black uppercase">Texture & Refinement</h2>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-1 px-1 bg-gray-200">
        <div class="bg-white p-12 lg:p-20 flex flex-col items-center text-center group">
            <div class="w-24 h-24 mb-10 overflow-hidden rounded-full border-2 border-yellow-600 p-1">
                 <img src="{{ asset('images/hero.jpg') }}" class="w-full h-full object-cover rounded-full">
            </div>
            <h4 class="text-xl font-bold uppercase mb-4 group-hover:text-yellow-600 transition-colors">Molecular Texture</h4>
            <p class="text-gray-400 text-xs leading-relaxed max-w-xs mb-8">
                From bouncing curls to glass-like smoothness. We reshape the hair's bond structure without compromising its internal health.
            </p>
            <a href="{{ route('booknow') }}" class="text-[10px] font-black uppercase tracking-widest border border-black px-6 py-3 hover:bg-black hover:text-white transition-all">Explore Texture</a>
        </div>
        <div class="bg-white p-12 lg:p-20 flex flex-col items-center text-center group">
            <div class="w-24 h-24 mb-10 overflow-hidden rounded-full border-2 border-yellow-600 p-1">
                 <img src="{{ asset('images/services.jpg') }}" class="w-full h-full object-cover rounded-full">
            </div>
            <h4 class="text-xl font-bold uppercase mb-4 group-hover:text-yellow-600 transition-colors">Event Finish</h4>
            <p class="text-gray-400 text-xs leading-relaxed max-w-xs mb-8">
                The perfect red-carpet blow dry or structured updo designed to maintain effortless movement.
            </p>
            <a href="{{ route('booknow') }}" class="text-[10px] font-black uppercase tracking-widest border border-black px-6 py-3 hover:bg-black hover:text-white transition-all">Book Finish</a>
        </div>
    </div>
</div> -->

{{-- Footer --}}
<footer class="bg-neutral-950 text-gray-600 px-12 py-12">
    <div class="flex justify-between items-start mb-10 pb-10 border-b border-neutral-800">
        <div class="text-sm font-bold tracking-widest uppercase text-white">
            Salon<span class="text-yellow-600 font-light">TwentyTwo</span>
        </div>
        <div class="flex gap-16">
            <div>
                <h4 class="text-xs tracking-widest uppercase text-neutral-600 mb-4">Navigate</h4>
                <a href="{{ route('home') }}" class="block text-sm text-neutral-500 hover:text-yellow-600 mb-3 transition-colors">Home</a>
                <a href="{{ route('services.index') }}" class="block text-sm text-neutral-500 hover:text-yellow-600 mb-3 transition-colors">Services</a>
            </div>
        </div>
    </div>
    <p class="text-xs text-neutral-700">© {{ date('Y') }} Salon Twenty Two. All rights reserved.</p>
</footer>

<script>
function filterCategory(category) {
    document.querySelectorAll('.category-tab').forEach(tab => {
        tab.classList.remove('border-yellow-600', 'text-yellow-600', 'active-tab');
        tab.classList.add('border-transparent', 'text-gray-400');
    });
    const activeTab = document.getElementById('tab-' + category);
    if (activeTab) {
        activeTab.classList.add('border-yellow-600', 'text-yellow-600', 'active-tab');
        activeTab.classList.remove('border-transparent', 'text-gray-400');
    }
    document.querySelectorAll('.service-section').forEach(section => {
        if (category === 'all' || section.dataset.category === category) {
            section.style.display = 'block';
        } else {
            section.style.display = 'none';
        }
    });
}

function scrollToServices(e) {
    e.preventDefault();
    const element = document.getElementById("services-start");
    window.scrollTo({
        top: element.offsetTop - 80,
        behavior: "smooth"
    });
}
</script>

@endsection
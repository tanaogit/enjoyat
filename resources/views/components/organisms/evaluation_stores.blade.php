<h2 class="text-lg font-bold border-l-4 border-pink-400 pl-2">評価の高い店舗はこちら</h2>

<section class="mt-8">
    <ul id="evaluation-stores" class="md:grid md:grid-cols-2 lg:grid-cols-3 -m-3">
        @foreach ($evaluations as $evaluation)
        <li class="m-3 border-gray-100 border-2 hover:border-gray-300 hover:border-2 active:border-blue-300 cursor-pointer">
            <a href="{{ route('index.storedetail', ['id' => $evaluation->id]) }}">
                <div class="relative h-48 rounded overflow-hidden border-gray-100 border-b-2">
                    <img src="{{ $evaluation->image }}" alt="{{ $evaluation->name }}の店舗画像" class="object-cover object-center w-full h-full block">
                </div>
                <div class="p-4">
                    <h4 class="text-gray-500 text-sm truncate">{{ $evaluation->prefecture }}{{ $evaluation->city }}{{ $evaluation->street_address }}</h4>
                    <h3 class="text-gray-900 text-xl truncate">{{ $evaluation->name }}</h3>
                    <div class="flex justify-between mt-1">
                        <p class="text-md">{{ $evaluation->tel }}</p>
                        <span class="text-md"><i class="text-yellow-500 fas fa-star"></i> {{ number_format($evaluation->total_eva_avg, 1) }}</span>
                    </div>
                </div>
            </a>
        </li>
        @endforeach
    </ul>
</section>

<div class="text-center mt-14 md:mt-12 mb-10">
    <x-atoms.buttons.normal-button url="{{ route('index.evaluations') }}" content="評価の高い店舗をもっと見る" />
</div>

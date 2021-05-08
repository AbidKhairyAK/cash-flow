<x-app-layout>
	<x-slot name="header">
		<div class="flex justify-between items-center">
			<h2 class="font-semibold text-xl text-gray-800 leading-tight">
				Pemasukan
			</h2>
			<a href="{{ route('incomes.create') }}" class="px-4 py-2 bg-primary hover:bg-quaternary font-bold rounded shadow text-sm text-white">
				+ Catat Pemasukan
			</a>
		</div>
	</x-slot>

	<div class="grid lg:gap-6 gap-4">
		@foreach($incomeDates as $incomeDate)
			<x-card>
				<h3 class="pb-4 mb-4 border-b border-gray-300">
					{{ $incomeDate->date->format('l, d F Y') }}
				</h3>

				@php
					$incomes = \App\Models\Income::with('store')
						->whereDate('date', $incomeDate->date)
						->get();
				@endphp

				<div class="overflow-x-scroll">
					<table class="text-sm w-full">
						<thead>
							<tr class="text-left">
								<th class="pb-2" style="min-width: 200px;">Toko / Event</th>
								<th class="pb-2" style="min-width: 130px;">Pemasukan</th>
								<th class="pb-2" style="min-width: 130px;">Diinput Oleh</th>
								<th class="pb-2" style="min-width: 130px;">Status</th>
								
								@if(auth()->user()->isAdmin())
								<th class="pb-2" style="min-width: 130px;">Opsi</th>
								@endif

							</tr>
						</thead>
						<tbody>
							@foreach($incomes as $income)
								<tr class="border-t border-gray-300">
									<td class="py-2">{{ $income->store->name }}</td>
									<td class="py-2">Rp {{ number_format($income->amount, 0, '', '.') }}</td>
									<td class="py-2">{{ $income->user->name }}</td>
									<td class="py-2">{{ $income->status }}</td>

									@if(auth()->user()->isAdmin())
									<td class="py-2 text-sm flex space-x-2">
										
										@if($income->status === 'pending')
										<a href="" class="bg-primary block py-1 px-3 text-xs rounded shadow text-white font-bold">
											Approve
										</a>
										<a href="" class="bg-secondary block py-1 px-3 text-xs rounded shadow text-white font-bold">
											Disapprove
										</a>
										@endif

										<a href="" class="bg-tertiary block py-1 px-3 text-xs rounded shadow text-white font-bold">
											Delete
										</a>
									</td>
									@endif

								</tr>
							@endforeach
						</tbody>
					</table>
				</div>

			</x-card>
		@endforeach
	</div>
</x-app-layout>